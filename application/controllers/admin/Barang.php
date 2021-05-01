<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
		parent::__construct();
		if($this->session->userdata('type') != "ADMIN"){
			$this->load->view("admin/unauthorized");
		}
		$this->load->model("barang_model");
		$this->load->model("supplier_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["barang"] = $this->barang_model->getAll();
        $this->load->view("admin/barang/list", $data);
    }

    public function add()
    {
		$data["supplier"] = $this->supplier_model->getAll();
        $barang = $this->barang_model;
        $validation = $this->form_validation;
        $validation->set_rules($barang->rules());
		
        if ($validation->run()) {
            $barang->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/barang/new_form", $data);
    }

    public function edit($id = null)
    {
		if (!isset($id)) redirect('admin/barang');
		$data["supplier"] = $this->supplier_model->getAll();
        $barang = $this->barang_model;
        $validation = $this->form_validation;
        $validation->set_rules($barang->rules());

        if ($validation->run()) {
            $barang->update();
			$this->session->set_flashdata('success', 'Berhasil disimpan');
			redirect(site_url('admin/barang'));
		}
		
        $data["barang"] = $barang->getById($id);
        if (!$data["barang"]) show_404();
        
        $this->load->view("admin/barang/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->barang_model->delete($id)) {
            redirect(site_url('admin/barang'));
        }
    }
}
