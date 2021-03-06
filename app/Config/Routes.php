<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');         //Can change this to any controller
//$routes->setDefaultController('UserCrud');       //now the default controller is UserCrud
//$routes->get('/', 'UserCrud::index');  //after changing default controller this route has to set
$routes->setDefaultMethod('index');              //can change this default method to any other method of default controller
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// CRUD RESTful Routes
$routes->get('users', 'UserCrud::index');
$routes->get('user/add', 'UserCrud::create');
$routes->post('user/add', 'UserCrud::store');
$routes->get('user/edit/(:num)', 'UserCrud::singleUser/$1');
$routes->post('user/edit/(:num)', 'UserCrud::update');
$routes->get('delete/(:num)', 'UserCrud::delete/$1');

$routes->get('/register', 'RegisterController::index');
$routes->post('/register', 'RegisterController::store');
$routes->get('/login', 'LoginController::index');
$routes->get('/dashboard', 'DashboardController::index',['filter' => 'routeFilter']);
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
