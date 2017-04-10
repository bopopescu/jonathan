<?php 
namespace lib;

require __DIR__ . '/../vendor/autoload.php';

use Google\Cloud\Speech\SpeechClient;
use Google\Cloud\ServiceBuilder;

class GoogleSpeech{

    private $speech;

    function __construct(){

        // $this->speech = new SpeechClient([
        //     'projectId' => 'speech-to-text-project-163409',
        //     'languageCode' => 'en-US',
        // ]);

        $gcloud = new ServiceBuilder([
            'keyFilePath' => 'project-1c3b022df4fe.json',
            'projectId' => '268161401461',
            'languageCode' => 'en-US',
        ]);

        $this->speech = $gcloud->speech();

    }

    function translate($audioFileName){
        # The audio file's encoding and sample rate
        $options = [
            'encoding' => 'FLAC',
            'sampleRate' => 8000,
        ];

        # Detects speech in the audio file
        $operation = $this->speech->beginRecognizeOperation($audioFileName, $options);

        $isComplete = $operation->isComplete();
        $counter = 0;
        while (!$isComplete) {
            sleep(1); // let's wait for a moment...
            $operation->reload();
            $isComplete = $operation->isComplete();
        }
        $info = $operation->info();

        return $info['response']['results'];
    }

}