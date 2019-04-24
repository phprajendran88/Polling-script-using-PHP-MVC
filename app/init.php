
<?php

	require_once 'config/config.php'; // to store all the configuration of the application
	require_once 'config/session.php'; // to all session related feature
	require_once 'core/app.php'; // to call particular controller and action from the url
	require_once 'core/controller.php'; // base controller class
	require_once 'models/model.php'; // database operation class


	//start sessions
	Session::init();