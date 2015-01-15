<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Listings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('ecommerce');
	}

	public function index()
	{
		$view_data['items'] = $this->ecommerce->getAllItems();
		if (empty($this->session->userdata('cart')))
			{
				$this->session->set_userdata('cart', 0);
				$this->session->set_userdata('totalshirtprice', 0);
				$this->session->set_userdata('totalcupprice', 0);
			}
		if (empty($this->session->userdata('totalshirtqty')))
			{
				$this->session->set_userdata('totalshirtqty', 0);
			}
		if (empty($this->session->userdata('totalcupqty')))
			{
				$this->session->set_userdata('totalcupqty', 0);
			}
		$this->session->set_userdata('listing', $view_data['items']);
		$this->load->view('home', $view_data);
	}

	public function buy()
	{
		$productPressed = ($this->input->post('action'));
				$product['quantity'] =  $this->input->post('qty');
				$this->session->set_userdata($productPressed.'qty', $product['quantity']);
				$this->session->set_userdata($productPressed.'tqty', $this->session->userdata($productPressed.'tqty') + $this->session->userdata($productPressed.'qty'));
				$this->session->set_userdata('cart', ($this->session->userdata('cart') + $this->session->userdata($productPressed.'qty')));
				redirect('/listings');
	}
	public function checkout()
	{
		$this->load->view('cart');
	}
	public function delete()
	{
		$productDelete = $this->input->post('action');
			$this->session->set_userdata('cart', $this->session->userdata('cart') - $this->session->userdata($productDelete.'tqty'));
			$this->session->set_userdata('totalprice', $this->session->userdata('totalprice') - $this->session->userdata($productDelete.'tqty') * $this->session->userdata($productDelete.'price'));
			$this->session->set_userdata($productDelete.'tqty', 0);
			$this->session->set_userdata($productDelete.'price', 0);
		
		$this->load->view('cart');
	}
	public function order(){
		foreach ($this->session->userdata('listing') as $product){
			$this->session->set_userdata($product['product'].'tqty', 0);
		}
		$this->session->set_userdata('cart', 0);
		$this->session->set_flashdata('order', "Order is Complete");
		redirect('/listings');
	}
	public function add(){
		$this->load->view('addproduct');
	}
	public function addproduct()
	{
		$product['description'] = $this->input->post('description');
		$product['price'] = $this->input->post('price');
		$this->ecommerce->addproduct($product);
		redirect('/listings');
	}
	public function deleteProduct()
	{
		$productToDelete = $this->input->post('action');
		for ($i=0; $i<count($this->session->userdata['listing']); $i++){
			if ($this->session->userdata['listing'][$i]['product'] == $productToDelete)
			{
				$productID	= ($this->session->userdata['listing'][$i]['id']);
				$this->ecommerce->deleteProduct($productID);
		}
	}
		redirect('/listings');
	
}
}	

