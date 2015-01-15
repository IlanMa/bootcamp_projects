<?php 
class pokes extends CI_Model
{
	public function getAllLogins()
	{
		$query = "SELECT * FROM users";
		return $this->db->query($query)->result_array();
	}
	
	public function addRegister($register)
	{
		$query = "INSERT INTO users (name, alias, email, password, birth , poke, pokedsince, created_at, updated_at) VALUES (?, ?, ?, ?, ?, 0, 0,  NOW(), NOW())";
		$values = array($register['name'], $register['alias'], $register['email'], $register['password'], $register['birth']);
		return $this->db->query($query, $values);
	}
	public function verifyAccount($login)
	{
	   	$query = "SELECT * FROM users WHERE email = '{$login['email']}' AND password = '{$login['password']}'";
		return $this->db->query($query)->result_array();
	}
	public function addPoke($update){
		 return $this->db->query("UPDATE users SET poke = ?, pokedsince = ?, updated_at = NOW() WHERE id = ?", array($update['pokedAmount'], $update['pokedSince'], $update['pokedID']));
	}
	public function getPokedUser($id){
		$query = 'SELECT * FROM users WHERE id = '.$id.'';
		return $this->db->query($query)->result_array();
	}
	public function changePokedSince($id){
		return $this->db->query('UPDATE users SET pokedSince = 0 WHERE id = '.$id.'');
	}
}
 ?>