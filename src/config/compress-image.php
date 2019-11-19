<?php
/*
* @Author: hzwlxy
* @Email: 120235331@qq.com
* @Github: http：//www.github.com/siaoynli
* @Date: 2019/7/10 12:37
* @Version:
* @Description:
*/

return [
    //水印
    "water" => [
        //是否水印
        "create" => true,
        //水印文件
        "water_file" => public_path("/logo.png"),
        //水印位置
        //top-left (default)
        //top
        //top-right
        //left
        //center
        //right
        //bottom-left
        //bottom
        //bottom-right
        "position" => "center",
        "offset_x" => 0,
        "offset_y" => 0,
    ],
    //生成小图宽度
    "small" => 200,
    "thumb" => [
        //以宽度做标准
        "width" => 800,
        //以高度做标准,建议宽和高只用一个做标准，否则图片会变形
        "height" => 0,
    ],
    //品质0-100
    "quality" => 70,

];
