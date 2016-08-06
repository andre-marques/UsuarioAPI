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
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'usuario';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

// Routes for usuario
$route['usuario']['get'] = 'usuario/index';
$route['usuario/(:num)']['get'] = 'usuario/find/$1';
$route['usuario']['post'] = 'usuario/index';
$route['usuario/(:num)']['put'] = 'usuario/index/$1';
$route['usuario/(:num)']['delete'] = 'usuario/index/$1';


$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

// Routes for login
$route['login']['get'] = 'login/index';
$route['login/(:num)']['get'] = 'login/find/$1';
$route['login']['post'] = 'login/index';
$route['login/(:num)']['put'] = 'login/index/$1';
$route['login/(:num)']['delete'] = 'login/index/$1';


$route['default_controller'] = 'alimento';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

// Routes for alimento
$route['alimento']['get'] = 'alimento/index';
$route['alimento/(:num)']['get'] = 'alimento/find/$1';
$route['alimento']['post'] = 'alimento/index';
$route['alimento/(:num)']['put'] = 'alimento/index/$1';
$route['alimento/(:num)']['delete'] = 'alimento/index/$1';
$route['alimento/qrcode']['get'] = 'alimento/index';
$route['alimento/qrcode/(:num)']['get'] = 'alimento/qrcode/$1';

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
//$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
//$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
