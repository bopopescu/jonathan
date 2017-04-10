<?php 
namespace lib;

require __DIR__ . '/../vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;
use League\Flysystem\Filesystem;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;
use Google\Cloud\ServiceBuilder;

class GoogleStorage{

    private $storage;
    private $bucket;
    private $filesystem;

    function __construct(){
        $gcloud = new ServiceBuilder([
            'keyFilePath' => 'project-1c3b022df4fe.json',
            'projectId' => '268161401461'
        ]);
        $storageClient = $gcloud->storage();
        $this->bucket = $storageClient->bucket('testbucket909');
        
        $adapter = new GoogleStorageAdapter($storageClient, $this->bucket);

        $this->filesystem = new Filesystem($adapter);
    }

    function check($filename){
        return $this->filesystem->has($filename);
    }

    function get($filename){
        return $this->bucket->object($filename);
    }

    function upload($filename, $file){
        $stream = fopen($file, 'r+');
        $result = null;
        
        if(!$this->check($filename)){
            $result = $this->filesystem->writeStream($filename, $stream);
        }else{
            $result = $this->filesystem->updateStream($filename, $stream);
        }

        return $result;
    }

}