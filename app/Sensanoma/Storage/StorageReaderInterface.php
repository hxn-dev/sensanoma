<?php

namespace App\Sensanoma\Storage;

interface StorageReaderInterface {
    public function read($query);
}