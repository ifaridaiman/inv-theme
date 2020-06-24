<?php

class Staff_model extends CI_Model
{
    public function getInventoryList()
    {
        return $this->db->get('inventory');
    }
    public function getAllUser()
    {
        return $this->db->get_where('user', ['usr_id' => $this->session->userdata('id')])->row_array();
    }
    public function insertDefect($invid, $defectqty, $defectdesc)
    {
        $data = [
            'inv_id' => $invid,
            'defectlog_qty' => $defectqty,
            'defect_desc' => $defectdesc
        ];
        return $this->db->insert('defectlog', $data);
    }
    public function updateInventoryDefect($invid, $defectqty)
    {
        $sql = 'UPDATE inventory SET inv_qty = inv_qty - ? WHERE inv_id = ? ';
        return $this->db->query($sql, array($defectqty, $invid));
    }
    public function getDefectlist()
    {
        return  $this->db->query('SELECT * FROM defectlog JOIN inventory ON defectlog.inv_id=inventory.inv_id JOIN product ON inventory.prd_sku = product.prd_sku JOIN supplier ON product.supplier_id=supplier.supplier_id');
    }
    public function getOrderReceivable()
    {
        return  $this->db->query('SELECT * FROM orderproduct JOIN product ON orderproduct.prd_sku=product.prd_sku  JOIN supplier ON product.supplier_id=supplier.supplier_id');
    }
    public function getDetailOrderReceivable($ordid)
    {
        return  $this->db->query('SELECT * FROM orderproduct  JOIN product ON orderproduct.prd_sku=product.prd_sku JOIN category ON product.category_id=category.category_id JOIN supplier ON product.supplier_id=supplier.supplier_id WHERE order_id =' . $ordid);
    }
    //update inventory after receive the stock
    public function receivableUpdateValidation($storeid, $prd_sku, $orderqty)
    {
        $updateinv = 'UPDATE inventory SET inv_qty =  inv_qty + ? WHERE prd_sku = ?';
        return $this->db->query($updateinv, array($orderqty, $prd_sku));
    }
    public function purchaseLog($ordid, $receiveqty)
    {
        $data = [
            'order_id' => $ordid,
            'receiveqty' => $receiveqty
        ];
        return $this->db->insert('purchaselog', $data);
    }
    public function updateStatusOrder($ordid)
    {
        $updateStats = 'UPDATE orderproduct SET status = 1 WHERE order_id = ?';
        return $this->db->query($updateStats, array($ordid));
    }
    public function getinvID($prd_sku)
    {
        $this->db->where('inv_id', $prd_sku);
        return $this->db->get('inventory');
    }
}
