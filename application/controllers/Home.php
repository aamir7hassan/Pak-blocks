<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Home extends CI_Controller {
		private $tb_products = 'products';
		private $tb_projects = 'projects';
		private $tb_users = 'users';
		private $tb_reviews = 'reviews';
		function __construct() { 
			parent::__construct();
		}
		
		public function index() {
			$data['title'] = "Pak blocks";
				$data['reviews'] = $this->model->getData($this->tb_reviews,'all_array',$args=['where'=>['approved'=>'1']]);
				$data['projects'] = $this->model->getData($this->tb_projects,'all_array',$args=['order'=>['col'=>'pro_id','type'=>'DESC']]);
			$this->load->view('index',$data);
		}
		
		public function about_us() {
			$data['title'] = "About us";
			$data['reviews'] = $this->model->getData($this->tb_reviews,'all_array',$args=['where'=>['approved'=>'1']]);
			$this->load->view('about',$data);
		}
		
		public function contact_us() {
			$data['title'] = "Contact us";
			$this->load->view('contact',$data);
		}
		 
		public function products() {
			$data['title']= "Products | Pak blocks";
				$data['reviews'] = $this->model->getData($this->tb_reviews,'all_array',$args=['where'=>['approved'=>'1']]);
				$data['items'] = $this->model->getData($this->tb_products,'all_array',$args=['where'=>['active'=>'1']]);
			$this->load->view('products',$data);
		}
		
		public function projects() {
			$data['title'] = "Projects | Pak blocks";
				$data['projects'] = $this->model->getData($this->tb_projects,'all_array',$args=['order'=>['col'=>'pro_id','type'=>'DESC']]);
				$data['reviews'] = $this->model->getData($this->tb_reviews,'all_array',$args=['where'=>['approved'=>'1']]);
			$this->load->view('projects',$data);
		}
		
		public function process_review() {
			$p = $this->input->post();
			$name = c($p['name']);
			$msg  = c($p['msg']);
			$email = c($p['email']);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  echo json_encode('Invalid email address');die;
			}
			$arr = array(
				'name'		=> $name,
				'email'		=> $email,
				'message'	=> $msg,
				'approved'	=> '0',
				'created'	=> NOW
			);
			$r = $this->model->insertData($this->tb_reviews,$arr);
			echo $r ? json_encode('1'):json_encode('Operation failed! try again');die;
		}
		
		public function send_mail() {
			$params = array();
			parse_str($_POST['data'], $params);
			$fname = $params['fname'];
			$lname = $params['lname'];
			$email = $params['email'];
			$sub   = $params['subject'];
			$msg   = $params['message'];
			
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  echo json_encode('Invalid email address');die;
			}
			
			$html='<h2><center>Pak Blocks</center></h2><h3>Sender: '.$fname.' '.$lname.'</h3><p>'.$msg.'</p>';
			$r = $this->email
                    ->from('alamconcretes@hotmail.com', 'Pak Blocks')
                    ->to($email)
                    ->subject($sub)
                    ->message($html)
                    ->send();
			
			echo $r?json_encode('1'):json_encode('Process failed!, try again!');die;
		}
		
	} // end class