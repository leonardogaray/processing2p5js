<?php
require '../conf/const.php';
require '__tp1.php';

//Prevent script to finish
set_time_limit(0);

$githubFolder = "../../github_" . $tp_global ;

foreach($result as $row){
    try{
        $githubZip = "https://codeload.github.com/".$row["repo"]."/".$row["project"] . "/zip/" . $tp_global;
        
        $directory = $githubFolder . "/" . $row["names"] . "_" . $row["project"];    
        if(!is_dir($directory)){
            if(!mkdir($directory)){
                var_dump("Error al crear!", $directory, $row["names"], $row["project"]);
            }
        }

        $zipFileName = $directory . "/" . $row["names"] . "_" . $row["project"] . ".zip";
        file_put_contents($zipFileName, fopen($githubZip, 'r'));
        
        sleep(10);

        $zip = new ZipArchive;
        $res = $zip->open($zipFileName);
        if ($res === TRUE) {
            $zip->extractTo($directory);
            $zip->close();
            echo $directory . "<br>";
            echo $zipFileName . "<br>";

            rename($directory . "/" . $row["project"] . "-" . $tp_global , $directory . "/" . $tp_global );
            unlink($zipFileName);

            echo 'OK!' . "<br>";
        } else {
            echo 'KO!';
        }
    }catch(\Exception $e){

    }
}

// Get real path for our folder
$rootPath = realpath($githubFolder);

// Initialize archive object
$zip = new ZipArchive();
$zip->open('../../' . $tp_global . '_all.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);


foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
        echo $filePath . " - " . $relativePath . "<br>";
    }
    
}

// Zip archive will be created only after closing object
$zip->close();
