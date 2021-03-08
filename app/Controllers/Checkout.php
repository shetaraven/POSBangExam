<?php

namespace App\Controllers;

use \App\Models\MenuModel;
use CodeIgniter\API\ResponseTrait;

class Checkout extends BaseController
{
	use ResponseTrait;

	public function index()
	{
		if(isset($_COOKIE['current_orders'])){
			$orders = json_decode($_COOKIE['current_orders']);
			$data = $this->fetch_orders($orders);
			$data['empty'] = false; 
		}else{
			$data['empty'] = true; 
		}

		echo view('templates/HeaderTemplate');
		echo view('Checkout',$data);
		echo view('templates/FooterTemplate');
	}

	public function change_quantity(){
		$orders = $this->request->getvar('orders');
		$percent = $this->request->getvar('percent');
		$data = $this->fetch_orders(json_decode($orders),$percent);

		return $this->respond($data);
	}

	public function validate_coupon(){
		$code = $this->request->getvar('code');

		$menuModel = new MenuModel();
		$dbcode = $menuModel->validate_coupon($code);
		if($dbcode){
			return $this->respond($dbcode);
		}else{
			return $this->respond(false);
		}
	}

	public function fetch_orders($ids = [],$percent = 0){
		$menuModel = new MenuModel();
		$data = array();
		$data['pretotal'] = 0.00;
		$data['tax'] = 0.00;
		$data['grandtotal'] = 0.00;

		$quantities = array_count_values($ids);
		$keys = array_keys($quantities);

		$items = $menuModel->fetch_checkout_data($keys);
		$item_ref = array();
		foreach ($items as $keys => $l){
			$item_ref[$l['id']] = $l;
		}

		foreach ($quantities as $key => $count){
			$pt = $item_ref[$key]['price'] * $count;
			$tp = $item_ref[$key]['tax'] * $count;
			$data['pretotal'] += $pt;
			$data['tax'] += $tp;
			$data['grandtotal'] += $pt + $tp;
			$data['orders'][$key] = array(
				'id' => $item_ref[$key]['id'],
				'category' => $item_ref[$key]['category'],
				'name' => $item_ref[$key]['name'],
				'quantity' => $count,
				'price' => number_format($pt + $tp,2,'.',',')
			);
		}

		$data['pretotal'] = number_format($data['pretotal'],2,'.',',');
		$data['tax'] = number_format($data['tax'],2,'.',',');

		if($percent != 0){
			$discount = ($percent / 100) * $data['grandtotal'];
			$data['grandtotal'] = $data['grandtotal'] - $discount;
			$data['discount'] = number_format($discount,2,'.',',');
		}

		$data['grandtotal'] = number_format($data['grandtotal'],2,'.',',');
		
		return $data;
	}

	public function save_orders(){
		$orders = json_decode($_COOKIE['current_orders']);
		$discount = json_decode($_COOKIE['withCoupon']);
		$percent = 0;
		if($discount->active){
			$percent = $discount->percent;
		}

		$pre_data = $this->fetch_orders($orders,$percent);
		$save_data = array(
			'orders' => json_encode($pre_data['orders']),
			'pre_total' => floatval($pre_data['pretotal']),
			'tax_total' => floatval($pre_data['tax']),
			'grand_total' => floatval($pre_data['grandtotal']),
			'date' => date('Y/m/d H:i:s') 
		);

		if($discount->active){
			$save_data['discount'] = floatval($pre_data['discount']);
			$save_data['coupon_id'] = $discount->cid;
		}

		$menuModel = new MenuModel();
		$dbcode = $menuModel->save_orders($save_data);

		return $this->respond($dbcode);
	}
}
