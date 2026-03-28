<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductImageHelper
{
    public static function upload(UploadedFile $file, ?int $userId = null, ?array $cropData = null): string
    {
        $manager = new ImageManager(new Driver());
        $img = $manager->read($file);

        if ($cropData) {
            $img->crop(
                (int) round($cropData['width']),
                (int) round($cropData['height']),
                (int) round($cropData['x']),
                (int) round($cropData['y'])
            );
        }

        $filename = ($userId ?? uniqid()) . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = 'avatars/' . $filename;

        Storage::disk('public')->put(
            $path,
            $img->encodeByExtension($file->getClientOriginalExtension())
        );

        return $path;
    }
}