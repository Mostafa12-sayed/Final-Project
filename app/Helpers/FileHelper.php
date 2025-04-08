<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileHelper
{
    public static function uploadImage($file, $folder = 'uploads', $disk = 'public')
    {
        if (!$file || !$file->isValid()) {
            return null;
        }

        $extension = $file->getClientOriginalExtension();
        $filename = Str::uuid() . '.' . $extension;

        $path = $file->storeAs($folder, $filename, $disk);

        return $path; // return full path: uploads/xxxx.jpg
    }

    public static function deleteImage($imagePath, $disk = 'public')
    {
        if (!$imagePath) return;

        if (Storage::disk($disk)->exists($imagePath)) {
            Storage::disk($disk)->delete($imagePath);
        }
    }
}