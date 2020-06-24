<?php

class Product_model extends CI_Model
{
    public function getProductList()
    {
        return $this->db->query('SELECT * FROM product JOIN supplier ON product.supplier_id=supplier.supplier_id');
    }
    public function getAllProduct()
    {
        return  $this->db->query('SELECT * FROM product JOIN inventory ON product.prd_sku=inventory.prd_sku  JOIN supplier ON product.supplier_id=supplier.supplier_id ');
    }
    public function getPurchaseLog()
    {
        return $this->db->query('SELECT * FROM product JOIN inventory ON product.prd_sku=inventory.prd_sku  JOIN supplier ON product.supplier_id=supplier.supplier_id JOIN orderproduct ON product.prd_sku=orderproduct.prd_sku JOIN purchaselog ON orderproduct.order_id=purchaselog.order_id');
    }
    public function getSKU($sku)
    {
        $this->db->where('prd_sku', $sku);
        return $this->db->get('product');
    }
    public function getdetail($sku)
    {
        $this->db->join('supplier', 'product.supplier_id=supplier.supplier_id');
        $this->db->join('category', 'product.category_id=category.category_id');
        $this->db->join('inventory', 'product.prd_sku=inventory.prd_sku');
        $this->db->where('product.prd_sku', $sku);
        return $this->db->get('product');
    }
    public function getCategories()
    {
        return $this->db->query('SELECT * FROM category');
    }
    public function insertProduct($productname, $productdescription, $productsku, $productcategories, $supplier, $productcost, $productprice, $taxes) //$productimg)
    {
        $data = [
            'prd_sku' => $productsku,
            'prd_name' => $productname,
            'prd_desc' => $productdescription,
            //'prd_img' => $productimg,
            'prd_price' => $productprice,
            'prd_cost' => $productcost,
            'prd_taxes' => $taxes,
            'category_id' => $productcategories,
            'supplier_id' => $supplier
        ];
        return $this->db->insert('product', $data);
    }
    public function deleteProduct($prdsku, $invid, $orderid)
    {
        $this->db->delete('inventorylog', array('inv_id' => $invid));
        $this->db->delete('purchaselog', array('order_id' => $orderid));
        $this->db->delete('orderproduct', array('prd_sku' => $prdsku));
        $this->db->delete('defectlog', array('inv_id' => $invid));
        $this->db->delete('inventory', array('prd_sku' => $prdsku));
        return $this->db->delete('product', array('prd_sku' => $prdsku));
    }
    public function updateProduct($prdsku, $productname, $productdescription, $productcategories, $productcost, $productprice, $taxes)
    {
        $query = 'UPDATE product SET prd_name = ?,prd_desc = ? ,category_id =? ,prd_cost =? ,prd_price = ?,prd_taxes=? WHERE prd_sku = ?';
        return $this->db->query($query, array($productname, $productdescription, $productcategories, $productcost, $productprice, $taxes, $prdsku));
    }

    public function addCategories($categories)
    {
        $data = ['category_name ' => $categories];
        return $this->db->insert('category', $data);
    }
    public function insertOrder($prdsku, $strid, $prdqty)
    {
        $data = [
            'prd_sku' => $prdsku,
            'order_qty' => $prdqty,
            'store_id' => $strid,
            'status' => '0'
        ];
        return $this->db->insert('orderproduct', $data);
    }
    public function defectDetail($dftid)
    {
        $this->db->join('inventory', 'defectlog.inv_id=inventory.inv_id');
        $this->db->join('product', 'inventory.prd_sku=product.prd_sku');
        $this->db->join('orderproduct', 'product.prd_sku=orderproduct.prd_sku');
        $this->db->join('purchaselog', 'orderproduct.order_id=purchaselog.order_id');
        $this->db->join('store', 'orderproduct.store_id=store.store_id');
        $this->db->join('supplier', 'product.supplier_id=supplier.supplier_id');
        $this->db->where('defectlog_id', $dftid);
        return $this->db->get('defectlog');
    }
}
