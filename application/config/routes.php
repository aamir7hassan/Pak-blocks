<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';

$route['404_override'] = 'custom404';
$route['translate_uri_dashes'] = FALSE;

$route['faq'] = 'home/faq';
$route['about-us'] = 'home/about_us';
$route['contact-us'] = 'home/contact_us';
$route['products'] = 'home/products';
$route['projects'] = 'home/projects';

/*********  ADMIN  *********/
$prefix = "admin/";
$route['admin'] 	        = $prefix.'dashboard/index';
$route['login/process'] 	= 'login/process';
$route['logout'] 			= 'login/logout';
$route['admin/update-profile'] = 'login/update_profile';
$route['admin/index'] 		= $prefix.'dashboard/index';
$route['admin/dashboard'] 	= $prefix.'dashboard/index'; 

$route['admin/reviews'] 	= $prefix.'dashboard/reviews';
$route['admin/products'] 	= $prefix.'dashboard/products';
$route['admin/add-product'] = $prefix.'dashboard/add_product';
$route['admin/edit-product/(:num)'] = $prefix.'dashboard/edit_product/$1';
$route['admin/projects'] 	    = $prefix.'dashboard/projects';
$route['admin/add-project'] = $prefix.'dashboard/add_project';
$route['admin/edit-project/(:num)'] = $prefix.'dashboard/edit_project/$1';
