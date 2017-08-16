<?php
    //获取配置文件
    $a = require 'config.php';
    //连接数据库和表
    $link  = mysqli_connect("{$a['locat']}:{$a['port']}","{$a['name']}","{$a['pwd']}","{$a['database']}") or die("数据库连接失败");
    //设置数据库编码
    mysqli_query($link,"set names utf8");
?>