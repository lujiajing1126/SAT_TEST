<?php
require_once 'Zend/Log.php';
require_once 'Zend/Log/Writer/Stream.php';


class MainIndex {
	private $_db;

	public function __construct() {
		$this->_db = DbManager::getConnection();
	}

	public function __destruct(){
		$this->_db->closeConnection();
	}

}