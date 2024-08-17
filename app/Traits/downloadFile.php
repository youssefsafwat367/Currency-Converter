<?php

namespace App\Http\Traits;

trait downloadFile
{
    public function downloadFile($filename)
    {
        
        return response()->download(public_path('attachments/Library/'.$filename));
    }
}
