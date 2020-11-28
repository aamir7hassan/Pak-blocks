<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if(!function_exists('clean'))
	{
		function clean($data) {
		  	$data = trim($data);
		  	$data = stripslashes($data);
		  	$data = htmlspecialchars($data);
		  	return $data;
		}
	}
	
	if(!function_exists('c'))
	{
		function c($data) {
		  	$data = trim($data);
		  	$data = stripslashes($data);
		  	$data = htmlspecialchars($data);
		  	return $data;
		}
	}
	
	function getData($tbl,$col="",$order=false) {
		$ci =& get_instance();
		if($order && !empty($col)) {
			$res = $ci->model->getData($tbl,'all_array',$args=['where'=>['active'=>'1'],'order'=>['col'=>$col,'type'=>'DESC']]);
			return $res;
		}
		return $ci->model->getData($tbl,'all_array',$args=[]);
	}
	
	function datePattern($date,$opt=NULL) {
		if($opt==NULL) {
			return date('d-m-Y H:i:s',strtotime($date));
		} else {
			return date('d-m-Y',strtotime($date));
		}
		
	}
	function json($res) {
		if($res=="success") {
			echo json_encode('1');die;
		} else {
			echo json_encode($res);die;
		}
	}

	function is_set($text,$default='')
    {
		if(strlen($default) > 0) {
			return isset($text)?$text:$default;
		}
        return isset($text)?$text:'';
    }

	if(!function_exists('_url'))
	{
		function _url($url) {
		  	return base_url($url);
		}
	}

	if(!function_exists('isAdmin'))
	{
		function isAdmin() {
			$ci =& get_instance(); //get main CodeIgniter object
			if($ci->session->has_userdata(DOMAIN.'role') && $ci->session->userdata(DOMAIN.'role')=='admin') {
				return true;
			}
		}
	}

	
	function nameToSlug($name) {
		return str_replace(' ','-',$name);
	}

	if(!function_exists('_u'))
	{
		function _u() {
			$ci =& get_instance(); //get main CodeIgniter object
			if($ci->session->has_userdata(DOMAIN.'user_id')) {
				return $ci->session->userdata(DOMAIN.'user_id');
			}
		}
	}
	if(!function_exists('userId'))
	{
		function userId() {
			$ci =& get_instance(); //get main CodeIgniter object
			if($ci->session->has_userdata(DOMAIN.'user_id')) {
				return $ci->session->userdata(DOMAIN.'user_id');
			}
		}
	}
	
	function checkId($tbl,$col,$id) {
		$ci =& get_instance();
		$res = $ci->model->getData($tbl,'row_array',$args=['where'=>[$col=>$id]]);
		return $res;
	}
	
	function validation($key,$name,$rule) {
		$ci =& get_instance();
		return $ci->form_validation->set_rules($key, $name, $rule);
	}
	
	function d($data) {
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		die;
	}

	if(!function_exists('_flashPop'))
	{
		function _flashPop($success,$successMsg,$failureMsg)
		{
			$ci =& get_instance();
			if($success) {
				$ci->session->set_flashdata('data',$successMsg);
				$ci->session->set_flashdata('class','success');
			} else {
				$ci->session->set_flashdata('data',$failureMsg);
				$ci->session->set_flashdata('class','error');
			}
		}
	}
	
?>
