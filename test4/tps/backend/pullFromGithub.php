<?php
require 'tp2.php';

$githubFolder = "../../github_tp2";

foreach($result as $row){
    try{
        $githubZip = "https://codeload.github.com/".$row["repo"]."/".$row["project"]."/zip/tp2";
        
        $directory = $githubFolder . "/" . $row["repo"] . "_" . $row["project"];    
        if(!is_dir($directory)){
            if(!mkdir($directory)){
                var_dump("Error al crear!", $directory, $row["repo"], $row["project"]);
            }
        }

        $zipFileName = $directory . "/" . $row["repo"] . "_" . $row["project"] . ".zip";
        file_put_contents($zipFileName, fopen($githubZip, 'r'));

        $zip = new ZipArchive;
        $res = $zip->open($zipFileName);
        if ($res === TRUE) {
            $zip->extractTo($directory);
            $zip->close();
            echo $directory . "<br>";
            echo $zipFileName . "<br>";
            echo 'OK!' . "<br>";
        } else {
            echo 'KO!';
        }
    }catch(\Exception $e){

    }
}

