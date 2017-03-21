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
  |	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = '';
$route['404_override'] = 'welcome/not_found';
$route['translate_uri_dashes'] = FALSE;
//AUTH
$route['submit_login'] = 'authentication/authentication/submit_login';
$route['admin/logout'] = 'admin/authentication/logout';
$route['login'] = 'authentication/authentication/login';
$route['logout'] = 'authentication/authentication/logout';

//DASHBOARD
$route['admin'] = 'admin/admin/dashboard';
$route['admin/404'] = 'admin/admin/notfound';

//Kategori Properti
$route['admin/kategori_properti'] = 'admin/kategori_properti/data';
$route['admin/kategori_properti/add'] = 'admin/kategori_properti/add';
$route['admin/kategori_properti/delete/(:any)'] = 'admin/kategori_properti/delete_submit';
$route['admin/kategori_properti/add_submit'] = 'admin/kategori_properti/add_submit';
$route['admin/kategori_properti/update_submit'] = 'admin/kategori_properti/update_submit';

//Properti
$route['admin/properti'] = 'admin/properti/data';
$route['admin/properti/add'] = 'admin/properti/add';
$route['admin/properti/delete/(:any)'] = 'admin/properti/delete_submit';
$route['admin/properti/add_submit'] = 'admin/properti/add_submit';
$route['admin/properti/update_submit'] = 'admin/properti/update_submit';


//PENGAJAR
$route['admin/pengajar'] = 'admin/pengajar/data';
$route['admin/pengajar/detail/(:any)'] = 'admin/pengajar/detail';
$route['admin/pengajar/add'] = 'admin/pengajar/add';
$route['admin/pengajar/add_submit'] = 'admin/pengajar/add_submit';
$route['admin/pengajar/update_submit'] = 'admin/pengajar/update_submit';
$route['admin/pengajar/delete/(:any)'] = 'admin/pengajar/delete_submit';

