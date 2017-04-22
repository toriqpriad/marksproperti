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
$route['default_controller'] = 'welcome/index';
//$route['404_override'] = 'welcome/not_found';
$route['translate_uri_dashes'] = FALSE;
//AUTH
$route['checkwebtoken'] = 'authentication/authentication/checkwebtoken';
$route['submit_login'] = 'authentication/authentication/submit_login';
$route['admin/logout'] = 'authentication/authentication/logout';
$route['login'] = 'authentication/authentication/login';
$route['logout'] = 'authentication/authentication/logout';

//DASHBOARD
$route['admin'] = 'admin/admin/dashboard';
$route['admin/404'] = 'admin/admin/notfound';
$route['admin/data_graphic'] = 'admin/admin/data_graphic';
$route['admin/data_table'] = 'admin/admin/data_table';
$route['admin/graphic'] = 'admin/admin/graphic';
$route['admin/history'] = 'admin/admin/history';

//setting
$route['admin/setting/website'] = 'admin/setting/website';
$route['admin/setting/account'] = 'admin/setting/account';
$route['admin/setting/update_website'] = 'admin/setting/update_website';
$route['admin/setting/update_account_password'] = 'admin/setting/update_account_password';
$route['admin/setting/update_account'] = 'admin/setting/update_account';



//front
$route['notfound'] = 'front/front/notfound';



