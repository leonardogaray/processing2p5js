<?php
require dirname(__FILE__) . '/../conf/const.php';

function readFiles($names, $project){
    
    $githubFolder = dirname(__FILE__) . "/../../github_" . $GLOBALS["tp_global"];

    $urlSite = "http://www.colaboratorio3.org/_tps/";
    $directory1 = $githubFolder . "/" . $names . "_" . $project . "/" . $GLOBALS["tp_global"];
    $file1 = $directory1 . "/" . $GLOBALS["tp_global"] . ".pde";
    
    $directory2 = $githubFolder . "/" . $names . "_" . $project . "/" . $GLOBALS["tp_global"] . "/" . $GLOBALS["tp_global"];

    if(is_dir($directory1) && !file_exists($file1)){
        $directory = $directory2;
    }else{
        $directory = $directory1;
    }

    if(is_dir($directory)){
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
}

function mainFileExist($names, $project){
    $githubFolder = dirname(__FILE__) . "/../../github_" . $GLOBALS["tp_global"];

    $directory1 = $githubFolder . "/" . $names . "_" . $project . "/" . $GLOBALS["tp_global"];
    $file1 = $directory1 . "/" . $GLOBALS["tp_global"] . ".pde";

    $directory2 = $githubFolder . "/" . $names . "_" . $project . "/" . $GLOBALS["tp_global"] . "/" . $GLOBALS["tp_global"];
    $file2 = $directory2 . "/" . $GLOBALS["tp_global"] . ".pde";

    return ((is_dir($directory1) && file_exists($file1)) || (is_dir($directory2) && file_exists($file2)));
}