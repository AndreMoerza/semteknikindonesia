<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing extends CI_Controller
{
    public function __construct()
    {
		parent::__construct();
		// if($this->session->userdata('type') != "ADMIN"){
		// 	$this->load->view("admin/unauthorized");
		// }
		$this->load->model("marketing_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["marketing"] = $this->marketing_model->getAll();
        $this->load->view("admin/marketing/list", $data);
    }

    public function add()
    {
		$this->session->set_flashdata('success', '');
        $marketing = $this->marketing_model;
        $validation = $this->form_validation;
        $validation->set_rules($marketing->rules());
		
        if ($validation->run()) {
            $marketing->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/marketing/new_form");
    }

    public function edit($id = null)
    {
		$this->session->set_flashdata('success', '');
        if (!isset($id)) redirect('admin/user');
        $marketing = $this->marketing_model;
        $validation = $this->form_validation;
        $validation->set_rules($marketing->rules());

        if ($validation->run()) {
            $marketing->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["marketing"] = $marketing->getById($id);
        if (!$data["marketing"]) show_404();
        
        $this->load->view("admin/marketing/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->marketing_model->delete($id)) {
            redirect(site_url('admin/marketing'));
        }
    }
}
