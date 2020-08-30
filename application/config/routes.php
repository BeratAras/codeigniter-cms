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
$route['email'] = 'Email';
$route['portfolio_categories'] = 'Portfolio/portfolio_categories';
$route['portfolio'] = 'Portfolio';
$route['settings'] = 'Settings';
$route['login'] = 'Auth';
$route['logout'] = 'Auth/logout';
$route['password-forget'] = 'Auth/password_forget_page';
