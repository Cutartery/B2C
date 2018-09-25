<?php
//加载视图

function view($file,$data=[])
{
    extract($data);
    include(ROOT.'views/'.$file.'.html');
}