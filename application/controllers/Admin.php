<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Product_model');
        $this->load->model('Supplier_model');
        $this->load->model('Store_model');
        $this->load->model('Staff_model');
        //file upload -- start
        $config['upload_path'] = '../assets/img/product';
        $config['allowed_type'] = 'jpg | png ';
        $config['max_width'] = '1028';
        $config['max_height'] = '786';
        $this->load->library('upload', $config);
        //file upload -- end
    }

    //dashboard
    public function index()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] != '1') {
                $this->load->view('errors/forbiddenaccess');
            } else {
                //variable
                $data['systemname'] = 'SIMORG';

                $data['lowlist'] = $this->Store_model->lowanalysis();
                $data['budgetcost'] = $this->Store_model->costused();
                $chart = $this->Store_model->graphanalysis()->result();
                $data['chart'] = json_encode($chart);
                // //load-view
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sideadmin', $data);
                $this->load->view('admin/index', $data);
                $this->load->view('templates/footer');
            }
        } else {
            redirect(base_url());
        }
    }
    //low stock analysis
    public function lowstockanalysis()
    {
    }
    // product management 
    public function productmanagement()
    {
        //variable
        $data['systemname'] = 'SIMORG';
        $data['products'] =  $this->Product_model->getProductList();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sideadmin', $data);
        $this->load->view('admin/productmanagement/index', $data);
        $this->load->view('templates/footer');
    }
    //add new stock
    public function addnewproduct()
    {
        // variable
        $data['systemname'] = 'SIMORG';

        //models
        $data['suppliername'] = $this->Supplier_model->getAllSupplier();
        $data['categoriesname'] = $this->Product_model->getCategories();
        $storecount = $this->Store_model->getStore();
        $data['store'] = $storecount;
        //categoris try 
        $this->_addcategories();
        //form validation
        /*
            product name, product description, product sku, product categories, supplier, product cost, product price
            taxes,product img
            */
        $this->form_validation->set_rules('productname', 'productname', 'required|trim');
        $this->form_validation->set_rules('productdescription', 'productdescription', 'required|trim');
        $this->form_validation->set_rules('productsku', 'productsku', 'required|trim');
        $this->form_validation->set_rules('productcategories', 'productcategories', 'required|trim');
        $this->form_validation->set_rules('supplier', 'supplier', 'required|trim');
        $this->form_validation->set_rules('productcost', 'productcost', 'required|trim');
        $this->form_validation->set_rules('productprice', 'productprice', 'required|trim');
        $this->form_validation->set_rules('producttax', 'producttax', 'required|trim');
        //$this->form_validation->set_rules('productimage', 'productimage', 'required|trim');


        //views 
        //check the form validation 
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sideadmin', $data);
            $this->load->view('admin/stockmanagement/addnewstock', $data);
            $this->load->view('templates/footer');
        } else {
            $this->_addnewstock($storecount);
        }
    }

    private function _addcategories()
    {
        if (isset($_POST['categories'])) {
            $categories = $this->input->post('categories');
            $categoriescheck = $this->Product_model->addCategories($categories);
            if ($categoriescheck == '1') {
                header('Location: ' . base_url() . 'admin/addnewproduct');
            } else {
                echo 'problem categories';
            }
        }
    }
    private function _addnewstock($storecount)
    {
        //variable
        $count = 1;
        //input product
        $productname = $this->input->post('productname');
        $productdescription =  $this->input->post('productdescription');
        $productsku = $this->input->post('productsku');
        $productcategories = $this->input->post('productcategories');
        $supplier = $this->input->post('supplier');
        $productcost = $this->input->post('productcost');
        $productprice = $this->input->post('productprice');
        $taxes = $this->input->post('producttax');
        //$productimg = $this->input->post('productimage');

        $qtyinventory = 0;
        $qtyideal = $this->input->post('stockidealqty');
        $qtywrn = $this->input->post('stockwrnqty');

        //check the sku 
        $skucheck = $this->Product_model->getSKU($productsku)->result_array();
        //check the sku 
        $skucheck = $this->Product_model->getSKU($productsku);

        //enter the product 
        $check = $this->Product_model->insertProduct($productname, $productdescription, $productsku, $productcategories, $supplier, $productcost, $productprice, $taxes); //$productimg);
        //initialize inventory
        $getID = $this->Store_model->insertInventory($qtyideal, $qtyinventory, $qtywrn, $productsku);

        if ($check == '1') {

            //inventory log
            $act_log = 'Stock Register';
            $inventorylog = $this->Store_model->logInventory($act_log, $getID, $qtyinventory, $_SESSION['storeid']);
            if ($inventorylog == '1') {
                header('Location:' . base_url() . 'admin/restock?prd_sku=' . $productsku);
            } else {
                echo var_dump($inventorylog);
                echo 'problem at inventory log';
            }
        } else {
            echo 'problem';
        }
    }
    public function deleteproduct()
    {

        $ck_inv = $this->Product_model->getPurchaseLog();
        foreach ($ck_inv->result_array() as $checkInv) {
            if ($checkInv['prd_sku'] == $_GET['prdsku']) {
                $checkdelete = $this->Product_model->deleteProduct($_GET['prdsku'], $checkInv['inv_id'], $checkInv['order_id']);

                if ($checkdelete == '1') {
                    header('Location: ' . base_url() . 'admin/productmanagement');
                } else {
                    $this->session->set_flashdata('fmsg', '<div class="alert alert-danger" role="alert">Product Cannot be deleted, Remove product inventory first</div>');
                }
            } else {
                $this->session->set_flashdata('fmsg', '<div class="alert alert-danger" role="alert">Product Cannot be deleted, Remove product inventory first</div>');
                header('Location: ' . base_url() . 'admin/productmanagement');
            }
        }
    }

    public function editproduct()
    {
        //variable
        $data['systemname'] = 'SIMORG';

        $data['products'] =  $this->Product_model->getdetail($_GET['prd_sku']);
        $data['suppliername'] = $this->Supplier_model->getAllSupplier();
        $data['categoriesname'] = $this->Product_model->getCategories();

        $this->form_validation->set_rules('productname', 'productname', 'required|trim');
        $this->form_validation->set_rules('productdescription', 'productdescription', 'required|trim');
        $this->form_validation->set_rules('productcategories', 'productcategories', 'required|trim');
        $this->form_validation->set_rules('productcost', 'productcost', 'required|trim');
        $this->form_validation->set_rules('productprice', 'productprice', 'required|trim');
        $this->form_validation->set_rules('producttax', 'producttax', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sideadmin', $data);
            $this->load->view('admin/productmanagement/editproduct', $data);
            $this->load->view('templates/footer');
        } else {

            $productname = $this->input->post('productname');
            $productdescription =  $this->input->post('productdescription');
            $productcategories = $this->input->post('productcategories');
            $productcost = $this->input->post('productcost');
            $productprice = $this->input->post('productprice');
            $taxes = $this->input->post('producttax');

            $editcheck = $this->Product_model->updateProduct($_GET['prd_sku'], $productname, $productdescription, $productcategories, $productcost, $productprice, $taxes);
            if ($editcheck == '1') {
                header('Location: ' . base_url() . 'admin/productmanagement');
            } else {
                echo 'problem';
            }
        }
    }
    //stockmanagement
    public function stockmanagement()
    {
        //variable
        $data['systemname'] = 'SIMORG';
        $data['products'] =  $this->Product_model->getAllProduct();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sideadmin', $data);
        $this->load->view('admin/stockmanagement/index', $data);

        // $this->addnewsupplier();
        // $this->restock();
        // $this->productinfo();
        // $this->transfer();
        $this->load->view('templates/footer');
    }
    //public function 

    public function restock()
    {
        //variable
        $data['systemname'] = 'SIMORG';

        $data['getProduct'] = $this->Product_model->getAllProduct();
        $data['getStore'] = $this->Store_model->getStorename();


        $this->form_validation->set_rules('prdsku', 'prdsku', 'required|trim');
        $this->form_validation->set_rules('storeid', 'storeid', 'required|trim');
        $this->form_validation->set_rules('orderqty', 'orderqty', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sideadmin', $data);
            $this->load->view('admin/stockmanagement/stockorder', $data);
            $this->load->view('templates/footer');
        } else {
            $this->_restock();
        }
    }
    private function _restock()
    {
        $prdsku = $this->input->post('prdsku');
        $storeid = $this->input->post('storeid');
        $orderqty = $this->input->post('orderqty');


        $ordercheck = $this->Product_model->insertOrder($prdsku, $storeid, $orderqty);

        if ($ordercheck == '1') {
            header('Location: ' . base_url() . 'admin/productmanagement');
        } else {
            echo 'check error';
        }
    }
    public function stocktransfer()
    {
        //variable
        $data['systemname'] = 'SIMORG';

        $id = $_SESSION['id'];
        $data['products'] =  $this->Product_model->getdetail($_GET['prdsku']);
        $data['store'] =  $this->Store_model->getEmployeeStore($id);


        $this->form_validation->set_rules('transferqty', 'transferqty', 'required|trim');
        $this->form_validation->set_rules('storelist', 'storelist', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sideadmin', $data);
            $this->load->view('admin/stockmanagement/stocktransfer', $data);
            $this->load->view('templates/footer');
        } else {
            $prdsku = $this->input->post('productsku');
            $invid = $this->input->post('invid');
            $qtyinventory = $this->input->post('transferqty');
            $storeid = $this->input->post('storelist');
            $act_log = 'transfer to store ' . $storeid;


            $inventorylog = $this->Store_model->logInventory($act_log, $invid, $qtyinventory, $storeid);
            if ($inventorylog == '1') {
                $prdsku = $this->input->post('productsku');
                $invid = $this->input->post('invid');
                $qtyinventory = $this->input->post('transferqty');
                $storeid = $this->input->post('storelist');
                $act_log = 'Stock in';
                $inventorylog1 = $this->Store_model->logInventory($act_log, $invid, $qtyinventory, $storeid);
                if ($inventorylog1 == '1') {
                    header('Location:' . base_url() . '/admin/stockmanagement');
                } else {
                    header('Location:' . base_url() . '/admin/stocktransfer?prdsku=' . $prdsku);
                }
            } else {
                header('Location:' . base_url() . '/admin/stocktransfer?prdsku=' . $prdsku);
            }
        }
    }
    //defect management
    public function defectmanagement()
    {
        //variable
        $data['systemname'] = 'SIMORG';

        $data['defectlist'] = $this->Staff_model->getDefectlist();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sideadmin', $data);
        $this->load->view('admin/defectmanagement/index', $data);
        $this->load->view('templates/footer');
    }
    public function defectform()
    {
        $id = $_GET['dfctid'];
        $defect =  $this->Product_model->defectDetail($id);
        $data['defectinfo'] = $defect;
        $this->load->view('templates/header', $data);
        $this->load->view('admin/defectmanagement/defectform', $data);
        $this->load->view('templates/footer');
    }
    //supplier management
    public function suppliermanagement()
    {
        //variable
        $data['systemname'] = 'SIMORG';
        $data['supplier'] =  $this->Supplier_model->getAllSupplier();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sideadmin', $data);
        $this->load->view('admin/supplier/index', $data);

        //validation 
        if (isset($_POST['suppliername'])) {
            $this->form_validation->set_rules('suppliername', 'suppliername', 'required|trim');
            $this->form_validation->set_rules('supplieraddress', 'supplieraddress', 'required|trim');
            $this->form_validation->set_rules('supplierphonenumber', 'supplierphonenumber', 'required|trim');
            $this->form_validation->set_rules('supplieremail', 'supplieremail', 'required|trim');
            //process
            if ($this->form_validation->run() == false) {
                header('Location:' . base_url() . '/admin/suppliermanagement');
                $fmsg = "Problem in validation of form, contact system admin";
            } else {
                $this->addnewsupplier();
            }
        }

        // $this->viewsupplier();
        // $this->editsupplier();
        $this->load->view('templates/footer');
    }
    private function addnewsupplier()
    {
        //variable
        $suppliername = $this->input->post('suppliername');
        $supplieraddress = $this->input->post('supplieraddress');
        $supplierphonenumber = $this->input->post('supplierphonenumber');
        $supplieremail = $this->input->post('supplieremail');

        //process
        $suppliercheck = $this->Supplier_model->insertSupplier($suppliername, $supplieraddress, $supplierphonenumber, $supplieremail);
        if ($suppliercheck == '1') {
            header('Location: ' . base_url() . 'admin/suppliermanagement');
        } else {
            echo 'problem in supplier add process';
        }
    }
    public function editsupplier()
    {
        //variable
        $data['systemname'] = 'SIMORG';

        $data['supplier'] =  $this->Supplier_model->getSupplierID($_GET['spid']);

        $this->form_validation->set_rules('supplieraddress', 'supplieraddress', 'required|trim');
        $this->form_validation->set_rules('supplierphonenumber', 'supplierphonenumber', 'required|trim');
        $this->form_validation->set_rules('supplieremail', 'supplieremail', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sideadmin', $data);
            $this->load->view('admin/supplier/editsupplier');
            $this->load->view('templates/footer', $data);
        } else {

            $supplieremail = $this->input->post('supplieremail');
            $supplieraddress = $this->input->post('supplieraddress');
            $supplierphonenumber = $this->input->post('supplierphonenumber');

            $editcheck = $this->Supplier_model->editSupplier($_GET['spid'],  $supplieraddress, $supplierphonenumber, $supplieremail);
            if ($editcheck == '1') {
                header('Location: ' . base_url() . 'admin/suppliermanagement');
            } else {
                echo 'problem';
            }
        }
    }
}
   
    // public function viewsupplier()
    // {
    //     $this->load->view('admin/supplier/viewsupplier');
    // }
