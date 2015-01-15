<?php 
class ecommerce extends CI_Model
{
	public function getAllItems()
	{
		$query = "SELECT * FROM items";
		return $this->db->query($query)->result_array();
	}
	public function addProduct($product)
	{
		$query = "INSERT INTO items (product, price, created_at, updated_at) VALUES (?, ?, NOW(), NOW())";
		$values = array($product['description'], $product['price']);
				return $this->db->query($query, $values);
	}
	public function deleteProduct($product)
	{
		   return $this->db->query("DELETE FROM items WHERE id = ?", $product);
	}
}



 ?>