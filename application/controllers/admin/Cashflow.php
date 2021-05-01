<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cashflow extends CI_Controller
{
    public function __construct()
    {
		parent::__construct();
		// if($this->session->userdata('type') != "ADMIN"){
		// 	$this->load->view("admin/unauthorized");
		// }
		$this->load->model("cashflow_model");
		$this->load->model("po_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view("admin/cashflow/list");
    }

	public function getCashFlow() {
		// POST data
		$nama = $this->session->userdata('nama');
		$postData = $this->input->post();

		// Get data
		$data = $this->cashflow_model->getCashFlowDatatables($postData, $nama);
   
		echo json_encode($data);
	}

    public function add()
    {
		$this->session->set_flashdata('success', '');
		$nama = $this->session->userdata('nama');
		$data["po"] = $this->po_model->getAll($nama);
        $cashflow = $this->cashflow_model;
        $validation = $this->form_validation;
        $validation->set_rules($cashflow->rules());
		
        if ($validation->run()) {
            $cashflow->save($nama);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/cashflow/new_form", $data);
    }

    public function edit($id = null)
    {
		$this->session->set_flashdata('success', '');
		if (!isset($id)) redirect('admin/cashflow');
		$nama = $this->session->userdata('nama');
		$data["po"] = $this->po_model->getAll($nama);
        $cashflow = $this->cashflow_model;
        $validation = $this->form_validation;
        $validation->set_rules($cashflow->rules());

        if ($validation->run()) {
            $cashflow->update();
			$this->session->set_flashdata('success', 'Berhasil disimpan');
			redirect(site_url('admin/cashflow'));
		}
		
        $data["cashflow"] = $cashflow->getById($id);
        if (!$data["cashflow"]) show_404();
        
        $this->load->view("admin/cashflow/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->cashflow_model->delete($id)) {
            redirect(site_url('admin/cashflow'));
        }
    }
}
