<?php

// Route::get('/spams/receive/{from}/{to}/{text}/{char}/{code}/{time}/{smsc}', 'SpamsController@receive');//receiving messages
// Route::get('/spams/{spams}/delivery',										'SpamsController@delivery');//receiving delivery reports

Route::group(['middleware' => 'web'], function () {



	// Authentication routes...
	Route::post('login', 'AuthController@login');
	Route::get('logout', 'AuthController@logout');
	Route::get('login', 'AuthController@showLoginForm');
	// Registration routes...
	// Route::get('register', 'AuthController@getRegister');
	// Route::post('register', 'AuthController@postRegister');



		Route::group(['middleware' => 'auth'], function () {



			//PAGES
			Route::get('/', 		'CasesController@index');
			Route::get('/about', 	'PagesController@about');
			Route::get('/test', 	'PagesController@test');
			Route::get('/send', 	'PagesController@send');
			Route::get('/settings',	'PagesController@settingsShow');
			Route::post('/settings','PagesController@settingsSave');



				//admin section
				Route::get('/admin',				'PagesController@adminShow');
				Route::get('/admin/phpinfo',		'PagesController@adminPhpinfoShow');
				Route::get('/admin/users',			'PagesController@adminUsersShow');
				Route::get('/admin/ldapusers',		'PagesController@getUsersFromLdap');
				Route::get('/admin/syncldapusers',	'PagesController@syncUsersFromLdap');



			//RESOURCES

				//users
				Route::resource('/users',			'UsersController');
				Route::get('/profile',				'UsersController@profile');

				//cases
				Route::resource('/cases',			'CasesController');
					//Route::patch('/cases/{cases}/updatePerformers', 'CasesController@updatePerformers')->name('cases.updatePerformers');
					//Route::patch('/cases/{cases}/updateMembers', 	'CasesController@updateMembers')->name('cases.updateMembers');

				//files
				Route::resource('/files',			'FilesController');
					Route::get('/getoriginal/{id}',		'FilesController@getOriginal');
					Route::get('/getthumbnail/{id}',	'FilesController@getThumbnail');

				//messages
				Route::resource('/messages',		'MessagesController');

				// Route::resource('/sendings',						'SendingsController');
				// 	Route::post('/sendings/{sendings}/send',		'SendingsController@send');
				// Route::resource('/gateways',						'GatewaysController');
				// 	Route::post('/gateways/{gateways}',				'GatewaysController@restart');
				// 	Route::post('/gateways',						'GatewaysController@send');
				// 	Route::post('/gateways/{gateways}/balance',		'GatewaysController@checkbalance');
				// Route::resource('/modems',							'ModemsController');
				// 	Route::post('/modems/send',						'ModemsController@send');
				// Route::resource('/numbers',							'NumbersController');
				// Route::get('/numbersclean',							'NumbersController@clean2');
				// Route::resource('/rounds',							'RoundsController');
				// Route::resource('/operators',						'OperatorsController');
				// Route::post('/rounds/{rounds}/task',				'RoundsController@task');
				// Route::resource('/tasks',							'TasksController');
				// Route::resource('/spams',							'SpamsController');
				// Route::resource('/sets',							'SetsController');
		});

});