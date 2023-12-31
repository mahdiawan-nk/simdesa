<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['template']='templatesurat';
$route['berita']='welcome/berita';
$route['berita/read/(:any)']='welcome/detailberita/$1';
$route['berita/(:num)']='welcome/berita/$1';
$route['migrate/go']='migrate';
$route['login']='userauth';
$route['panel-admin']='admin/authadmin';
$route['isadmin']='admin/authadmin/checkuser';
$route['logout']='admin/authadmin/logout';
$route['panel-admin/dashboard']='admin/dashboard';
$route['panel-user/dashboard']='admin/dashboard';
$route['panel-user/surat']='suratuser';
$route['panel-admin/templatesurat/(:num)']='admin/templatesurat/setting/$1';
$route['panel-admin/syaratsurat/(:num)']='admin/syaratsurat/index/$1';
$route['panel-admin/files/view/(:any)']='admin/files/index/$1';

$route['lihat/surat/(:num)']='admin/files/document/$1';
$route['lihat/template']='admin/files/formated';

$route['(:any)']='welcome/halaman/$1';
$route['surat/(:any)']='welcome/surat/$1';
$route['panel-admin/(:any)'] = 'admin/$1';
$route['panel-admin/(:any)/(:any)'] = 'admin/$1/$2';
$route['panel-admin/(:any)/(:any)/(:num)'] = 'admin/$1/$2/$3';
$route['panel-user/surat/(:any)/(:any)']='suratuser/$1/$2';

