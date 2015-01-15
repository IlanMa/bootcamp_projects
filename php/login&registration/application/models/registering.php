<?php 
class Registering extends CI_Model
{
	public function getAllLogins()
	{
		$query = "SELECT * FROM users";
		return $this->db->query($query)->result_array();
	}
	public function addRegister($register)
	{
		$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES (?, ?, ?, ?,  NOW(), NOW())";
		$values = array($register['first_name'], $register['last_name'], $register['email'], $register['password']);
		return $this->db->query($query, $values);
	}
	public function verifyAccount($login)
	{
	   	$query = "SELECT * FROM users WHERE email = '{$login['email']}' AND password = '{$login['password']}'";
		return $this->db->query($query)->result_array();
	}
}



 ?>