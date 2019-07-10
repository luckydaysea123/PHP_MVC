<?php

require_once './sys/autoload.php';

error_reporting(0);

 Session::begin();

// Обрада захтева
// xử lí request
$request = Http::getRequestedPath();

// Детектовање руте
//định tuyến
$routes = require_once './routes.php';
$args = $foundRoute = null;
foreach ($routes as $route) {
	if ($route->isMatched($request, $args)) {
		$foundRoute = $route;
		break;
	}
}

// Инстанцирање класе контролера
//xử lí controller
$className = $foundRoute->getController() . 'Controller';
//?worker là class controller trong app/controllers
$worker = new $className;//

// Позивање __pre метода
//hình như là để lấy cái tên trong cookie, có j tìm hiểu lại sau
if (method_exists($worker, '__pre')) {
	call_user_func([$worker, '__pre']);
}

// Позивање одговарајуће методе контролера
//tìm method thíc hợp
if (!method_exists($worker, $foundRoute->getMethod())) {
	ob_clean();
	die('CONTROLLER: Method not found.');
}
$methodName = $foundRoute->getMethod();
call_user_func_array([$worker, $methodName], $args);// bắt đầu chạy method

// Позивање __post метода
if (method_exists($worker, '__post')) {
	call_user_func([$worker, '__post']);
}

// Преузимање глобалних података
$DATA = $worker->getData();//lấy data về, chuẩn bị đổ vào

// Путање ка шаблонима
$headerView = './app/views/_global/header.php';
$footerView = './app/views/_global/footer.php';
$view = './app/views/' . $foundRoute->getController() . '/' . $foundRoute->getMethod() . '.php';

// Учитавање хедера
if (!file_exists($headerView)) {
	ob_clean();
	die('VIEW: Header file not found.');
}

// Учитавање главног шаблона приказа
if (!file_exists($view)) {
	ob_clean();
	die('VIEW: Main template file not found.');
}

// Учитавање футера
if (!file_exists($footerView)) {
	ob_clean();
	die('VIEW: Footer file not found.');
}

// Додатни ЈаваСкрипт модул
$jsModule = sprintf('assets/js/modules/%s_%s.js', $foundRoute->getController(), $foundRoute->getMethod());
if (file_exists($jsModule)) {
	$DATA['JAVASCRIPT_MODULE'] = $jsModule;
}

require_once $headerView;
require_once $view;
require_once $footerView;
