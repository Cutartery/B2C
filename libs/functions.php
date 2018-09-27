<?php
//加载视图

function view($file,$data=[])
{
    // var_dump($data);
    extract($data);

    include(ROOT.'views/'.$file.'.html');
}
function redirect($url)
{
    header('Location:'.$url);
    exit;
}