# Image Full Control

Laravel package gives you full control of uploading, managing and manipulating app images.

## Requirements

-   PHP >=5.4
-   Fileinfo Extension

## Supported Image Libraries

-   GD Library (>=2.0)
-   Imagick PHP extension (>=6.5.7)
-   Intervention Image

## Create files and folders

In laravel **public** folder create **uploads** folder and then create a folder for whatever type of image you will upload, let's named for example **users**, and add to it **.gitignore** file with

```
*
!.gitignore
```

to prevent images to upload to git.

## Install Package

```
composer require hesham14yahia/image-full-control
```

## How to use it "uploading"

Just add

```
use Hesham14Yahia\ImageFullControl\ImageFullControl;
```

in your controller, then call static method uploadImage()

```
ImageFullControl::uploadImage($image, $folder_name)
```

just only two required parameters, first one the submitted image from the form, and the second one is the folder name, if you used in your method Independy Injection "Request" with the input file name "image" and folder name "users", it will be like that.

```
ImageFullControl::uploadImage($request->image, "users");
```

the method return the uploaded image name.

## More options "managing"

You can update image field with it, by adding the third parameter, which is an old image name, if we stick with user example, and you created an instance of the user model, it will be like that.

```
ImageFullControl::uploadImage($request->image, "users", $user->image);
```

the method returns the new uploaded image name and deletes the old one.

## You can also "manipulating"

Determine image width or height or even quilty, all this is optional, but they have an order you should stick with it, so if you will use all, it will be like that.

```
ImageFullControl::uploadImage($request->image, "users", $user->image, 50, 100, 75);
```

it will make the image with width 50px and height 100px and quilty 75%, if you want to use only quilty for exemple, it will be like that.

```
ImageFullControl::uploadImage($request->image, "users", $user->image, null, null, 11);
```

**_Note:_** default quilty is 100%.
