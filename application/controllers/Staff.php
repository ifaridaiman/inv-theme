<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Staff_model');
        $this->load->model('Product_model');
        $this->load->model('Store_model');
    }
    public function index()
    {
        //variable
        $data['title'] = "Staff Desk";
        $data['systemname'] = "SIMORG";

        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] != '2') {
                echo $_SESSION['role'];
                //redirect(base_url());
            } else {
                $data['getOrderReceivable'] = $this->Staff_model->getOrderReceivable();
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidestaff', $data);
                $this->load->view('staff/index', $data);
                $this->receivableInfo();
                $this->load->view('templates/footer');
            }
        } else {
            redirect(base_url());
        }
    }
    public function receivableInfo()
    {
        $this->load->view('staff/stockinfo');
    }
    public function receivableValidation()
    {
        //variable
        $data['title'] = "Staff Desk";
        $data['systemname'] = "SIMORG";

        $data['ordid'] = $_GET['orderid'];
        $ordid = $this->input->post('orderid');
        $stid = $_SESSION['storeid'];
        $prdsku = $this->input->post('productsku');
        $orderqty = $this->input->post('receivedqty');

        //get order detail from table orderproduct
        $data['detail'] = $this->Staff_model->getDetailOrderReceivable($_GET['orderid']);
        if (isset($orderqty)) {
            //record purchase log
            $purchaselog = $this->Staff_model->purchaseLog($ordid, $orderqty);
            if ($purchaselog == '1') {
                //get the inventory detail from table inventory 
                $getList = $this->Staff_model->getInventoryList();
                foreach ($getList->result_array() as $invcheck) {
                    //if prd_sku is same update the inventory
                    if ($invcheck['prd_sku'] == $prdsku) {

                        // update inventory
                        $updateInventory = $this->Staff_model->receivableUpdateValidation($stid, $prdsku, $orderqty);
                        //if inventory is update the number of inv_qty
                        if ($updateInventory == '1') {
                            // update orderproduct status
                            $this->Staff_model->updateStatusOrder($ordid);
                            // make inventory log
                            $act_log = 'Stock in';
                            $inventorylog = $this->Store_model->logInventory($act_log, $invcheck['inv_id'], $orderqty, $_SESSION['storeid']);
                            if ($inventorylog == '1') {
                                header('Location:' . base_url());
                            } else {
                                echo 'inventory log problem';
                            }
                        } else {
                            echo 'product is not succefully update';
                        }
                    } else {
                        echo 'product do not exist in inventory';
                    }
                }
            } else {
                echo 'check on purchaselog';
            }
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidestaff', $data);
            $this->load->view('staff/stockvalidation', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function defectreport()
    {
        //variable
        $data['systemname'] = 'SIMORG';
        $data['getProduct'] = $this->Product_model->getAllProduct();

        $this->form_validation->set_rules('invid', 'invid', 'required|trim');
        $this->form_validation->set_rules('defectqty', 'defectqty', 'required|trim');
        $this->form_validation->set_rules('defectdesc', 'defectdesc', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidestaff', $data);
            $this->load->view('staff/defectreport', $data);
        } else {
            $invid = $this->input->post('invid');
            $defectqty = $this->input->post('defectqty');
            $defectdesc = $this->input->post('defectdesc');
            // defect log table 
            $checkdefect = $this->Staff_model->insertDefect($invid, $defectqty, $defectdesc);
            if ($checkdefect == '1') {
                //update for inventory table
                $this->Staff_model->updateInventoryDefect($invid, $defectqty);
                // make inventory log
                $act_log = 'Defect Item out';
                $inventorylog = $this->Store_model->logInventory($act_log, $invid, $defectqty, $_SESSION['storeid']);
                if ($inventorylog == '1') {
                    header('Location:' . base_url());
                } else {
                    echo 'error at invenntory log';
                }
            } else {
                echo 'error at inserting defect';
            }
        }
    }
}
