<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class PublicImageUploadService
{
    /**
     * Store an uploaded image through Laravel's public filesystem disk.
     */
    public function store(UploadedFile $image, string $directory): string
    {
        $directory = trim($directory, '/');
        $path = $image->store($directory, 'public');

        if ($path === false) {
            throw new RuntimeException('Unable to store the uploaded image.');
        }

        return 'storage/'.$path;
    }
}
