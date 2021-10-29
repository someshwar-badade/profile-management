<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

 


// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index',['as'=>'home']);
$routes->get('/register', 'Users::register',['as'=>'register']);
$routes->get('/forgot-password', 'Users::forgotPassword',['as'=>'forgot-password']);
$routes->get('/login', 'Users::login',['as'=>'login']);
$routes->get('/logout', 'Users::logout',['as'=>'logout']);
$routes->get('/user-dashboard', 'Users::userDashboard',['as'=>'user-dashboard']);
$routes->get('/user-settings', 'Users::settings',['as'=>'user-settings']);
// $routes->get('/employee_form', ['as'=>'employee_joining_form']);
$routes->get('/employee-joining-form', 'EmployeeForm::index',['as'=>'employeeJoiningForm']);
$routes->get('/api/employee-joining-form/(:num)', 'Api\Profiles::getJoingformDetails/$1',['as'=>'getJoingformDetails']);


$routes->resource('/api/profiles',['controller'=>'api\Profiles']);
$routes->post('/api/profiles/(:num)','Api\Profiles::update/$1');
$routes->post('/api/send-joining-form','Api\Profiles::sendJoiningForm');
$routes->get('/profiles', 'Profiles::index',['as'=>'profiles']);
$routes->get('/profile', 'Profiles::create',['as'=>'createprofile']);
$routes->get('/send-joining-form', 'Profiles::sendJoiningForm',['as'=>'sendJoiningForm']);

$routes->match(['get', 'post'],'/joining-form-verification/(:any)', 'Profiles::joiningFormVerification/$1',['as'=>'joiningFormVerification']);
$routes->get('/download-joining-form/(:any)', 'Profiles::downloadJoiningForm/$1',['as'=>'downloadJoiningForm']);
$routes->post('/api/employee-joining-form/save-employee-details', 'Api\Profiles::joiningFormSaveEmployeeDetails',['as'=>'joiningFormSaveEmployeeDetails']);
$routes->post('/api/employee-joining-form/save-education-details', 'Api\Profiles::joiningFormSaveEducationDetails',['as'=>'joiningFormSaveEducationDetails']);
$routes->post('/api/employee-joining-form/save-profetional-qualification', 'Api\Profiles::joiningFormSaveProfetionalQualification',['as'=>'joiningFormSaveProfetionalQualification']);

$routes->get('/api/joining-form-list', 'Api\Profiles::joiningFormList',['as'=>'joiningFormList']);
$routes->get('/editJoiningForm/(:num)', 'Profiles::createJoiningForm/$1',['as'=>'editJoiningForm']);
$routes->post('/api/joining-form-list/(:num)','Api\Profiles::update/$1');


$routes->get('/email-test', 'Profiles::emailTest');
$routes->get('/profile/(:num)/edit', 'Profiles::create/$1',['as'=>'editprofile']);

$routes->get('/api/get-skills-autocomplete','Api\Profiles::getSkillsAutocomplete');

$routes->group('/api',['namespace' => 'App\Controllers\Api'], function($routes)
{
	$routes->post('user/register', 'Users::register');
	$routes->post('user/forgot-password', 'Users::forgotpassword');
	$routes->post('user/login', 'Users::login');
	$routes->post('user/signin', 'Users::login');
	$routes->post('user/logout', 'Users::logout');
	$routes->get('user/(:num)', 'Users::getUserDetails/$1');
	
	
	$routes->post('user/profile/change-password', 'UserProfile::changePassword');

});




$routes->get('/page-not-found', 'Home::pageNotFound',['as'=>'pageNotFound']);


// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
