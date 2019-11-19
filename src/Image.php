<?php
/*
* @Author: hzwlxy
* @Email: 120235331@qq.com
* @Github: http：//www.github.com/siaoynli
* @Date: 2019/7/10 9:19
* @Version:
* @Description:
*/

namespace Siaoynli\Compress;

use Illuminate\Config\Repository;
use Intervention\Image\Facades\Image as InterventionImage;
use \Exception;

class Image
{

    protected $config;
    private $image;
    private $filename;


    public function __construct(Repository $config)
    {
        $this->config = $config->get("compress-image");
    }


    public function file($filename)
    {
        $this->filename = $filename;
        if (!file_exists($this->filename)) {
            throw new Exception($this->filename . " 文件不存在,请检查是否是绝对路径");
        }
        try {
            $this->image = InterventionImage::make($this->filename);
        } catch (Exception $e) {
            throw new Exception($this->filename . " 不是有效的图片格式");
        }
        return $this;
    }

    /**
     * @Author: hzwlxy
     * @Email: 120235331@qq.com
     * @Date: 2019/7/10 14:05
     * @Description:重设大小
     * @return $this
     */
    public function resize($width = "", $height = "")
    {
        $width = $width ?: $this->config['thumb']['width'];
        $height = $height ?: $this->config['thumb']['height'];
        if ($width && $height) {
            $this->image->resize($width, $height);
        } else {
            if ($width) {
                $this->resizeByWidth($width);
            }
            if ($height) {
                $this->resizeByHeight($height);
            }
        }
        return $this;
    }


    public function water($water_file = "", $position = "", $offset_x = 0, $offset_y = 0)
    {
        $water_config = $this->config['water'];
        $water_file = $water_file ?: $water_config['water_file'];
        $position = $position ?: $water_config['position'];
        $offset_x = $offset_x ?: $water_config['offset_x'];
        $offset_y = $offset_y ?: $water_config['offset_y'];
        if (!file_exists($water_file)) {
            throw new Exception($water_file . "文件不存在");
        }
        $this->image->insert($water_file, $position, $offset_x, $offset_y);
        return $this;
    }

    /**
     * @Author: hzwlxy
     * @Email: 120235331@qq.com
     * @Date: 2019/11/19 11:28
     * @Description:保存图片
     * @param string $new_filename
     * @param int $quality
     */
    public function save($new_filename = "", $quality = 0)
    {
        $filename = $new_filename ?: $this->filename;
        $dir = dirname($filename);
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }
        $quality = $quality ?: $this->config['quality'];
        try {
            $this->image->save($filename, $quality);
        } catch (\Exception $e) {
            throw new Exception($filename . "不是图片的绝对路径");
        }
    }


    /**
     * @Author: hzwlxy
     * @Email: 120235331@qq.com
     * @Date: 2019/11/19 11:25
     * @Description:生成微小图
     * @param $small_filename
     * @param string $width
     * @throws Exception
     */
    public function small($small_filename, $width = "")
    {
        $width = $width ?: $this->config['small'];
        $this->resizeByWidth($width);
        $small_dir = dirname($small_filename);
        if (!is_dir($small_dir)) {
            @mkdir($small_dir, 0777, true);
        }
        try {
            $this->image->save($small_filename);
        } catch (\Exception $e) {
            throw new Exception($small_filename . "不是图片的绝对路径");
        }
    }

    /**
     * @Author: hzwlxy
     * @Email: 120235331@qq.com
     * @Date: 2019/7/10 14:01
     * @Description:中间裁剪
     * @return $this
     */
    public function crop()
    {
        $width = $this->image->width();
        $height = $this->image->height();
        $num = floor(abs(($width - $height)) / 2);
        if ($width > $height) {
            $this->image->crop($this->image->height(), $this->image->height(), $num, 0);
        } else {
            $this->image->crop($this->image->width(), $this->image->width(), 0, $num);
        }
        return $this;
    }


    private function resizeByWidth($width)
    {
        $this->image = $this->image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });
    }

    private function resizeByHeight($height)
    {
        $this->image = $this->image->resize(null, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
    }
}
