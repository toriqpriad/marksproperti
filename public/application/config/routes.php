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
//front
//$route['default_controller'] = 'front/front/home';
//$route['404_override'] = 'welcome/not_found';
$route['translate_uri_dashes'] = FALSE;
//AUTH
$route['checkwebtoken'] = 'authentication/authentication/checkwebtoken';
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
$route['admin/properti/detail/(:any)'] = 'admin/properti/detail';

//artikel
$route['admin/artikel'] = 'admin/artikel/data';
$route['admin/artikel/add'] = 'admin/artikel/add';
$route['admin/artikel/delete/(:any)'] = 'admin/artikel/delete_submit';
$route['admin/artikel/add_submit'] = 'admin/artikel/add_submit';
$route['admin/artikel/update_submit'] = 'admin/artikel/update_submit';
$route['admin/artikel/detail/(:any)'] = 'admin/artikel/detail';

//iklan
$route['admin/iklan'] = 'admin/iklan/data';
$route['admin/iklan/add'] = 'admin/iklan/add';
$route['admin/iklan/delete/(:any)'] = 'admin/iklan/delete_submit';
$route['admin/iklan/add_submit'] = 'admin/iklan/add_submit';
$route['admin/iklan/update_submit'] = 'admin/iklan/update_submit';
$route['admin/iklan/detail/(:any)'] = 'admin/iklan/detail';


//portfolio
$route['admin/portfolio'] = 'admin/portfolio/data';
$route['admin/portfolio/add'] = 'admin/portfolio/add';
$route['admin/portfolio/delete/(:any)'] = 'admin/portfolio/delete_submit';
$route['admin/portfolio/add_submit'] = 'admin/portfolio/add_submit';
$route['admin/portfolio/update_submit'] = 'admin/portfolio/update_submit';
$route['admin/portfolio/detail/(:any)'] = 'admin/portfolio/detail';

//developer
$route['admin/developer'] = 'admin/developer/data';
$route['admin/developer/add'] = 'admin/developer/add';
$route['admin/developer/delete/(:any)'] = 'admin/developer/delete_submit';
$route['admin/developer/add_submit'] = 'admin/developer/add_submit';
$route['admin/developer/update_submit'] = 'admin/developer/update_submit';
$route['admin/developer/detail/(:any)'] = 'admin/developer/detail';

//setting
$route['admin/setting/website'] = 'admin/setting/website';
$route['admin/setting/account'] = 'admin/setting/account';
$route['admin/setting/update_website'] = 'admin/setting/update_website';
$route['admin/setting/update_account_password'] = 'admin/setting/update_account_password';
$route['admin/setting/update_account'] = 'admin/setting/update_account';

//front
$route['notfound'] = 'front/front/notfound';
$route['home'] = 'front/home/index';
$route['properti/kategori/(:any)'] = 'front/properti/kategori';
$route['properti/detail/(:any)'] = 'front/properti/detail';
$route['artikel'] = 'front/artikel/all';
$route['artikel/detail/(:any)'] = 'front/artikel/detail';
$route['foto'] = 'front/galeri/foto';
$route['video'] = 'front/galeri/video';
$route['portfolio'] = 'front/galeri/portfolio';
$route['konsultan_projek'] = 'front/home/konsultan_projek';
$route['vendor'] = 'front/vendor/all';
$route['tentang_kami'] = 'front/home/tentang_kami';
$route['search_result'] = 'front/home/search_submit';


