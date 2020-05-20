<?php
$github = "https://github.com/leonardogaray/processing2p5js";

$repo = "leonardogaray";
$folder = "processing2p5js";

$githubZip = "https://codeload.github.com/".$repo."/".$folder."/zip/master";
$zipFileName = $repo . "_" . $folder . ".zip";
file_put_contents($zipFileName, fopen($githubZip, 'r'));

$zip = new ZipArchive;
$res = $zip->open($zipFileName);
if ($res === TRUE) {
    $zip->extractTo($repo . "_" . $folder . "/");
    $zip->close();
    echo 'OK!';
} else {
    echo 'KO!';
}