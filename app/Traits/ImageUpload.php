<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

Trait   ImageUpload{
    public function uploadImage($file,$path){
        // Generate new filename
        $name = uniqid() . '.webp';


        // Convert to .webp
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file)->toWebp(quality: 90);

        // Save manually
        Storage::disk('public')->put("$path/$name", (string) $image);


        return $name;
    }
}
