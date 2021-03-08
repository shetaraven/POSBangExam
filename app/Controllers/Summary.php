<?php

namespace App\Controllers;

use \App\Models\MenuModel;

class Summary extends BaseController
{
	public function index($order_id = 0)
	{
        if($order_id > 0){
            $menuModel = new MenuModel();
            $data = [];
            $data['details'] = $menuModel->fetch_order_details($order_id)[0];
            $data['orders'] = json_decode($data['details']['orders']);

            echo view('templates/HeaderTemplate.php');
            echo view('Summary.php',$data);
            echo view('templates/FooterTemplate.php');
        }else{
            return redirect()->to('/'); 
        }
	}
}
