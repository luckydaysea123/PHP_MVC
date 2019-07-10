<?php

/**
 * TaskController
 */
class DepartmentController extends AuthController {

	/**
	 * Рута: /tasks/
	 * @return void
	 */
	public function index() {
		// Постављање наслова
		$this->set('title', 'Departments');

		// Узимање података из базе
        //$tasks = TaskModel::getAllFromInnerJoinWithUsers();
        $departments = DepartmentModel::getAll();

		// Форматирање података за приказ
		// foreach ($departments as $department) {
		// 	$task->created_at = Utils::formatDateAndTime($task->created_at);
		// 	$task->user = $this->formatFirstAndLastName($task->first_name, $task->last_name);
		// }

		// Прослеђивање података слоју приказа
		$this->set('departments', $departments);
	}

	/**
	 * Рута: /tasks/create/
	 * @return void
	 */
	public function create() {
		// Постављање наслова
		$this->set('title', 'Add department');

		// Обустави даљу обраду захтева у случају да није одговарајућа HTTP метода
		if (!Http::isPost()) {
			return;
		}

		// Узимање података из HTTP POST променљивих
		$department_name = filter_input(INPUT_POST, 'department_name', FILTER_SANITIZE_STRING);
        $department_address = filter_input(INPUT_POST, 'department_address', FILTER_SANITIZE_STRING);
        $department_phone = filter_input(INPUT_POST, 'department_phone', FILTER_SANITIZE_STRING);

		// Валидација података
		if (empty($department_name) || empty($department_address) || empty($department_phone)) {
			$this->set('message', 'Error #1!');
			return;
		}

		// Нормализација података пре уписа у базу
	//	$userId = intval(Session::get(Config::USER_COOKIE));
        $department_name  = trim($department_name);
        $department_address  = trim($department_address);
        $department_phone  = trim($department_phone);

		// Упис података у базу
		$department = DepartmentModel::create([
			'department_name' => $department_name,
			'department_address' => $department_address,
			'department_phone' => $department_phone
		]);

		// Повратак на формулар у случају неуспелог уписа у базу
		if (!$department) {
			$this->set('message', 'Error #2!');
			return;
		}

		// Редирекција
		Redirect::to('departments');
	}

	/**
	 * Рута: /tasks/update/$id
	 * @param int $id ID параметар
	 * @return void
	 */
	public function update($id) {
		// Постављање наслова
		$this->set('title', 'Update Department');

		// Обустави даљу обраду захтева у случају да није одговарајућа HTTP метода
		if (!Http::isPost()) {
			$this->setDepartment($id);
			return;
		}

		// Узимање података из HTTP POST променљивих
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
		$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

		// Валидација података
		if (empty($name) || empty($address) || empty($phone)) {
			$this->set('message', 'Error #1!');
			$this->setTask($id);
			return;
		}

		// Нормализација података пре уписа у базу
	//	$userId = intval(Session::get(Config::USER_COOKIE));
		$name = trim($name);
		$address = trim($address);
		$phone = trim($phone);

		// Ажурирање података у бази
		$status = DepartmentModel::update($id, [
			'department_name' => $name,
			'department_address' => $address,
			'department_phone' => $phone
		]);

		// Повратак на формулар у случају неуспелог уписа у базу
		if (!$status) {
			$this->set('message', 'Error #2!');
			$this->setDepartment($id);
			return;
		}

		// Редирекција
		Redirect::to('departments');
	}

	/**
	 * Рута: /tasks/delete/$id
	 * @param int $id ID параметар
	 * @return void
	 */
	public function delete($id) {
		// Уклањање података из базе
		DepartmentModel::delete($id);

		// Редирекција
		Redirect::to('departments');
	}

	/**
	 * Враћа ред из табеле по ID параметру и складишти га у податке за приказ
	 * @param int $id ID параметар
	 * @return void
	 */
	private function setDepartment($id, $name = 'department') {
		// Узимање података из базе
		$department = DepartmentModel::getById($id);

		// Прослеђивање података слоју приказа
		$this->set($name, $department);
	}

	/**
	 * Форматира име и презиме корисника за приказ
	 * @param string $firstName Име
	 * @param string $lastName Презиме
	 * @return string
	 */
	public static function formatFirstAndLastName($firstName, $lastName) {
		$user = trim(implode(' ', [$firstName, $lastName]));
		return $user ? $user : 'N/A';
	}

}
