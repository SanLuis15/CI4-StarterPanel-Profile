<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::index');
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::index');
$routes->get('logout', 'Auth::logout');
$routes->get('blocked', 'Auth::forbiddenPage');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::registration');

$routes->get('dashboard', 'Home::index');
$routes->get('dashboard-v2', 'Home::dashboardV2');
$routes->get('dashboard-v3', 'Home::dashboardV3');

// Profile routes
$routes->get('profile', 'ProfileController::show');
$routes->get('profile/edit', 'ProfileController::edit');
$routes->post('profile/update', 'ProfileController::update');

// Students CRUD routes
$routes->get('students', 'Student::index');
$routes->get('students/show/(:num)', 'Student::show/$1');
$routes->get('students/edit/(:num)', 'Student::edit/$1');
$routes->post('students/store', 'Student::store');
$routes->post('students/update/(:num)', 'Student::update/$1');
$routes->post('students/delete/(:num)', 'Student::delete/$1');

// Records CRUD routes
$routes->get('records', 'Records::index');
$routes->get('records/create', 'Records::create');
$routes->get('records/show/(:num)', 'Records::show/$1');
$routes->get('records/edit/(:num)', 'Records::edit/$1');
$routes->post('records/store', 'Records::store');
$routes->post('records/update/(:num)', 'Records::update/$1');
$routes->post('records/delete/(:num)', 'Records::delete/$1');

// Setting Routes
$routes->group('users', static function ($routes) {
    $routes->get('/', 'Settings::users');
    $routes->post('create-role', 'Settings::createRole');
    $routes->post('update-role', 'Settings::updateRole');
    $routes->delete('delete-role/(:num)', 'Settings::deleteRole/$1');

    $routes->get('role-access', 'Settings::roleAccess');
    $routes->post('create-user', 'Settings::createUser');
    $routes->post('update-user', 'Settings::updateUser');
    $routes->delete('delete-user/(:num)', 'Settings::deleteUser/$1');

    $routes->post('change-menu-permission', 'Settings::changeMenuPermission');
    $routes->post('change-menu-category-permission', 'Settings::changeMenuCategoryPermission');
    $routes->post('change-submenu-permission', 'Settings::changeSubMenuPermission');
});

$routes->group('menu-management', static function ($routes) {
    $routes->get('/', 'Settings::menuManagement');
    $routes->post('create-menu-category', 'Settings::createMenuCategory');
    $routes->post('create-menu', 'Settings::createMenu');
    $routes->post('create-submenu', 'Settings::createSubMenu');
});
$routes->get('menu','Menu::index');
