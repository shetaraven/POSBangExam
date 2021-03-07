<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    public function fetch_data($table){
        $db      = \Config\Database::connect();
        $builder = $db->table($table)->where('active',1);
        return $query = $builder->get()->getResultArray(); 
    }

    public function fetch_checkout_data($ids){
        $db      = \Config\Database::connect();
        $builder = $db->table('menu')
            ->where('active',1)
            ->whereIn('id',$ids);
        return $query = $builder->get()->getResultArray(); 
    }

    public function validate_coupon($code){
        $db      = \Config\Database::connect();
        $builder = $db->table('coupons')
            ->where('active',1)
            ->where('code',$code);
        return $query = $builder->get()->getResultArray(); 
    }

    public function save_orders($data){
        $db      = \Config\Database::connect();
        $builder = $db->table('orders')->insert($data);
        return $db->insertID();
    }

    public function fetch_order_details($id){
        $db      = \Config\Database::connect();
        $builder = $db->table('orders')->where('id',$id);
        return $query = $builder->get()->getResultArray(); 
    }
}