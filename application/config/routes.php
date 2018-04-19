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
$diller = 'tr|ar';
$route['default_controller'] = 'Pages/index';
$route['index.html'] = 'Pages/index';

$route['admin'] = 'admin/Home';
$route['admin/(:any)'] = 'admin/$1';
$route['Auth'] = 'Auth';
$route['Auth/(:any)'] = 'Auth/$1';


$route['hook'] = 'Page1/hussam';


$route['^('.$diller.')/requests'] = 'Requests';
$route['^('.$diller.')/requests/(:any)'] = 'Requests/$2';

$route['^('.$diller.')/diller'] = 'Pages/languages';

$route['^('.$diller.')/search'] = 'Pages/search';
$route['^('.$diller.')/villa-search'] = 'Pages/searchVilla';
$route['^('.$diller.')/reservation'] = 'Pages/sentReservation';
$route['^('.$diller.')'] = 'Pages/index';
$route['^('.$diller.')/contact'] = 'Pages/contact/$1';
$route['^('.$diller.')/tags/(:any)'] = 'Pages/tags/$2';

$route['^('.$diller.')/(:any)'] = 'Pages/page/$2';
$route['^('.$diller.')/(:any)/(:num)/editor'] = 'Pages/page/$2';
$route['^('.$diller.')/(:any)/(:num)'] = 'Pages/page/$2';


//// tr
$route['requests'] = 'Requests';
$route['requests/(:any)'] = 'Requests/$1';
$route['diller'] = 'Pages/languages';
$route['search'] = 'Pages/search';
$route['contact'] = 'Pages/contact/$1';
$route['thanks'] = 'Pages/thanks/';
$route['tags/(:any)'] = 'Pages/tags/$1';
$route['homepage/(:num)'] = 'Pages/index';
$route['homepage'] = 'Pages/index';
$route['(:any)'] = 'Pages/page/$1';
$route['(:any)/(:num)/editor'] = 'Pages/page/$1';
$route['(:any)/(:num)'] = 'Pages/page/$1';
//// tr

$route['404_override'] = 'Errors/error404';
$route['translate_uri_dashes'] = FALSE;
