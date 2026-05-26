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
$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['auth'] = 'auth';
$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';

$route['dashboard'] = 'dashboard';

$route['master-data'] = 'dashboard';
$route['master-data/categories'] = 'categories';
$route['master-data/categories/create'] = 'categories/create';
$route['master-data/categories/edit/(:num)'] = 'categories/edit/$1';
$route['master-data/categories/delete/(:num)'] = 'categories/delete/$1';
$route['master-data/customers'] = 'customers';
$route['master-data/customers/create'] = 'customers/create';
$route['master-data/customers/edit/(:num)'] = 'customers/edit/$1';
$route['master-data/customers/delete/(:num)'] = 'customers/delete/$1';
$route['master-data/products'] = 'products';
$route['master-data/products/create'] = 'products/create';
$route['master-data/products/edit/(:num)'] = 'products/edit/$1';
$route['master-data/products/delete/(:num)'] = 'products/delete/$1';

$route['transaksi'] = 'transactions';
$route['transaksi/tambah'] = 'transactions/add';
$route['transaksi/hapus/(:num)'] = 'transactions/remove/$1';
$route['transaksi/bersihkan'] = 'transactions/clear';
$route['transaksi/checkout'] = 'transactions/checkout';
$route['transaksi/struk/(:num)'] = 'transactions/receipt/$1';
$route['transaksi/riwayat'] = 'transactions/history';
$route['transaksi/laporan'] = 'reports';
