<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Login extends CI_Controller {
		function __construct() {
			parent::__construct();
		}
		
		public function index()	{
			$data['title']= "Admin login";
			$this->load->view('admin/login',$data);
		}
		
		public function process() {
			if (!$this->input->is_ajax_request()) {
			   show_404();
			} else {
				$post = $this->input->post();
				$email = clean($post['email']);
				$password  = clean($post['password']);
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_error_delimiters('', '');
				if($this->form_validation->run()==false) {
					$error = form_error('email');
					$error1 = form_error('password');
					if(strlen($error)>0 ) {
						json($error);
					}
					if(strlen($error1)>0 ) {
						json($error1);
					}
				} else {
					$r = $this->model->getData('admin','row_array',$args=['where'=>['email'=>$email,'password'=>sha1($password)]]);
					if(is_null($r)) {
						json('Invalid email or password');
					} else {
						$arr = array(
							DOMAIN.'user_id'	=> $r['id'],
							'email'		=> $r['email'],
							'fname'		=> $r['fname'],
							'lname'		=> $r['lname'],
							DOMAIN.'role'		=> 'admin'
						);
						$this->session->set_userdata($arr);
						json('success');
					}
					
				}
			}
		}
		
		public function update_profile() {
			$data['title'] = "Update Profile";
			$uid = userId();
			$data['user'] = $this->model->getData('admin','row_array',$args=['where'=>['id'=>$uid]]);
			$this->load->view('admin/update_profile',$data);
		}
		
		public function processProfile() {
			$uid = userId();
			$post = $this->input->post();
			$email = clean($post['email']);
			$password  = clean($post['pass']);
			$cpassword = clean($post['cpass']);
			$fname = clean($post['fname']);
			$lname = clean($post['lname']);
			
			//$remember = clean($post['remember']);
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('fname', 'First name', 'trim|required');
			if(!empty($password)) {
				if($password!==$cpassword) {
					_flashPop(FALSE,'Profile updated successfully','Passwords do not match');
					return redirect('admin/update-profile');
				}
			}
			//$this->form_validation->set_error_delimiters('', '');
			if($this->form_validation->run()==false) {
				$data['title'] = "Update Profile";
				$uid = userId();
				$data['user'] = $this->model->getData('admin','row_array',$args=['where'=>['id'=>$uid]]);
				$this->load->view('admin/update_profile',$data);
			} else {
				if(empty($password)) {
					$arr = array(
						'email'		=> $email,
						'fname'		=> $fname,
						'lname'		=> $lname,
						'date_updated' => date('Y-m-d H:i:s')
					);
				} else if(!empty($password)) {
					$arr = array(
						'email'		=> $email,
						'fname'		=> $fname,
						'lname'		=> $lname,
						'password'	=> sha1($password),
						'date_updated' => date('Y-m-d H:i:s')
					);
				}
				if(is_array($arr)) {
					$r = $this->model->updateData('admin',$arr,$args=['where'=>['id'=>$uid]]);
					_flashPop($r,'Profile updated successfully','Error while updating profile try again');
					
				} else {
					_flashPop(FALSE,'Profile updated successfully','Error while updating profile try again');
				}
				return redirect('admin/update-profile');
			}
		}
		
		public function logout() {
			unset($_SESISON);
			$this->session->sess_destroy();
			return redirect('login');
		}
	}
?>