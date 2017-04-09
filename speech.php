<?php

require __DIR__ . '/lib/Ffmpeg_Wrapper.php';
require __DIR__ . '/lib/GoogleSpeech.php';

use lib\Ffmpeg_Wrapper;
use lib\GoogleSpeech;

$ffmpeg = new Ffmpeg_Wrapper();
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["audio"]["name"]);

if (move_uploaded_file($_FILES["audio"]["tmp_name"], $target_file)) {
    $flac_file = $ffmpeg->convertToFlac($target_file);

    $speech = new GoogleSpeech();
    $text = $speech->translate($_FILES["audio"]["name"] .'.flac');
    //echo "The file ". basename( $_FILES["audio"]["name"]). " has been uploaded.";

    var_dump($text);
} else {
    echo "Sorry, there was an error uploading your file.";
}

?>