<?php

class Store_model extends CI_Model
{
    public function getStore()
    {
        return  $this->db->count_all('store');
    }
    public function getStorename()
    {
        return $this->db->get('store');
    }
    public function getEmployeeStore($id)
    {
        return $this->db->query('SELECT * FROM manage JOIN store on manage.store_id=store.store_id WHERE manage.usr_id=' . $id);
    }
    public function insertInventory($qtyideal, $qtyinventory, $qtywrn, $productsku)
    {
        $data = [
            'inv_qty' => $qtyinventory,
            'inv_ideal_qty' => $qtyideal,
            'inv_warning_qty' => $qtywrn,
            'prd_sku' => $productsku
        ];

        $this->db->insert('inventory', $data);
        return $this->db->insert_id();
    }
    public function logInventory($act_log, $getID, $qtyinventory, $storeid)
    {
        $data = [
            'inv_id' => $getID,
            'invlog_activity' => $act_log,
            'invlog_qty' => $qtyinventory,
            'store_id' => $storeid
        ];
        return $this->db->insert('inventorylog', $data);
    }
    // get the lowanalysis in admin/index
    public function lowanalysis()
    {
        return $this->db->query('SELECT * FROM inventory JOIN product ON inventory.prd_sku = product.prd_sku JOIN supplier ON product.supplier_id = supplier.supplier_id WHERE inv_warning_qty > inv_qty  ORDER BY ((prd_price - prd_cost)/prd_cost) DESC');
    }
    public function graphanalysis()
    {




        $this->db->select('FORMAT((inv_qty*prd_cost),2) as Y , FORMAT((invlog_qty*prd_price),2) as X, prd_name,invlog_timestamp');
        $this->db->join('product', 'inventory.prd_sku=product.prd_sku');
        $this->db->join('inventorylog', 'inventory.inv_id = inventorylog.inv_id');
        $this->db->where('invlog_activity', 'Stock in');
        return $this->db->get('inventory');
        // $this->db->select('prd_sku,inv_qty');
        // return $this->db->get('inventory');
        // return $this->db->query('SELECT Count(*) as invcount FROM inventory');
    }
    public function costused()
    {
        return $this->db->query('SELECT 
         SUM(ROUND(( inv_ideal_qty - inv_qty )*( prd_cost + ( prd_cost * prd_taxes )),2)) AS balance FROM inventory JOIN product ON inventory.prd_sku = product.prd_sku
         WHERE  inv_warning_qty  >  inv_qty ');
    }
}
