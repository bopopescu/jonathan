<?php 
namespace lib;

require __DIR__ . '/../vendor/autoload.php';

use Google\Cloud\Speech\SpeechClient;

class GoogleSpeech{

    private $speech;

    function __construct(){

        $this->speech = new SpeechClient([
            'projectId' => 'speech-to-text-project-163409',
            'languageCode' => 'en-US',
        ]);

    }

    function translate($audioFileName){
        # The name of the audio file to transcribe
        $fileName = __DIR__ . '/../uploads/'.$audioFileName;

        # The audio file's encoding and sample rate
        $options = [
            'encoding' => 'LINEAR16',
            'sampleRateHertz' => 16000,
        ];

        # Detects speech in the audio file
        $results = $this->speech->recognize(fopen($fileName, 'r'), $options);

        echo 'Transcription: ' . $results[0]['transcript'];

        return $results;
    }

}