<?php
	$db_host = "localhost";
	$db_username = "root";
	$db_password = "pwdpwd";
    $db_name = "iproboard";
    
    $this->db_link = @new mysqli($db_host, $db_username, $db_password, $db_name);
    
	if ($this->db_link->connect_error != "") {
		echo "資料庫連結失敗！";
		exit();
	}else{

		$this->db_link->query("SET NAMES 'utf8'");
	}
?>