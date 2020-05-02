<?php

namespace Hesham14Yahia\ImageFullControl;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageFullControl
{

    /**
     * upload image function
     *
     * @param [type] $image
     * @param string $folder_name
     * @param string $old_image
     * @param integer $width
     * @param integer $height
     * @param integer $quality
     * @return string
     */
    public static function uploadImage($image, $folder_name, $old_image = null, $width = null, $height = null, $quality = 100)
    {
        // check image and folder_name exist
        if ($image && $folder_name) {

            // fetch image
            $img = Image::make($image);

            // check if manipulation requested
            if ($width !== null or $height !== null)
                self::imageManipulation($img, $width, $height);


            // check if there is an old image and check if this image isn't the default image
            if ($old_image !== null && !Str::contains($old_image, $folder_name))
                // remove old image
                unlink(public_path() . '/uploads/' . $folder_name . '/' . $old_image);


            // image name for store
            $uploaded_image_name = self::generateName($image);

            // store uploaded image
            $img->save(public_path() . '/uploads/' . $folder_name . '/' . $uploaded_image_name, $quality);

            // return new uploaded image name
            return $uploaded_image_name;
        }
    }

    // generate image name
    protected static function generateName($image)
    {
        // get image extension
        $extension = $image->getClientOriginalExtension();

        // return image generated name
        return Str::random(5) . time() . '.' . $extension;
    }

    // image manipulation
    protected static function imageManipulation($img, $width, $height)
    {
        // image resize
        $img->resize($img->width() > $width ? $width : null, $img->width() > $height ? $height : null, function ($constraint) {
            $constraint->aspectRatio();
        });
    }
}
