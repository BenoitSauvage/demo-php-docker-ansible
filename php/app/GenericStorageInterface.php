<?php

namespace Demo\App;

interface GenericStorageInterface
{
    public function put(string $path);
    public function get(string $filename);
}