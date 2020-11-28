<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Ajax extends CI_Controller {
		private $tb_company  = 'company';
		private $tb_products = 'products';
		private $tb_sales 	 = 'sales';
		private $tb_users	 = 'users';
		private $tb_sale_items= 'sale_items';
		
		public function requests() {
			if (!$this->input->is_ajax_request()) {
			   show_404();
			} else {
				
				if($this->input->post('req')=='process_company') {
					$p    = $this->input->post();
					$id   = c($p['id']);
					$name  = c($p['name']);
					if(empty($id)) {
						validation('name','Company name','required|trim|is_unique['.$this->tb_company.'.name]');
					} else {
						validation('name','Company name','required|trim');
					}
					if($this->form_validation->run() == FALSE) {
						$error = validation_errors();
						$this->json(strip_tags($error));
					} else {
						$arr = array(
							'name'	=> $name,
							'slug'	=> nameToSlug($name),
						);
						if(empty($id)) {
							$arr['created'] = NOW;
							$r = $this->model->insertData($this->tb_company,$arr);
							$r?$this->json('1'):$this->json('Operation failed,try again');
						} else {
							$chk = $this->model->getData($this->tb_company,'count_array',$args=['where'=>['name'=>$name,'company_id!='=>$id]]);
							if($chk==0) {
								$r = $this->model->updateData($this->tb_company,$arr,$args=['where'=>['company_id'=>$id]]);
								$r?$this->json('1'):$this->json('Operation failed,try again');
							} else {
								$this->json('Name already exist try, different name');
							}
						}
					}
				} // end process_company
				
				if($this->input->post('req') == 'get_all_products') {
					// database col names
					$columns = array(
						0 => 'p.name',
						1 => 'c.name',
						2 => 'p.cost',
						3 => 'p.price',
						4 => 'p.quantity',
						5 => 'p.status',
					);
					$limit = $this->input->post('length');
					$start = $this->input->post('start');
					$order = $columns[$this->input->post('order')[0]['column']];
					$dir = $this->input->post('order')[0]['dir'];
					$q1 = "select * from products ";
					$items =  $this->model->query($q1,"all_array");
					$totalData = count($items);
					$totalFiltered = $totalData;
					if(empty($this->input->post('search')['value'])) {
						$q2 = "select p.*,c.name as cname from ".$this->tb_products." as p inner join ".$this->tb_company." as c ON p.company_id=c.company_id order by $order $dir limit $start,$limit";
						$posts = $this->model->query($q2,'all_array');
					} else {
						$search = $this->input->post('search')['value'];
							$q3 = "select p.*,c.name as cname from ".$this->tb_products." as p inner join ".$this->tb_company." as c ON p.company_id=c.company_id where ( p.name like '%".$search."%' || p.cost like '%".$search."%' || p.price like '%".$search."%' || c.name like '%".$search."%')  order by $order $dir limit $start,$limit";
						$posts = $this->model->query($q3,'all_array');
						$totalFiltered = count($posts);
					}
					$data = array();
					if(!empty($posts)) {
						foreach($posts as $key=>$val) {
							$id = $val['product_id'];
							$cid = $val['company_id'];
							$name = $val['name'];
							$cname = $val['cname'];
							$price = $val['price'];
							$cost = $val['cost'];
							$qty = $val['quantity'];
							$st = $val['status'];
							if($st=="1") {
								$status = '<span class="text-success">Available</span>';
							} else {
								$status = '<span class="text-danger">Out of Stock</span>';
							}

							$action = "<a href='".base_url('admin/edit-product/'.$id)."' title='Edit' class='btn btn-indigo btn-xs edit' data-toggle='tooltip' data-placement='top' >Edit</a>
							<a href='#' data-toggle='tooltip' data-placement='top' title='Delete' data-id='".$id."' class='btn btn-danger btn-xs' >Delete</a>";
							$indata['name']     = $name;
							$indata['company']	= $cname;
							$indata['cost']     = $cost;
							$indata['price']	= $price;
							$indata['qty']		= $qty;
							$indata['status']	= $status;
							$indata['action'] = $action;
							$data[] = $indata;
						}
					} // end empty posts
					$json_data = array(
						"draw"            => intval($this->input->post('draw')),
						"recordsTotal"    => intval($totalData),
						"recordsFiltered" => intval($totalFiltered),
						"data"            => $data
					);
					echo json_encode($json_data);
				} // end get_all_products
				
				if($this->input->post('req')=='process_product') {
					$id = c($this->input->post('id'));
					$out = array();
					parse_str($_REQUEST['data'], $out);
					$name = $out['name'];
					$company = $out['company'];
					$cost = $out['cost'];
					$price = $out['price'];
					$qty = $out['qty'];
					if(empty($id)) {
						validation('name','Product name','required}trim|is_unique['.$this->tb_products.'.name]');
					} else {
						validation('name','Product name','required}trim');
					}
					// validation('cost','Cost','required|trim|is_natural');
					// validation('price','Price','required|trim|is_natural');
					// validation('qty','Quantity','required|trim|is_natural');
					if($this->form_validation->run()==false) {
						$res = validation_errors();
						$this->json(strip_tags($res));
					} else {
						$arr = array(
							'company_id'	=> $company,
							'name'			=> $name,
							'cost'			=> $cost,
							'price'			=> $price,
							'quantity'		=> $qty,
						);
						if(empty($id)) {
							$arr['created'] = NOW;
							$r = $this->model->insertData($this->tb_products,$arr);
							$r? $this->json('success'):$this->json('Operation failed, Try again');
						} else {
							$chk = $this->model->getData($this->tb_products,'count_array',$args=['where'=>['name'=>$name,'product_id!='=>$id]]);
							if($chk==0) {
								$r = $this->model->updateData($this->tb_products,$arr,$args=['where'=>['product_id'=>$id]]);
								$r? $this->json('success'):$this->json('Operation failed, Try again');
							} else {
								$this->json('Product name already exists , try different name');
							}
						}
					}
				} // end process_product
				
				if($this->input->post('req')=='add_cart') {	
					$p = $this->input->post();
					$price = c($p['price']);
					$qty   = c($p['qty']);
					$pid   = c($p['pid']);
					$pname = c($p['pname']);
					$available = c($p['available']);
					$data = array(
						'id'      => $pid,
						'qty'     => $qty,
						'price'   => $price,
						'name'    => $pname,
						'available'=> $available
					);
					$r = $this->cart->insert($data);
					$r?$this->json('success'):$this->json('Opertaion failed! try again');
				}
				
				if($this->input->post('req') == 'save_sale') {
					$p = $this->input->post();
					$ids = $p['ids'];
					$qty = $p['qty'];
					$price = $p['price'];
					$type= c($p['type']);
					$user= c($p['user']);
					$avail = $p['avail'];
					if($type=="2") {
						$userd = $user;
					} else {
						$userd = null;
					}
					if(count($qty) == count($ids)) {
						$b=0;
						$this->model->insertData($this->tb_sales,['created'=>NOW,'status'=>$type,'user_id'=>$userd]);
						$iid = $this->db->insert_id();
						$gtotal=0;
						if($iid && $iid>0) {
							for($a=0;$a<count($ids);$a++) {
								$total = $price[$a] * $qty[$a];
								$gtotal +=$total;
								$arr = array(
									'sale_id'   => $iid,
									'product_id'=> $ids[$a],
									'price'		=> $price[$a],
									'quantity'	=> $qty[$a],
									'sub_total'	=> $total,
								);
								$r = $this->model->insertData($this->tb_sale_items,$arr);
								if($r) {
									$remainingQ = $avail[$a] - $qty[$a];
									$this->model->updateData($this->tb_products,['quantity'=>$remainingQ],$args=['where'=>['product_id'=>$ids[$a]]]);
									$b++;
								}
							}
						}
						if($b==count($ids)) {
							$this->model->updateData($this->tb_sales,['total'=>$gtotal],$args=['where'=>['sale_id'=>$iid]]);
							$this->cart->destroy();
							echo json_encode(['res'=>'1','id'=>$iid]);die;
						}
					} else {
						echo json_encode(['res'=>'Operation failed! try again','id'=>'']);die;
					}
				}  //  end save_sale
				
				if($this->input->post('req') == 'process_user') {
					$p = $this->input->post();
					$id = c($p['id']);
					$name = c($p['name']);
					$cnic = c($p['cnic']);
					$phone = c($p['phone']);
					$address = c($p['address']);
					validation('name', 'User name', 'required|trim');
					if($id=="0") {
						validation('cnic', 'CNIC', 'required|trim|is_unique['.$this->tb_users.'.cnic]');
					} else {
						validation('cnic', 'CNIC', 'required|trim');
					}
					validation('phone', 'Phone number', 'required|trim');
					if($this->form_validation->run() == FALSE) {
						$error = validation_errors();
						$this->json(strip_tags($error));
					} else {
						$arr = array(
							'name'		=> $name,
							'cnic'		=> $cnic,
							'phone'		=> $phone,
							'address'	=> $address
						);
						if($id=="0") {
							$arr['created'] = NOW;
							$r = $this->model->insertData($this->tb_users,$arr);
						} else {
							$chk = $this->model->getData($this->tb_users,'count_array',$args=['where'=>['cnic'=>$cnic,'user_id!='=>$id]]);
							if($chk==0) {
								$r = $this->model->updateData($this->tb_users,$arr,$args=['where'=>['user_id'=>$id]]);
							} else {
								echo json_encode('CNIC already exists, try different number');die;
							}
						}
						$r ? $this->json('success'):$this->json('Operation failed!, try again');
					}
				}  // end process_user
				
				if($this->input->post('req')=='pay_bill') {
					$p = $this->input->post();
					$uid = c($p['uid']);
					$ids = c($p['ids']);
					$arr = explode('_',$ids);
					$res = checkId($this->tb_users,'user_id',$uid);
					if(is_null($res)) {
						$this->json('User does not exist, try again');
					} else {
						if(is_array($arr)) {
							$r = $this->model->updateData($this->tb_sales,['status'=>'1'],$args=['wherein'=>['column'=>'sale_id','data'=>$arr]]);
							$r ? $this->json('success'):$this->json('Operation failed!, try again');
						} 
					}
					$this->json('Operation failed!, try again');
				}
				
				
				if($this->input->post('req')=='del_company') {
					$id = clean($this->input->post('id'));
					$col_id = 'company_id';
					$r = $this->model->updateData($this->tb_company,['status'=>'2'],$args=['where'=>[$col_id=>$id]]);
					$r?$this->json('success'):$this->json('Operation failed, try again');
				} 
				
				if($this->input->post('req')=='del_sale') {
					$this->deletes($this->tb_sales,'sale_id');
				}
				
				
			}// end else
		} // end requests	
		
		private function deletes($tbl,$col_id) {
			$id = clean($this->input->post('id'));
			$r = $this->model->getData($tbl,'count_array',$args=['where'=>[$col_id=>$id]]);
			if($r <= 0) {
				return $this->json('Invalid id,try again');
			} else {
				$del = $this->model->deleteData($tbl,[$col_id=>$id]);
				return $del==true?$this->json('success'):$this->json('Error in deleting record,try again');
			}
		} // end deletes

		public function json($res) {
			if($res=="success") {
				echo json_encode('1');die;
			} else {
				echo json_encode($res);die;
			}
		}
	}
?>