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
        # The audio file's encoding and sample rate
        $options = [
            'encoding' => 'FLAC',
            'sampleRate' => 8000,
        ];

        # Detects speech in the audio file
        $results = $this->speech->recognize($audioFileName, $options);

        return $results;
    }

}