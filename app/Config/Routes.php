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
// $routes->get('/register', 'Users::register',['as'=>'register']);
$routes->get('/sign-up', 'Users::signUp',['as'=>'signUp']);
$routes->post('/api/sign-up', 'Api\Users::register',['as'=>'register']);
$routes->match(['get', 'post'],'/forgot-password', 'Users::forgotPassword',['as'=>'forgot-password']);
$routes->get('/login', 'Users::login',['as'=>'login']);
$routes->post('/api/send-verification-code', 'Api\Users::sendVerificationCode',['as'=>'sendVerificationCode']);
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
$routes->get('/profile/(:num)', 'Profiles::edit/$1',['as'=>'editProfile']);
$routes->get('/send-joining-form', 'Profiles::sendJoiningForm',['as'=>'sendJoiningForm']);
$routes->get('/uploaded-documents/(:any)/(:any)', 'UploadedDocuments::index/$1/$2',['as'=>'UploadedDocuments']);

$routes->match(['get', 'post'],'/joining-form-verification', 'Profiles::joiningFormVerification',['as'=>'joiningFormVerification2']);
$routes->match(['get', 'post'],'/joining-form-verification/(:any)', 'Profiles::joiningFormVerification/$1',['as'=>'joiningFormVerification']);
$routes->get('/download-joining-form/(:any)', 'Profiles::downloadJoiningForm/$1',['as'=>'downloadJoiningForm']);
$routes->get('/download-pre-joining-document/(:any)/(:any)', 'Profiles::downloadPrejoiningDocuments/$1/$2',['as'=>'downloadPrejoiningDocuments']);
$routes->get('/cv', 'Profiles::cv',['as'=>'cv']);
$routes->get('/download-my-joining-form', 'Profiles::downloadMyJoiningForm',['as'=>'downloadMyJoiningForm2']);
$routes->get('/download-my-joining-form/(:any)', 'Profiles::downloadMyJoiningForm/$1',['as'=>'downloadMyJoiningForm']);
$routes->post('/api/employee-joining-form/save-employee-details', 'Api\Profiles::joiningFormSaveEmployeeDetails',['as'=>'joiningFormSaveEmployeeDetails']);
$routes->post('/api/employee-joining-form/save-education-details', 'Api\Profiles::joiningFormSaveEducationDetails',['as'=>'joiningFormSaveEducationDetails']);
$routes->post('/api/employee-joining-form/remove-education-details', 'Api\Profiles::joiningFormRemoveEducationDetails',['as'=>'joiningFormRemoveEducationDetails']);
$routes->post('/api/employee-joining-form/save-gap-declaration', 'Api\Profiles::joiningFormSaveGapdeclaration',['as'=>'joiningFormSaveGapdeclaration']);
$routes->post('/api/employee-joining-form/remove-gap-declaration', 'Api\Profiles::joiningFormRemoveGapdeclaration',['as'=>'joiningFormRemoveGapdeclaration']);
$routes->post('/api/employee-joining-form/save-mediclaim', 'Api\Profiles::joiningFormSaveMediclaim',['as'=>'joiningFormSaveMediclaim']);
$routes->post('/api/employee-joining-form/remove-mediclaim', 'Api\Profiles::joiningFormRemoveMediclaim',['as'=>'joiningFormRemoveMediclaim']);
$routes->post('/api/employee-joining-form/save-professional-qualification', 'Api\Profiles::joiningFormSaveProfetionalQualification',['as'=>'joiningFormSaveProfetionalQualification']);
$routes->post('/api/employee-joining-form/remove-professional-qualification', 'Api\Profiles::joiningFormRemoveProfetionalQualification',['as'=>'joiningFormRemoveProfetionalQualification']);
$routes->post('/api/employee-joining-form/save-employment-history', 'Api\Profiles::joiningFormSaveEmploymentHistory',['as'=>'joiningFormSaveEmploymentHistory']);
$routes->post('/api/employee-joining-form/save-employment-history_', 'Api\Profiles::joiningFormSaveEmploymentHistory_',['as'=>'joiningFormSaveEmploymentHistory_']);
$routes->delete('/api/employee-joining-form/remove-employment-history_', 'Api\Profiles::joiningFormRemoveEmploymentHistory_',['as'=>'joiningFormRemoveEmploymentHistory_']);
$routes->post('/api/employee-joining-form/save-background-information', 'Api\Profiles::joiningFormSaveBackgroundInfo',['as'=>'joiningFormSaveBackgroundInfo']);
$routes->post('/api/employee-joining-form/accept-declaration', 'Api\Profiles::joiningFormAcceptDeclaration',['as'=>'joiningFormAcceptDeclaration']);
$routes->post('/api/employee-joining-form/documents', 'Api\Profiles::joiningUploadDocument',['as'=>'joiningUploadDocument']);
$routes->post('/api/employee-joining-form/remove-document', 'Api\Profiles::removeDocument',['as'=>'removeDocument']);
$routes->post('/api/employee-joining-form/send-link', 'Api\Profiles::sendJoiningFormLink',['as'=>'sendJoiningFormLink']);
$routes->post('/api/employee-joining-form/approve', 'Api\Profiles::approveJoiningForm',['as'=>'approveJoiningForm']);

$routes->get('/api/joining-form-list', 'Api\Profiles::joiningFormList',['as'=>'joiningFormList']);
$routes->get('/editJoiningForm/(:num)', 'Profiles::createJoiningForm/$1',['as'=>'editJoiningForm']);
$routes->post('/api/joining-form-list/(:num)','Api\Profiles::update/$1');

//My profile
$routes->get('/my-profile', 'Profiles::createMyProfile',['as'=>'createMyProfile']);
$routes->post('/my-profile', 'Profiles::createMyProfile',['as'=>'createMyProfilePost']);
$routes->get('/api/my-profile', 'Api\Profiles::getMyProfile',['as'=>'getMyProfile']);
$routes->post('/api/my-profile/save-employee-details', 'Api\Profiles::updateMyProfile',['as'=>'updateMyProfile']);
$routes->post('/api/my-profile/save-education-details', 'Api\Profiles::profileSaveEducationDetails',['as'=>'profileSaveEducationDetails']);
$routes->post('/api/my-profile/remove-education-details', 'Api\Profiles::profileRemoveEducationDetails',['as'=>'profileRemoveEducationDetails']);
$routes->post('/api/my-profile/save-professional-qualification', 'Api\Profiles::profileSaveProfetionalQualification',['as'=>'profileSaveProfetionalQualification']);
$routes->post('/api/my-profile/remove-professional-qualification', 'Api\Profiles::profileRemoveProfetionalQualification',['as'=>'profileRemoveProfetionalQualification']);
$routes->post('/api/my-profile/save-employment-history', 'Api\Profiles::profileSaveEmploymentHistory',['as'=>'profileSaveEmploymentHistory']);
$routes->get('/api/testing', 'Api\Profiles::testing');
$routes->post('/api/my-profile/documents', 'Api\Profiles::myProfileUploadDocument',['as'=>'myProfileUploadDocument']);
$routes->post('/api/my-profile/remove-document', 'Api\Profiles::myProfileRemoveDocument',['as'=>'myProfileRemoveDocument']);
$routes->get('/download-my-profile', 'Profiles::downloadMyProfile',['as'=>'downloadMyProfile']);
$routes->get('/download-my-resume', 'Profiles::downloadMyResume',['as'=>'downloadMyResume']);
$routes->get('/download-my-resume-preview', 'Profiles::downloadMyResumePreview',['as'=>'downloadMyResumePreview']);
$routes->get('/get-font-image', 'FontImage::index',['as'=>'getFontImage']);

//my joining form
$routes->get('/my-joining-form', 'MyJoiningForm::index',['as'=>'myJoiningForm']);
$routes->get('/api/my-joining-form', 'Api\MyJoiningForm::getJoingformDetails',['as'=>'getMyJoingformDetails']);
$routes->post('/api/my-joining-form/save-employee-details', 'Api\MyJoiningForm::joiningFormSaveEmployeeDetails',['as'=>'myJoiningFormSaveEmployeeDetails']);
$routes->post('/api/my-joining-form/save-education-details', 'Api\MyJoiningForm::joiningFormSaveEducationDetails',['as'=>'myJoiningFormSaveEducationDetails']);
$routes->post('/api/my-joining-form/remove-education-details', 'Api\MyJoiningForm::joiningFormRemoveEducationDetails',['as'=>'myJoiningFormRemoveEducationDetails']);
$routes->post('/api/my-joining-form/save-gap-declaration', 'Api\MyJoiningForm::joiningFormSaveGapdeclaration',['as'=>'myJoiningFormSaveGapdeclaration']);
$routes->post('/api/my-joining-form/remove-gap-declaration', 'Api\MyJoiningForm::joiningFormRemoveGapdeclaration',['as'=>'myJoiningFormRemoveGapdeclaration']);
$routes->post('/api/my-joining-form/save-mediclaim', 'Api\MyJoiningForm::joiningFormSaveMediclaim',['as'=>'myJoiningFormSaveMediclaim']);
$routes->post('/api/my-joining-form/remove-mediclaim', 'Api\MyJoiningForm::joiningFormRemoveMediclaim',['as'=>'myJoiningFormRemoveMediclaim']);
$routes->post('/api/my-joining-form/save-professional-qualification', 'Api\MyJoiningForm::joiningFormSaveProfetionalQualification',['as'=>'myJoiningFormSaveProfetionalQualification']);
$routes->post('/api/my-joining-form/remove-professional-qualification', 'Api\MyJoiningForm::joiningFormRemoveProfetionalQualification',['as'=>'myJoiningFormRemoveProfetionalQualification']);
$routes->post('/api/my-joining-form/save-employment-history', 'Api\MyJoiningForm::joiningFormSaveEmploymentHistory',['as'=>'myJoiningFormSaveEmploymentHistory']);
$routes->post('/api/my-joining-form/save-employment-history_', 'Api\MyJoiningForm::joiningFormSaveEmploymentHistory_',['as'=>'myJoiningFormSaveEmploymentHistory_']);
$routes->delete('/api/my-joining-form/remove-employment-history_', 'Api\MyJoiningForm::joiningFormRemoveEmploymentHistory_',['as'=>'myJoiningFormRemoveEmploymentHistory_']);
$routes->post('/api/my-joining-form/save-background-information', 'Api\MyJoiningForm::joiningFormSaveBackgroundInfo',['as'=>'myJoiningFormSaveBackgroundInfo']);
$routes->post('/api/my-joining-form/accept-declaration', 'Api\MyJoiningForm::joiningFormAcceptDeclaration',['as'=>'myJoiningFormAcceptDeclaration']);
$routes->post('/api/my-joining-form/documents', 'Api\MyJoiningForm::joiningUploadDocument',['as'=>'myJoiningUploadDocument']);
$routes->post('/api/my-joining-form/remove-document', 'Api\MyJoiningForm::removeDocument',['as'=>'myJoingFormremoveDocument']);



//[interviews]
//interviews/:profileid
$routes->get('/interviews/(:num)', 'Interviews::index/$1',['as'=>'interviews']);

//api/interviews/:profileid
$routes->get('/api/interviews/(:num)', 'Api\Interviews::getInterviews/$1',['as'=>'getInterviews']);
$routes->post('/api/interviews/(:num)', 'Api\Interviews::saveInterview/$1',['as'=>'saveInterview']);
$routes->delete('/api/interviews/(:num)', 'Api\Interviews::delete/$1',['as'=>'deleteInterview']);
//api/interviews/:profileid/:id
$routes->get('/api/interviews/(:num)/(:num)', 'Api\Interviews::getInterviewDetails/$1/$2',['as'=>'getInterviewDetails']);


//[Job Positions]
$routes->get('/job-positions', 'JobPositions::index',['as'=>'JobPositions']);
$routes->get('/api/job-positions', 'Api\JobPositions::index',['as'=>'getJobPositions']);
$routes->get('/api/job-position/(:num)', 'Api\JobPositions::getJobPositionDetails/$1',['as'=>'getJobPositionDetails']);
$routes->post('/api/job-position', 'Api\JobPositions::saveJobPosition',['as'=>'saveJobPosition']);
$routes->get('/api/job-position-matching-profiles/(:num)', 'Api\JobPositions::getMatchingProfiles/$1',['as'=>'getMatchingProfiles']);
$routes->post('/api/save-shortlist-candidates', 'Api\JobPositions::saveShortlistCandidates',['as'=>'saveShortlistCandidates']);
$routes->get('/apply-for-job', 'JobPositions::applyForJob',['as'=>'applyForJob']);


//user
$routes->get('/users', 'Users::index',['as'=>'users']);
$routes->match(['get'],'/user', 'Users::user',['as'=>'newUser']);
$routes->match(['get'],'/user/(:num)', 'Users::getUser/$1',['as'=>'getUSer']);
$routes->post('/api/user', 'Api\UserManagement::create',['as'=>'api.user_create']);
$routes->get('/api/user/(:num)', 'Api\UserManagement::editUser/$1',['as'=>'api.editUser']);
$routes->put('/api/user', 'Api\UserManagement::update',['as'=>'api.update']);
// $routes->get('user/(:num)', 'Users::getUserDetails/$1');
// $routes->match(['get'],'/user/(:num)', 'Users::user/$1',['as'=>'editUser']);
$routes->match(['get', 'post'],'/api/users', 'Api\UserManagement::index',['as'=>'api.users']);

//roles
$routes->get('/roles', 'Roles::index',['as'=>'roles']);
$routes->get('/api/capabilities/(:num)', 'Api\Roles::capabilities/$1',['as'=>'capabilities']);
$routes->post('/api/capabilities/(:num)', 'Api\Roles::saveCapabilities/$1',['as'=>'saveCapabilities']);

// $routes->get('/email-test', 'Profiles::emailTest');
$routes->get('/email-test', 'Home::emailTest');
$routes->get('/profile/(:num)/edit', 'Profiles::create/$1',['as'=>'editprofile']);

$routes->get('/api/get-skills-autocomplete','Api\Profiles::getSkillsAutocomplete');
$routes->post('/api/get-skills-autocomplete','Api\Profiles::addSkill');


//Clients
$routes->get('/clients', 'Clients::index',['as'=>'clients']);
$routes->get('/api/clients', 'Api\Clients::index',['as'=>'getClients']);
$routes->get('/api/clients/contacts/(:num)', 'Api\Clients::getClientContact/$1',['as'=>'getClientContact']);
$routes->post('/api/clients/contacts', 'Api\Clients::saveClientContact',['as'=>'saveClientContact']);
$routes->delete('/api/clients/contacts', 'Api\Clients::deleteClientContact',['as'=>'deleteClientContact']);
$routes->get('/api/clients/(:num)', 'Api\Clients::getDetails/$1',['as'=>'getClientDetails']);
$routes->post('/api/clients', 'Api\Clients::saveClient',['as'=>'saveClient']);

//Logs
$routes->get('/logs', 'Logs::index',['as'=>'logs']);
$routes->get('/api/logs', 'Api\Logs::index',['as'=>'getLogs']);

$routes->group('/api',['namespace' => 'App\Controllers\Api'], function($routes)
{
	$routes->post('user/register', 'Users::register');
	$routes->post('user/forgot-password', 'Users::forgotpassword');
	$routes->post('user/login', 'Users::login');
	$routes->post('user/signin', 'Users::login');
	$routes->post('user/logout', 'Users::logout');
	
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
