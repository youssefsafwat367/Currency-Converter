<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait deleteDirectory
{
    public function deleteDirectory($source, $filename)
    {
        $filePath = public_path('attachments/'.$source.'/'.$filename);
        if (File::exists($filePath)) {
            File::deleteDirectory($filePath);
        }
    }
}
