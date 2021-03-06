<?php

class dbh {
	private $host = "localhost";
	private $user = "root";
	private $pass = "";
	private $dbname = "hfm";

	protected function connect() {
		try {
			$dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
			$pdo = new pdo($dsn, $this->user, $this->pass);
			$pdo->exec("set names utf8");
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return $pdo;
	}


	public function __construct() {
		@SESSION_START();
	}
}
