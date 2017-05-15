<?php
/*
Author: Francis Lagazon
*/
class Auth extends Database 
{
	public function __construct() {
		parent::__construct();
	}
	
	public function run() {
		$sth = $this->prepare("SELECT * FROM `users` WHERE `login`=:login AND `password`=:password");
		$sth->execute(array(
			":login" => $_POST["username"],
			":password" => md5($_POST["password"])
		));
		
		$data = $sth->fetch();
		$count = $sth->rowCount();
		
		if($count > 0) {
			Session::init();
            Session::set('role', $data['role']);
            Session::set('userid', $data['id']);
            header('location: /path/index.php');
		} else {
			header('location: /path/login.php');
		}
	}
}