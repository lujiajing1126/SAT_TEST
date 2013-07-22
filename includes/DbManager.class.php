<?php
require_once 'const.class.php';
require_once 'Zend/Config/Ini.php';
require_once 'Zend/Db.php';


class DbManager  {
	public static function getConnection()  {
		$db = NULL;
		try {
			$config = new Zend_Config_Ini(APP_PATH.'/includes/db.ini','database');
			$db = Zend_Db::factory($config);
			$db->query('SET CHARACTER SET utf8');
		} catch (Zend_Exception $e) {
			die($e->getMessage());
		}
		return $db;
	}
}