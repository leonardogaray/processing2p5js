<?php

function readFiles($repo, $project){
    
    $githubFolder = "../github_tp2";

    $urlSite = "http://www.colaboratorio3.org/_tps/";
    $directory = $githubFolder . "/" . $repo . "_" . $project . "/" . $project . "-tp2";
        
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
    $joinedFiles = preg_replace("/loadImage\(\"/","loadImage(\"". $directory . "/data/", $joinedFiles);
    
    return $joinedFiles;
}