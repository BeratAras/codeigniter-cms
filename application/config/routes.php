<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//back
$route['products'] = 'Products';
$route['news'] = 'News';
$route['references'] = 'References';
$route['users'] = 'Users';
$route['login'] = 'Auth';
$route['logout'] = 'Auth/logout';
