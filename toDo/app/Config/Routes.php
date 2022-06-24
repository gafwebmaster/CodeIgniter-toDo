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

//Login page
$routes->add('/', 'Users::index');

//After login
$routes->add('tasks', 'Tasks::index');

//Logout
$routes->add('users/logout', 'Users::logout');


//***********Manager can***********
//See all the users
$routes->add('users', 'Users::listUsers');

//Add new user
$routes->match(['get','post'], 'user/add', 'Users::addUser', ['filter' => 'noauth']);

//See his/her profile details
$routes->match(['get','post'], 'user/profile/(:num)', 'Users::profile/$1', ['filter' => 'auth']);

//Delete a user
$routes->add('users/delete/(:num)', 'Users::userDelete');

//Delete a task
$routes->add('task/delete/id', 'Tasks::taskDelete');

//Add a message task
$routes->add('task/addMessage', 'Tasks::addMessage');

//Export a tasks list
$routes->add('tasks/export', 'Tasks::tasksExport');

//See all users log details
$routes->add('logs', 'Logs::index');



//***********User can**************

//Recover his/her password
$routes->add('users/forgot_password', 'Users::forgotPassword');
$routes->add('users/reset_password', 'Users::resetPassword');

//Add a task
$routes->match(['get','post'], 'task/add', 'Tasks::addTask');

//See a task
$routes->add('task/(:num)', 'Tasks::taskDetails');

//Update a task
$routes->add('task/update/(:num)', 'Tasks::taskUpdate');

//Add a task
$routes->add('task_message/add', 'Tasks::taskMessageAdd');

//Mark a task as "Done"
$routes->add('tasks/markAsDone/(:num)', 'Tasks::markAsDone/$1');

//Update a task message
$routes->add('task_message/update/(:num)', 'Tasks::taskMessageUpdate');

//Delete a task message
$routes->add('task_message/delete/(:num)', 'Tasks::taskMessageDelete');


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
