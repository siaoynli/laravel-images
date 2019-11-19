# laravel 图片处理包



## install

this package  for  laravel

```
composer require siaoynli/laravel-images
```

add the ServiceProvider to the providers array in config/app.php

```
Siaoynli\Compress\ImageServiceProvider::class,
```

If you want to use the facade to log messages, add this to your facades in app.php:

```
  'Image' => Siaoynli\Compress\Facades\Image::class,
```

Copy the package config to your local config with the publish command:

```
php artisan vendor:publish --provider="Siaoynli\Compress\ImageServiceProvider"
```

## Usage

```
use Upload;
use Image;

//upload
$info=Upload::do()
... //if upload success

//图片源文件存储在public目录

//使用相对路径
$filename = $info["url"];
Image::file('.'.$filename)->resize(1500)->save();


////使用绝对路径的文件
$filename = public_path($info["url"]);

Image::file($filename)->resize(1500)->save();
//thumb
Image::file($filename)->resize()->water()->save()
//small image
$small=Image::file($filename)->small()
//resize
Image::file($filename)->resize()->save()
//crop center
Image::file($filename)->crop()->save()
//water
Image::file($filename)->water()->save()
Image::file($filename)->water(public_path("/water/logo.png","bottom-right",20,20)->save("",80)

//压缩图片
 Image::file(storage_path("app" . $filename))->resize(1500)->save();


//源文件存储到storage里，打水印和生成小图在 public 目录
     Image::file(storage_path("app".$filename))->crop()->small($small_filename,150);
          Image::file(storage_path("app".$filename))->resize()->water()->save(public_path($filename));

//存储为其他文件
$new_filename=storage_path($filename);
Image::file($filename)->water()->save($new_filename,90)

```



## Result

```
//upload  result

array:6 [▼
  "state" => "SUCCESS"
  "original_name" => "0eb30f2442a7d9337afbe24aa94bd11373f001b3.jpg"
  "ext" => "jpg"
  "mime" => "image/jpeg"
  "size" => 130759
  "url" => "/uploads/image/2019-07-10/b40383942859e40ee1f1eb3dd889e01d9b68dcb5.jpg"
]

//upload error
[
  "state"=>"error message"
]

// thumb result
"/uploads/image/2019-07-10/b40383942859e40ee1f1eb3dd889e01d9b68dcb5.jpg"

```

