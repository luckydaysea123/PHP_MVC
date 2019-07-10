<?php

/**
 * TaskModel
 */
class DepartmentModel extends Model {

	/**
	 * Назив табеле
	 * @var string
	 */
	protected static $tableName = 'departments';

	/**
	 * Враћање свих редова из табеле - INNER JOIN са табелом `users`
	 * @return array
	 * @todo heredoc синтакса изгледа лепше од PHP верзије 7.3, са преласком на ту верзију измени SQL упит
	 */
	public static function getAll() {
		// $tasks = sprintf('`%s`', self::getTableName());
		// $users = sprintf('`%s`', UserModel::getTableName());

		/**
		 * Редослед табела у SELECT реду је битан јер желимо да `id` поље из табеле `tasks` прегази `id` поље из табеле `users`
		 */
		$sql = <<<END
		SELECT *FROM Departments
END;

		$pst = Database::getInstance()->prepare($sql);
		$pst->execute();

		return $pst->fetchAll();
	}

}
