<?php 
namespace lib;

require __DIR__ . '/../vendor/autoload.php';

use FFMpeg\FFMpeg;

class Ffmpeg_Wrapper{

    private $ffmpeg;

    function __construct(){
        $this->ffmpeg = FFMpeg::create(array(
            'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe',
        ));
    }

    function convertToFlac($audioFile){
        $video = $this->ffmpeg->open($audioFile);

        $format = new \FFMpeg\Format\Audio\Flac();

        $video->save($format, $audioFile.'.flac');
        
        return $video;
    }

}