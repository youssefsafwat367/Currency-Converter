<?php

namespace App\Traits;

trait uploadFile
{
    public function uploadFile($request,  $filename, $folderForFile , $disk )
    {
        if ($request->hasFile($filename)) {
            $photo = $request->file($filename);
            $name = $photo->getClientOriginalName();
            $photo->storeAs( 'attachments/' . $folderForFile,  $name, $disk);

            return $name;
        }
    }
}
