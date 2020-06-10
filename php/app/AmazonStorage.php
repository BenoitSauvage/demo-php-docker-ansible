<?php

namespace Demo\App;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class AmazonStorage implements GenericStorageInterface
{
    private $s3;

    public function __construct(S3Client $s3 = null)
    {
        if ($s3 === null) {
            $this->s3 = new S3Client([
                'version' => 'latest',
                'region'  => 'us-east-2'
            ]);
        } else {
            $this->s3 = $s3;
        }
    }

    /**
     * @param string $path
     * @return boolean|string
     */
    public function put(string $path)
    {
        try {
            $filename = pathinfo($path, PATHINFO_BASENAME);

            $result = $this->s3->putObject([
                'Bucket' => 'my-bucket',
                'Key'    => $filename
            ]);

            return $result['ObjectURL'];
        } catch (S3Exception $e) {
            echo $e->getMessage().PHP_EOL;
            return false;
        }
    }

    /**
     * @param string $filename
     * @return bool
     */
    public function get(string $filename)
    {
        try {
            $result = $this->s3->getObject([
                'Bucket' => 'my-bucket',
                'Key'    => $filename
            ]);

            return $result['Body'];
        } catch (S3Exception $e) {
            echo $e->getMessage().PHP_EOL;
            return false;
        }
    }
}