<?php

namespace Demo\Test;

use Demo\App\AmazonStorage;
use PHPUnit\Framework\TestCase;
use Guzzle\Service\Resource\Model;

class AmazonStorageTest extends TestCase
{
    /** @var AmazonStorage */
    protected $storage;

    protected function setUp(): void
    {
        // Create response model for S3 putObject method
        $putModel = new Model([
            'ObjectURL' => 'http://s3-url.com/test.txt'
        ]);

        // Create response model for S3 getObject method
        $getModel = new Model([
            'Body' => 'This is a random test file.'
        ]);

        // Mock S3 client
        $client = $this->getMockBuilder('Aws\S3\S3Client')
            ->disableOriginalConstructor()
            ->addMethods(['putObject', 'getObject'])
            ->getMock();

        // Mock S3->putObject method
        $client->method('putObject')
            ->with(['Bucket' => 'my-bucket', 'Key' => 'test.txt'])
            ->will($this->returnValue($putModel));

        // Mock S3->getObject method
        $client->method('getObject')
            ->with(['Bucket' => 'my-bucket', 'Key' => 'test.txt'])
            ->will($this->returnValue($getModel));

        // Create new instance of AmazonStorage using the S3 client mock
        $this->storage = new AmazonStorage($client);
    }

    public function testPut()
    {
        $this->assertEquals('http://s3-url.com/test.txt', $this->storage->put('./test/test.txt'));
    }

    public function testGet()
    {
        $this->assertEquals('This is a random test file.', $this->storage->get('test.txt'));
    }
}