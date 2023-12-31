<?php defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('button')) {
    function button($text = 'defaul', $style = 'primary', $type = 'button',$atr=['name'=>'','value'=>''])
    {
        return '<button type="' . $type . '" class="btn btn-' . $style . '" '.$atr['name'].'='.$atr['name']. '>' . $text . '</button>';
    }
}

if (!function_exists('button_link')) {
    function button_link($text = 'defaul', $style = 'primary', $url = 'button')
    {
        return '<a href="' . $url . '" class="btn btn-' . $style . '">' . $text . '</a>';
    }
}
