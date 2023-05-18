<?php

function getFileName($path):string
{
    $arr_path = explode('/', $path);
    return end($arr_path);
}
