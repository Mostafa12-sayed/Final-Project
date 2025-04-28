<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class FileHelper
{


    // Upload image and store it directly in the public directory
    public static function uploadImage($file, $folder = 'uploads')
    {
        if (!$file || !$file->isValid()) {
            return null;
        }

        // Get the file extension
        $extension = $file->getClientOriginalExtension();

        // Generate a unique filename
        $filename = Str::uuid() . '.' . $extension;

        // Define the path to store the file
        $path = public_path("{$folder}/{$filename}");

        // Make sure the folder exists
        if (!File::exists(public_path($folder))) {
            File::makeDirectory(public_path($folder), 0775, true);
        }

        // Move the file to the public directory
        $file->move(public_path($folder), $filename);

        // Return the public path (URL) to access the image
        return "/{$folder}/{$filename}"; // This will be something like /uploads/xxxx.jpg
    }

    // Delete the image from the public directory
    public static function deleteImage($imagePath)
    {
        if (!$imagePath) {
            return;
        }

        // Remove the leading slash if exists
        $imagePath = ltrim($imagePath, '/');

        // Check if the file exists in the public directory
        $fullPath = public_path($imagePath);

        if (File::exists($fullPath)) {
            // Delete the file
            File::delete($fullPath);
        }
    }


}
