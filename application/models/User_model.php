<?php

class User_model extends CI_Model
{

    public function getSignin($id)
    {
        return $this->db->join('manage', 'manage.usr_id=user.usr_id')->get_where('user', ['user.usr_id' => $id])->row_array();
    }
}

/*SELECT manage.outlets_id,manage.usr_id,outlets.outlets_name,user.usr_name FROM `manage` 
JOIN outlets on manage.outlets_id=outlets.outlets_id
JOIN user on manage.usr_id=user.usr_id*/
