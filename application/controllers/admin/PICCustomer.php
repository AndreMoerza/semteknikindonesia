<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PICCustomer extends CI_Controller
{
    public function __construct()
    {
		parent::__construct();
		// if($this->session->userdata('type') != "ADMIN"){
		// 	$this->load->view("admin/unauthorized");
		// }
		$this->load->model("piccustomer_model");
		$this->load->model("customer_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["piccustomer"] = $this->piccustomer_model->getAll();
        $this->load->view("admin/piccustomer/list", $data);
    }

    public function add()
    {
		$this->session->set_flashdata('success', '');
		$data["customer"] = $this->customer_model->getAll();
        $piccustomer = $this->piccustomer_model;
        $validation = $this->form_validation;
        $validation->set_rules($piccustomer->rules());
		
        if ($validation->run()) {
            $piccustomer->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/piccustomer/new_form", $data);
    }

    public function edit($id = null)
    {
		if (!isset($id)) redirect('admin/user');
		$data["customer"] = $this->customer_model->getAll();
        $piccustomer = $this->piccustomer_model;
        $validation = $this->form_validation;
        $validation->set_rules($piccustomer->rules());

        if ($validation->run()) {
            $piccustomer->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["piccustomer"] = $piccustomer->getById($id);
        if (!$data["piccustomer"]) show_404();
        
        $this->load->view("admin/piccustomer/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->piccustomer_model->delete($id)) {
            redirect(site_url('admin/piccustomer'));
        }
    }
}
