#!/usr/bin/php

<?php

// main.php
// Last modified: 2015-02-01
// Author: Yohann QUINTON <yohann.quinton@awedia.com>
// Author: François LASSERRE <choiz@me.com>
// License: GNU GPL http://www.gnu.org/licenses/gpl.html

function makedir($folder, $mode=0777, $recursive=false) {
    $path = pathinfo($folder);
    if (is_writable($path['dirname'])) {
        if (is_executable($path['dirname'])) {
            if (!@mkdir($folder, $mode, $recursive)) {
                throw new exception("Error: Creating '$folder'", 1);
            }
        } else {
            throw new exception("Folder: '".$path['dirname']."' isn't executable!", 2);
        }
    } else {
        throw new exception("Folder: '".$path['dirname']."' isn't writable!", 3);
    }
}

try {
    $config_dist_path = dirname(__FILE__).'/config.php.dist';
    $config_path = dirname(__FILE__).'/config.php';

    if (file_exists($config_path)) {
        include_once $config_path;
    } else if (file_exists($config_dist_path)) {
        throw new Exception('Missing file: '.$config_path."\n\nTry this command:\ncp ".$config_dist_path.' '.$config_path."\n");
    } else {
        throw new Exception('Missing file: '.$config_path);
    }

    if (!isset($tmp_dir)) {
        throw new Exception('Missing variable : $tmp_dir');
    }

    if (!isset($final_dir)) {
        throw new Exception('Missing variable : $final_dir');
    }

    if (!isset($repos)) {
        throw new Exception('Missing variable : $repos');
    }

    if (!is_dir($tmp_dir)) {
        echo 'Creating '.$tmp_dir."\n";
        makedir($tmp_dir, 0755, true);
    }

    if (!is_dir($final_dir)) {
        echo 'Creating '.$final_dir."\n";
        makedir($final_dir, 0755, true);
    }

    if (is_array($repos)) {
        foreach ($repos as $key => $val) {
            echo 'Loading repository '.$key.' ('.$val.")\n";

            if (!is_dir($tmp_dir.$key)) {
                makedir($tmp_dir.$key, 0755, true);
                exec('cd '.$tmp_dir.$key.'/ && git clone --recursive '.$val.' ./');
            } else {
                exec('cd '.$tmp_dir.$key.'/ && git pull');
            }

            $last_commit = exec('cd '.$tmp_dir.$key.'/ && git log --pretty=format:"%h" -n 1');
            echo "\n=> lastest commit ".$last_commit."\n\n==========\n\n";

            $archive_name = $key.'-git-'.$last_commit.'.tar.gz';

            if (file_exists($tmp_dir.$archive_name)) {
                unlink($tmp_dir.$archive_name);
            }

            exec('cd '.$tmp_dir.' && tar -czf '.$archive_name.' '.$key);

            if (!is_dir($final_dir.$key)) {
                makedir($final_dir.$key, 0755, true);
            }

            if (file_exists($final_dir.$key.'/'.$archive_name)) {
                unlink($final_dir.$key.'/'.$archive_name);
            }

            exec('mv '.$tmp_dir.$archive_name.' '.$final_dir.$key.'/'.$archive_name);
            exec('ln -sf '.$final_dir.$key.'/'.$archive_name.' '.$final_dir.$key.'/'.$key.'-latest.tar.gz');
        }
    }

    if (isset($remove_tmp_dir) && isset($tmp_dir) && $remove_tmp_dir == true) {
        unlink($tmp_dir);
    }

    echo "Done!\n\n";

} catch (Exception $e) {
    echo $e->getMessage()."\n";
}
