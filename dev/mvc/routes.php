<?php

return [
	// HomeController
	new Route('Home', 'index', '|^/?$|'),
	new Route('Home', 'login', '|^login/?$|'),
	new Route('Home', 'logout', '|^logout/?$|'),
	// TaskController
	new Route('Task', 'index', '|^tasks/?$|'),
	new Route('Task', 'create', '|^tasks/create/?$|'),
	new Route('Task', 'update', '|^tasks/update/([0-9]+)/?$|'),
	new Route('Task', 'delete', '|^tasks/delete/([0-9]+)/?$|'),
	// DepartmentController
	new Route('Department', 'index', '|^departments/?$|'),
	new Route('Department', 'create', '|^departments/create/?$|'),
	new Route('Department', 'update', '|^departments/update/([0-9]+)/?$|'),
	new Route('Department', 'delete', '|^departments/delete/([0-9]+)/?$|'),
	
	// TaskApiController
	new Route('TaskApi', 'index', '|^api/tasks/?$|'),
	// Подразумевана рута
	new Route('Home', 'e404', '|^.*$|'),
];
