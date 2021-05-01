<?php defined('BASEPATH') OR exit('No direct script access allowed');

class podetail_model extends CI_Model
{
    private $_table = "tblpurchaseorder_detail";

	public $nopo;
	public $idbarang;
	public $harga;
	public $quantity;
	public $status;
    public function rules()
    {
        return [

            ['field' => 'nopo',
            'label' => 'No PO',
            'rules' => 'required'],
            ['field' => 'idbarang',
            'label' => 'Barang',
			'rules' => 'required'],
			['field' => 'harga',
            'label' => 'Harga',
			'rules' => 'required'],
			['field' => 'quantity',
            'label' => 'Jumlah Barang',
			'rules' => 'required'],
			
        ];
    }

    public function getAll()
    {
		$this->db->select('tblpurchaseorder_detail.nopo,tblpurchaseorder_detail.idbarang,tblbarang.namabrg,tblpurchaseorder_detail.harga,tblpurchaseorder_detail.quantity');
		$this->db->from('tblpurchaseorder_detail');
		$this->db->join('tblbarang','tblpurchaseorder_detail.idbarang=tblbarang.idbarang');
		$query = $this->db->get();
        return $query->result();
        return $this->db->get($this->_table)->result();
    }

	public function getDetailPOById($id)
    {
		$this->db->select('tblpurchaseorder_detail.nopo,tblpurchaseorder_detail.idbarang,tblbarang.namabrg,tblpurchaseorder_detail.harga,tblpurchaseorder_detail.quantity,tblpurchaseorder_detail.status');
		$this->db->from('tblpurchaseorder_detail');
		$this->db->join('tblbarang','tblpurchaseorder_detail.idbarang=tblbarang.idbarang');
		$this->db->where("tblpurchaseorder_detail.nopo", $id);
		$query = $this->db->get();
        return $query->result();
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["nopo" => $id])->row();
    }

    public function save()
    {
		$post = $this->input->post();
		$this->nopo = $post["nopo"];
		$this->idbarang = $post["idbarang"];
		$this->harga = $post["harga"];
		$this->quantity = $post["quantity"];
		$this->status = $post["status"];
        $this->db->insert($this->_table, $this);
    }

	public function saveDetailPO($nopo, $detailpo)
    {
		$this->nopo = $nopo;
		$this->idbarang = $detailpo["idbarang"];
		$this->harga = $detailpo["harga"];
		$this->quantity = $detailpo["jumlah"];
		$this->status = $detailpo["status"];
        $this->db->insert($this->_table, $this);
    }
	

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("nopo" => $id));
	}
	

}
