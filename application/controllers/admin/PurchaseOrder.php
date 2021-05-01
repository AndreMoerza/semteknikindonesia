<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseOrder extends CI_Controller
{
    public function __construct()
    {
		parent::__construct();
		// if($this->session->userdata('type') != "ADMIN"){
		// 	$this->load->view("admin/unauthorized");
		// }
		$this->load->model("po_model");
		$this->load->model("podetail_model");
		$this->load->model("customer_model");
		$this->load->model("piccustomer_model");
		$this->load->model("marketing_model");
		$this->load->model("barang_model");
        $this->load->library('form_validation');
    }

    // public function index()
    // {
    //     $data["po"] = $this->po_model->getAll();
    //     $this->load->view("admin/purchaseorder/list", $data);
    // }

	public function index()
    {
        $this->load->view("admin/purchaseorder/list");
    }

	public function getAllPO() {
		$nama = $this->session->userdata('nama');
		// POST data
		$postData = $this->input->post();

		// Get data
		$data = $this->po_model->getPODatatables($postData, $nama);
   
		echo json_encode($data);
	}

    public function add()
    {
		$this->session->set_flashdata('success', '');
		$data["customer"] = $this->customer_model->getAll();
		$data["piccustomer"] = $this->piccustomer_model->getAll();
		$data["marketing"] = $this->marketing_model->getAll();
        $po = $this->po_model;
        $validation = $this->form_validation;
        $validation->set_rules($po->rules());
		
        if ($validation->run()) {
            $po->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/purchaseorder/new_form", $data);
    }

    public function edit($id = null)
    {
		if (!isset($id)) redirect('admin/user');
		$this->session->set_flashdata('success', '');
		$data["customer"] = $this->customer_model->getAll();
		
		$data["marketing"] = $this->marketing_model->getAll();
		$data["po"] = $this->po_model->getPOById($id);
		
		if (!$data["po"]) show_404();


		$data["piccustomer"] = $this->piccustomer_model->getByCustId($data["po"]->idcust);
        $this->load->view("admin/purchaseorder/edit_form", $data);
    }

	public function getDetailPO($id = null){
		$query = $_POST["query"];
        if (!isset($query)) show_404();
		$dataDetail = $this->podetail_model->getDetailPOById($query);
		$this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($dataDetail));
	}

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->po_model->delete($id)) {
            redirect(site_url('admin/purchaseorder'));
        }
	}
	
	public function searchCustomer()
    {
		$query = $_POST["query"];
        if (!isset($query)) show_404();
				
		$res = $this->customer_model->searchCustomer($query);
		$output = '';
		$output = '<ul class="list-unstyled">';
		if($res > 0){
			foreach ($res as $row) {
				$output .= "<li onclick=\"setValueCustomer('{$row->idcust}', '{$row->nama}')\">{$row->nama}</li>";  
			}
		} else {
		$output .= '<li>Tidak ada yang cocok.</li>';  
		}  
		$output .= '</ul>';
		echo $output;
		
	}
	
	public function getPICCustomer()
    {
		$idcust = $_POST["idcust"];
		if (!isset($idcust)) show_404();
		$res = $this->piccustomer_model->getByCustId($idcust);

		$output = '';
		if($res > 0){
			foreach ($res as $row) {
				$output .= "<option value=\"{$row->idpiccust}\">{$row->namapic}</option>";  
			}
		}  
		echo $output;
	}

	public function searchBarang()
    {
		$query = $_POST["query"];
        if (!isset($query)) show_404();
				
		$res = $this->barang_model->searchBarang($query);
		$output = '';
		$output = '<ul class="list-unstyled">';
		if($res > 0){
			foreach ($res as $row) {
				$output .= "<li onclick=\"setValueBarang('{$row->idbarang}', '{$row->namabrg}', '{$row->harga}')\">{$row->namabrg}</li>";  
			}
		} else {
		$output .= '<li>Tidak ada yang cocok.</li>';  
		}  
		$output .= '</ul>';
		echo $output;
		
	}

	public function simpanPO()
    {
		$dataPO = $_POST["datapo"];
        if (!isset($dataPO)) show_404();
		
		$po = $this->po_model;
		$detailpo = $this->podetail_model;
		$po->savePO($dataPO["po"]);
		$nopo = $dataPO["po"]["nopo"];
		foreach ($dataPO["detailPO"] as $row) {
			$detailpo->saveDetailPO($nopo, $row);
		}

		redirect(site_url('admin/purchaseorder'));
		$this->session->set_flashdata('success', 'Berhasil disimpan');
		
		
	}

	public function updatePO()
    {
		$dataPO = $_POST["datapo"];
        if (!isset($dataPO)) show_404();
		
		$po = $this->po_model;
		$detailpo = $this->podetail_model;
		$po->updatePO($dataPO["po"]);
		$nopo = $dataPO["po"]["nopo"];
		$detailpo->delete($nopo);
		foreach ($dataPO["detailPO"] as $row) {
			$detailpo->saveDetailPO($nopo, $row);
		}

		redirect(site_url('admin/purchaseorder'));
		$this->session->set_flashdata('success', 'Berhasil disimpan');
		
		
	}

	public function deletePO()
    {
		$dataPO = $_POST["datapo"];
        if (!isset($dataPO)) show_404();
		foreach ($dataPO as $row) {
			$po = $this->po_model;
			$detailpo = $this->podetail_model;
			$po->delete($row);
			$detailpo->delete($row);
		}
		redirect(site_url('admin/purchaseorder'));
		$this->session->set_flashdata('success', 'Berhasil disimpan');
	}

	public function cetakInvoice($id = null)
    {
		$dataPO = $this->po_model->getPOById($id);
		$dataDetailPO = $this->podetail_model->getDetailPOById($id);
		$data["po"]= $dataPO;
		$data["detailpo"]= $dataDetailPO;
		
		$this->load->library('pdf');

		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "INVOICE.pdf";
		$this->pdf->load_view('admin/purchaseorder/templateCetakInvoice', $data);
		

    }

	public function cetakInvoices()
    {
		$id = $_POST["datapo"];
        if (!isset($id)) show_404();
		$dataPO = $this->po_model->getPOById($id);
		$dataDetailPO = $this->podetail_model->getDetailPOById($id);
		$data["po"]= $dataPO;
		$data["detailpo"]= $dataDetailPO;
		
		$this->load->library('pdf');

		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "INVOICE.pdf";
		$this->pdf->load_view('admin/purchaseorder/templateCetakInvoice', $data);
		

    }
}
