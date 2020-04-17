<?php

namespace Hesham14Yahia\ImageFullControl;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class ImageFullControl
{

    public static function uploadImage($image, $folder_name, $old_image = null, $width = null, $height = null, $quality = 100)
    {
        // check new images exists
        if ($image) {

            // Get Just Image Extension
            $extension = $image->getClientOriginalExtension();

            // Image name for store
            $uploaded_image_name = Str::random(5) . time() . '.' . $extension;

            // Fetch Image
            $img = Image::make($image);

            // check if resize requested
            if ($width !== null or $height !== null)
                // Image resize
                if ($img->width() > $width) {
                    $img->resize($width, $height, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }

            // check if there is an old image and check if this image isn't the default image
            if ($old_image !== null && !Str::contains($old_image, $folder_name)) {

                // remove old image
                unlink(public_path() . '/uploads/' . $folder_name . '/' . $old_image);
            }

            // Store Image
            $img->save(public_path() . '/uploads/' . $folder_name . '/' . $uploaded_image_name, $quality);

            // return new image name
            return $uploaded_image_name;
        }

        return ($old_image !== null) ? $old_image : null;
    }
}
