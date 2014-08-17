#!/usr/bin/php

<?php

/****************************** CONFIGURATION *******************************/
$dirTemp = "/tmp/archive_git2tgz/";     //Temp directory
$dirFinal = "/var/www/sources/";        //Final directory
$deleteDirTempAfterProcess = false;     //Keep or delete temp directory at end

/* Define name project and git url for all projects as key => value */
$depots = array(
    'dotfiles' => 'https://github.com/ChoiZ/dotfiles.git',
    /* 'next_repository' => 'next_url....', */
    /* 'next_repository' => 'next_url....', */
    /* 'next_repository' => 'next_url....' */
);
/****************************************************************************/

// Check si le répertoire temporaire existe
// Sinon => création
if(!is_dir($dirTemp)) {
    mkdir($dirTemp,0755);
}

// Check si le repertoire final existe
// Sinon => création
if(!is_dir($dirFinal)) {
    mkdir($dirFinal,0755);
}

/* Parcours des dépots */
foreach($depots as $key => $val) {
    echo "Traitement du dépot ".$key.": \n";

    if(!is_dir($dirTemp.$key)) {
        mkdir($dirTemp.$key,0755);
        exec('cd '.$dirTemp.$key.'/ && git clone --recursive '.$val.' ./');
    } else {
        exec('cd '.$dirTemp.$key.'/ && git pull');
    }

    $version = exec('cd '.$dirTemp.$key.'/ && git log --pretty=format:"%h" -n 1');

    echo "\n=> revision: $version\n\n";

    $nomArchive = $key.'-git-'.$version.'.tar.gz';

    if(file_exists($dirTemp.$nomArchive)) {
        unlink($dirTemp.$nomArchive);
    }

    exec('cd '.$dirTemp.' && tar -czf '.$nomArchive.' '.$key);


    if(!is_dir($dirFinal.$key)) {
        mkdir($dirFinal.$key,0755);
    }

    if(file_exists($dirFinal.$key.'/'.$nomArchive)) {
        unlink($dirFinal.$key.'/'.$nomArchive);
    }

    exec('mv '.$dirTemp.$nomArchive.' '.$dirFinal.$key.'/'.$nomArchive);
    exec('ln -sf '.$dirFinal.$key.'/'.$nomArchive.' '.$dirFinal.$key.'/'.$key.'-latest.tar.gz');
}

if($deleteDirTempAfterProcess == true) {
    unlink($dirTemp);
}

echo "\n DONE!\n";