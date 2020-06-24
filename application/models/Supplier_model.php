<?php

class Supplier_model extends CI_Model
{

    public function getAllSupplier()
    {
        return  $this->db->query('SELECT * FROM supplier');
    }
    public function getSupplierID($spid)
    {
        $this->db->where('supplier_id', $spid);
        return $this->db->get('supplier');
    }
    public function insertSupplier($suppliername, $supplieraddress, $supplierphonenumber, $supplieremail)
    {
        $data = [
            'supplier_name' => $suppliername,
            'supplier_address' => $supplieraddress,
            'supplier_phonenum' => $supplierphonenumber,
            'supplier_email' => $supplieremail
        ];
        return $this->db->insert('supplier', $data);
    }
    public function editSupplier($supplierid,  $supplieraddress, $supplierphonenumber, $supplieremail)
    {
        $sql = 'UPDATE supplier SET supplier_address = ?,supplier_phonenum=?,supplier_email=?  WHERE supplier_id = ? ';
        return $this->db->query($sql, array($supplieraddress, $supplierphonenumber, $supplieremail, $supplierid));
    }
}
