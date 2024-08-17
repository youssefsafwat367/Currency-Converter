<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait deleteFile
{
    public function deleteFile($source, $filename)
    {
        $filePath = public_path('attachments/' . $source . '/' . $filename);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }
}
