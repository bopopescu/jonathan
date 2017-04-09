<?php 
namespace lib;

require __DIR__ . '/../vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

class GoogleStorage{

    private $storage;
    private $bucket;

    function __construct($projectId){

        $this->storage = new StorageClient([
            'projectId' => 'speech-to-text-project-163409'
        ]);

        # The name for the new bucket
        $bucketName = 'testbucket909';

        # Creates the new bucket
        $this->bucket = $storage->createBucket($bucketName);
    }

}