<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->get('/', 'Home::index');

// FAQ Page
$routes->get('faq/(:any)', 'FAQ::index/$1');

// login verification
$routes->group('login', function ($login) {
	$login->get('to/(:any)', 'Login::index/$1');
	$login->get('/', 'Login::index');
	$login->post('/', 'Login::auth');
});


// logout
$routes->group('logout', function ($logout) {
	$logout->get('/', 'Login::logout');
	$logout->get('(:any)', 'Login::logout');
});


// Register verification
$routes->group('register', function ($register) {
	// request verification code
	$register->post('/', 'EmailVerification::requestCode');

	// verify
	$register->group('verify', function ($verify) {
		// redirect to confirm verification code page
		$verify->get('/', 'EmailVerification::verify');

		// validate the verification code
		$verify->post('/', 'EmailVerification::verify');
	});

	// create new account
	$register->group('new', function ($new) {
		$new->get('/', 'Register::new');
		$new->post('/', 'Register::insert');
	});

	// redirect to register page
	$register->get('(:any)', 'Register::index');
});


// Account Page
$routes->group('account', function ($account) {
	$account->get('change', function ($change) {
		$change->get('(:alpha)/(:alphanum)', 'Account::change/$1/$2');
	});
});


// Address Page
$routes->group('address', function ($address) {
	$address->post('new', 'Address::insert');
	$address->post('default', 'Address::setDefault');
	$address->delete('(:alphanum)', 'Address::delete/$1');
});


// Indonesia Territory API
$routes->group('idn-administrative-area', function ($root) {
	$root->get('/', 'IdnTerritory::index');

	$root->group('(:alpha)', function ($scope) {
		// get first 5000 data in a scope
		$scope->get('/', 'IdnTerritory::list/$1');
		$scope->get('page', 'IdnTerritory::list/$1');

		// get every 5000 data in a scope
		$scope->get('page/(:num)', 'IdnTerritory::list/$1/$2');

		// get every n-data in a scope
		$scope->get('page/(:num)/(:num)', 'IdnTerritory::list/$1/$2/$3');

		// get a specified data in a scope
		$scope->get('(:num)', 'IdnTerritory::get/$1/$2');

		// get sub-area data from certain parent scope
		$scope->get('(:num)/sub', 'IdnTerritory::subareas/$1/$2');

		// get super-area data from certain parent scope
		$scope->get('(:num)/sup', 'IdnTerritory::superareas/$1/$2');

		// search every 5000 data in a scope by its name
		$scope->get('s/(:segment)', 'IdnTerritory::searchByName/$1/$2');
		$scope->get('s/(:segment)/(:num)', 'IdnTerritory::searchByName/$1/$2/$3');
		$scope->get('(:any)', 'IdnTerritory::searchByName/$1/$2');
	});
});


/**
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
