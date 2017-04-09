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
        //var_dump($video);
        $video = $this->ffmpeg->open($audioFile);

        $video->save(new \FFMpeg\Format\Audio\Flac(), $audioFile.'.flac');

        return $audioFile.'.flac';
    }

}