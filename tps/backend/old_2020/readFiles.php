<?php
require '../conf/const.php';

function readFiles($names, $project){
    
    $githubFolder = "../github_" . $GLOBALS["tp_global"];

    $urlSite = "http://www.colaboratorio3.org/_tps/";
    $directory = $githubFolder . "/" . $names . "_" . $project . "/tpfinal";
        
    $files  = scandir($directory);
    $joinedFiles = "";
    
    foreach ($files as $file) {
        if($file != "." && $file != ".."){
            if(!is_dir($file) && substr($file, -4) == ".pde"){
                $joinedFiles = $joinedFiles . "\n" . file_get_contents($directory . '/' . $file);
            }
        }
    }

    //Transform loadImage
    $joinedFiles = preg_replace("/loadImage\s?\(\s?\"/","loadImage(\"". $directory . "/data/", $joinedFiles);
    //Replace loadFont   
    $joinedFiles = preg_replace("/loadFont\s?\(\s?\".+\"\s?\);/","loadFont(\"../tps/fonts/OpenSans-Regular.ttf\");", $joinedFiles);

    return $joinedFiles;
}