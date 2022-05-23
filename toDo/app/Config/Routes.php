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
$routes->setDefaultController('Users');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->add('/', 'Users::index');
$routes->add('users', 'Users::listUsers');
$routes->add('users/profile', 'Users::profile');
$routes->add('user/forgot_password', 'Users::forgotPassword');
$routes->add('user/reset_password', 'Users::resetPassword');
$routes->match(['get','post'], 'user/add', 'Users::addUser');
$routes->add('user/(:num)', 'Users::userDetails');
$routes->match(['get','post'],'user/update', 'Users::userUpdate');
$routes->add('user/delete/(:num)', 'Users::userDelete');
$routes->add('users/logout', 'Users::logout');

$routes->add('tasks', 'Tasks::index');
$routes->add('task/add', 'Tasks::addTask');
$routes->add('task/(:num)', 'Tasks::taskDetails');
$routes->add('task/update/(:num)', 'Tasks::taskUpdate');
$routes->add('task/delete/id', 'Tasks::taskDelete');
$routes->add('tasks/export', 'Tasks::tasksExport');
$routes->add('task_message/add', 'Tasks::taskMessageAdd');
$routes->add('task_message/update/(:num)', 'Tasks::taskMessageUpdate');
$routes->add('task_message/delete/(:num)', 'Tasks::taskMessageDelete');

$routes->add('logs', 'Logs::index');

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
