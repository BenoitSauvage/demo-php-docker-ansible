<?php

use Demo\App\LocalStorage;
use PHPUnit\Framework\TestCase;

class LocalStorageTest extends TestCase
{
    /** @var LocalStorage */
    protected $storage;

    public function setUp(): void
    {
        $this->storage = new LocalStorage();
    }

    public function testPut()
    {
        // Store a new file and test if it exists
        $filename = 'test.txt';
        $this->storage->put('./test/'.$filename);
        $this->assertFileExists(LocalStorage::STORAGE_DIR.$filename);

        // Test file content
        $content = file_get_contents(LocalStorage::STORAGE_DIR.$filename);
        $this->assertEquals('This is a random test file.', $content);

        // Delete file
        unlink(LocalStorage::STORAGE_DIR.$filename);

        // Test that file doesn't exists
        $this->assertFileDoesNotExist(LocalStorage::STORAGE_DIR.$filename);
    }

    public function testGet()
    {
        $reference = 'Lorem ipsum dolor sit amet.'.PHP_EOL.'Consectetur adipiscing elit.';

        // Test that file content is equals to the reference
        $content = $this->storage->get('test-get.txt');
        $this->assertEquals($reference, $content);

        // Test that the file doesn't exists
        $this->assertEquals(false, $this->storage->get('random-file.txt'));
    }
}