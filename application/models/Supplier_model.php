<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model
{
    private $_table = "tblsupp";

	public $idsupp;
    public $npwp;
	public $nama;
	public $alamat;
	public $telepon;
    public function rules()
    {
        return [

            ['field' => 'npwp',
            'label' => 'NPWP',
            'rules' => 'required'],
            
            ['field' => 'nama',
            'label' => 'Nama',
			'rules' => 'required'],
			
			['field' => 'alamat',
            'label' => 'Alamat',
			'rules' => 'required'],

			['field' => 'telepon',
            'label' => 'Telepon',
			'rules' => 'required']
        ];
    }

    public function getAll()
    {
		$this->db->select('tblsupp.idsupp,tblsupp.npwp,tblsupp.nama,tblsupp.alamat,tblsupp.telepon');
		$this->db->from('tblsupp');
		$query = $this->db->get();
        return $query->result();
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["idsupp" => $id])->row();
    }

    public function save()
    {
		$post = $this->input->post();
		$this->npwp = $post["npwp"];
		$this->nama = $post["nama"];
		$this->alamat = $post["alamat"];
		$this->telepon = $post["telepon"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
		$post = $this->input->post();
		$this->npwp = $post["npwp"];
		$this->nama = $post["nama"];
		$this->alamat = $post["alamat"];
		$this->telepon = $post["telepon"];
		$this->db->update($this->_table, $this, array('idsupp' => $post['idsupp']));
	}
	

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idsupp" => $id));
	}
	

}
