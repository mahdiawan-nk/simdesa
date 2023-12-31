<?php
defined('BASEPATH') or exit('No direct script access allowed');
$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base_url .= "://" . $_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

$config['asset-admin']=$base_url.'assets/admins/';
$config['asset-sites']=$base_url.'assets/sites/';