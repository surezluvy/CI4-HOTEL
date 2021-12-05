<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Admin::index');
$routes->get('/admin', 'Admin::index');

// Customer
$routes->get('/admin/customer/add', 'User::add/user');
$routes->add('/admin/customer/addProcess', 'User::addProcess/user');
$routes->get('/admin/customer/edit/(:num)', 'User::edit/$1/user');
$routes->add('/admin/customer/editProcess', 'User::editProcess/user');
$routes->get('/admin/customer/delete/(:num)', 'User::deleteData/$1/user');

// Admin
$routes->get('/admin/admin/add', 'User::add/admin');
$routes->add('/admin/admin/addProcess', 'User::addProcess/admin');
$routes->get('/admin/admin/edit/(:num)', 'User::edit/$1/admin');
$routes->add('/admin/admin/editProcess', 'User::editProcess/admin');
$routes->get('/admin/admin/delete/(:num)', 'User::deleteData/$1/admin');

// Hotel
$routes->get('/admin/hotel/add', 'Hotel::add');
$routes->add('/admin/hotel/addProcess', 'Hotel::addProcess');
$routes->get('/admin/hotel/edit/(:num)', 'Hotel::edit/$1');
$routes->add('/admin/hotel/editProcess', 'Hotel::editProcess');
$routes->get('/admin/hotel/delete/(:num)', 'Hotel::deleteData/$1');

// Hotel Image
$routes->get('/admin/image/(:num)', 'Admin::image/$1');
$routes->get('/admin/image/add/(:num)', 'Image::add/$1');
$routes->add('/admin/image/addProcess', 'Image::addProcess');
$routes->get('/admin/image/delete/(:num)', 'Image::deleteData/$1');

// Booking
$routes->get('/admin/booking/add', 'Booking::add');
$routes->add('/admin/booking/addProcess', 'Booking::addProcess');
$routes->get('/admin/hotel/edit/(:num)', 'Hotel::edit/$1');
$routes->add('/admin/hotel/editProcess', 'Hotel::editProcess');
$routes->get('/admin/booking/delete/(:num)', 'Booking::deleteData/$1');


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
