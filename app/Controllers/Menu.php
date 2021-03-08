<?php

namespace App\Controllers;

use \App\Models\MenuModel;

class Menu extends BaseController
{
	public function index()
	{
		$menuModel = new MenuModel();
		$data = [];
		$data['categories'] = $menuModel->fetch_data('categories');
		
		$menuList = $menuModel->fetch_data('menu');
		$data['menuList'] = array();
		foreach($menuList as $key => $value){
			$data['menuList'][$value['category']][$key] = $value;
		}

		echo view('templates/HeaderTemplate.php');
		echo view('MenuList.php',$data);
		echo view('templates/FooterTemplate.php');
	}
}
