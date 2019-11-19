<?php
/*
* @Author: hzwlxy
* @Email: 120235331@qq.com
* @Github: http：//www.github.com/siaoynli
* @Date: 2019/7/5 11:15
* @Version:
* @Description:
*/

namespace Siaoynli\Compress\Facades;

use Illuminate\Support\Facades\Facade;

class Image extends Facade
{
    protected static function getFacadeAccessor() {
        return 'image';
    }
}
