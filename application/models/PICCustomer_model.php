<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PICCustomer_model extends CI_Model
{
    private $_table = "tblpiccust";

	public $idcust;
    public $namapic;
	public $nohp;
    public function rules()
    {
        return [

            ['field' => 'idcust',
            'label' => 'ID Customer',
            'rules' => 'required'],
            
            ['field' => 'namapic',
            'label' => 'Nama PIC',
			'rules' => 'required'],
			
			['field' => 'nohp',
            'label' => 'No HP',
			'rules' => 'required']
        ];
    }

    public function getAll()
    {
		$this->db->select('tblpiccust.idpiccust,tblcust.nama,tblpiccust.namapic,tblpiccust.nohp');
		$this->db->from('tblpiccust');
		$this->db->join('tblcust','tblpiccust.idcust=tblcust.idcust');
		$query = $this->db->get();
        return $query->result();
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["idpiccust" => $id])->row();
	}
	
	public function getByCustId($id)
    {
		$this->db->select('tblpiccust.idpiccust,tblpiccust.namapic');
		$this->db->from('tblpiccust');
		$this->db->where("tblpiccust.idcust", $id);
		$query = $this->db->get();
        return $query->result();
        return $this->db->get($this->_table)->result();
    }

    public function save()
    {
		$post = $this->input->post();
		$this->idcust = $post["idcust"];
		$this->namapic = $post["namapic"];
		$this->nohp = $post["nohp"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
		$post = $this->input->post();
		$this->idcust = $post["idcust"];
		$this->namapic = $post["namapic"];
		$this->nohp = $post["nohp"];
		$this->db->update($this->_table, $this, array('idpiccust' => $post['idpiccust']));
	}
	

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idpiccust" => $id));
	}
	
}
