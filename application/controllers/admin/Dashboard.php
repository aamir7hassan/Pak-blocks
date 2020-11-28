<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Dashboard extends CI_Controller {
		private $tb_products  = 'products';
		private $tb_projects = 'projects';
		private $tb_users	 = 'users';
		private $tb_reviews	 = 'reviews';
		
		function __construct() {
			parent::__construct();
			if(!isAdmin()) {
				return redirect('login');
			}
		}
		
		public function index()
		{
			$data['title']= "Dashboard";
			$data['products'] = $this->model->getData($this->tb_products,'all_array',$args=['where'=>['active'=>'1']]);
			$this->load->view('admin/products',$data);
		}
		
		public function products() {
			$data['title'] = "Products";
			$data['products'] = $this->model->getData($this->tb_products,'all_array',$args=['where'=>['active'=>'1']]);
			$this->load->view('admin/products',$data);
		}
		
		public function add_product() {
			$data['title'] = "Add product";
			$this->load->view('admin/add_product',$data);
		}
		
		public function edit_product($id) {
			$data['title'] = "Edit product";
				$res = $this->model->getData($this->tb_products,'row_array',$args=['where'=>['pr_id'=>$id]]);
				if(is_null($res)) {
					show_404();
				}
				$data['item'] = $res;
			$this->load->view('admin/edit_product',$data);
		}
		
		public function process_product() {
			$p = $this->input->post();
			//$name = c($p['name']);
			$length = c($p['length']);
			$width = c($p['width']);
			$height = c($p['height']);
			$id = c($p['id']);
			
			if(isset($_FILES) && $_FILES['image']['size'] > 0) { 
				$ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
				$newName = DOMAIN .'-'.uniqid().'.'.$ext;
				$folder = "products";
				if (!file_exists('images/'.$folder)) {
					mkdir('images/'.$folder, 0777, true);
				}
				$path = 'images/'.$folder.'/';
				if(move_uploaded_file($_FILES["image"]["tmp_name"],$path.$newName)) {
					$image = $newName;
				} else {
					$image = '';
				}
			} else {
				$image = "";
			}
			if($id > 0) {
				$old = $p['old'];
				if(empty($image)) {
					$image = $old;
				} else {
					@unlink($path.$old);
				}
			}
			$arr = array(
				'image'		=> $image,
				'length'	=> $length,
				'width'		=> $width,
				'height'	=> $height,
				//'name'		=> $name,
				'created'	=> NOW
			);
			if($id==0) {
				$r = $this->model->insertData($this->tb_products,$arr);
				_flashPop($r,'PRoduct added successfully','Error in adding product,try again');
				return redirect('admin/add-product');
			} else if($id>0) {
				$r = $this->model->updateData($this->tb_products,$arr,$arg=['where'=>['pr_id'=>$id]]);
				_flashPop($r,'Product updated successfully','Error in updating product,try again');
				return redirect('admin/edit-product/'.$id);
			} else {
				_flashPop(false,'Product updated successfully','Operation failed!try again');
				return redirect('admin/products');
			}
		}
		
		public function projects() {
			$data['title'] = "Projects | Pak blocks";
			$data['projects'] = $this->model->getData($this->tb_projects,'all_array',$args=[]);
			$this->load->view('admin/projects',$data);
		}
		
		public function add_project() {
			$data['title'] = 'Add new project | Pak blocks';
			$this->load->view('admin/add_project',$data);
		}
		
		public function edit_project($id) {
			$data['title'] = "Edit project | Pak blocks";
				$res = $this->model->getData($this->tb_projects,'row_array',$args=['where'=>['pro_id'=>$id]]);
				if(is_null($res)) {
					show_404();
				}
				$data['item'] = $res;
			$this->load->view('admin/edit_project',$data);
		}
		
		public function process_project() {
			$p = $this->input->post();
			$title = c($p['title']);
			$desc  = c($p['desc']);
			$id    = c($p['id']);
			
			if(isset($_FILES) && $_FILES['image']['size'] > 0) {
				$ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
				$newName = DOMAIN .'-'.uniqid().'.'.$ext;
				$folder = "projects";
				if (!file_exists('images/'.$folder)) {
					mkdir('images/'.$folder, 0777, true);
				}
				$path = 'images/'.$folder.'/';
				if(move_uploaded_file($_FILES["image"]["tmp_name"],$path.$newName)) {
					$image = $newName;
				} else {
					$image = '';
				}
			} else {
				$image = "";
			}
			if($id > 0) {
				$old = $p['old'];
				if(empty($image)) {
					$image = $old;
				} else {
					@unlink($path.$old);
				}
			}
			$arr = array(
				'image'			=> $image,
				'title'			=> $title,
				'description'	=> $desc,
				'created'		=> NOW
			);
			if($id==0) {
				$r = $this->model->insertData($this->tb_projects,$arr);
				_flashPop($r,'PRoduct added successfully','Error in adding product,try again');
				return redirect('admin/add-project');
			} else if($id>0) {
				$r = $this->model->updateData($this->tb_projects,$arr,$arg=['where'=>['pro_id'=>$id]]);
				_flashPop($r,'Project updated successfully','Error in updating project,try again');
				return redirect('admin/edit-project/'.$id);
			} else {
				_flashPop(false,'Project updated successfully','Operation failed!try again');
				return redirect('admin/projects');
			}
		}
		
		public function reviews() {
			$data['title'] = "Reviews | Pak blocks";
			$data['items'] = $this->model->getData($this->tb_reviews,'all_array',$args=['order'=>['col'=>'review_id','type'=>'DESC']]);
			$this->load->view('admin/reviews',$data);
		}
		
		public function publish_review() {
			$p = $this->input->post();
			$id = c($p['id']);
			$st = c($p['status']);
			$status = $st=='1'?'0':'1';
			$r = $this->model->updateData($this->tb_reviews,['approved'=>$status],$args=['where'=>['review_id'=>$id]]);
			echo $r ? json_encode('1'):json_encode('Operation failed! try again');die;
		}
		
		public function delete_review() {
			$id = c($this->input->post('id'));
			$r = $this->model->deleteData($this->tb_reviews,['review_id'=>$id]);
			echo $r? json_encode('1'):json_encode('Operation failed! try again');die;
		}
		
		public function delete_project() {
			$id = c($this->input->post('id'));
			$r = $this->model->deleteData($this->tb_projects,['pro_id'=>$id]);
			echo $r? json_encode('1'):json_encode('Operation failed! try again');die;
		}
		
		
	} // end class
?>