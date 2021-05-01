<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    private $_table = "tblbarang";

	public $idbarang;
    public $namabrg;
	public $idsupp;
	public $harga;
    public function rules()
    {
        return [

            ['field' => 'namabrg',
            'label' => 'Nama Barang',
            'rules' => 'required'],
            
            ['field' => 'harga',
            'label' => 'Harga',
			'rules' => 'required']
        ];
    }

    public function getAll()
    {
		$this->db->select('tblbarang.idbarang,tblbarang.namabrg,tblbarang.harga,tblsupp.nama');
		$this->db->from('tblbarang');
		$this->db->join('tblsupp','tblsupp.idsupp=tblbarang.idsupp');
		$query = $this->db->get();
        return $query->result();
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
		return $this->db->get_where($this->_table, ["idbarang" => $id])->row();
    }

	public function searchBarang($params)
    {
        $this->db->select('tblbarang.idbarang,tblbarang.namabrg,tblbarang.harga');
		$this->db->from('tblbarang');
		$this->db->where("tblbarang.namabrg LIKE '%$params%' LIMIT 10");
		$query = $this->db->get();
        return $query->result();
        return $this->db->get($this->_table)->result();
	}
	
    public function save()
    {
		$post = $this->input->post();
		$this->namabrg = $post["namabrg"];
		$this->idsupp = $post["idsupp"];
		$this->harga = $post["harga"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
		$post = $this->input->post();
		$this->namabrg = $post["namabrg"];
		$this->idsupp = $post["idsupp"];
		$this->harga = $post["harga"];
		$this->db->update($this->_table, $this, array('idbarang' => $post['idbarang']));
	}
	

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idbarang" => $id));
	}
	

}
