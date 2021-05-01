<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing_model extends CI_Model
{
    private $_table = "tblmarketing";

    public $namamarketing;
	public $nohp;
    public function rules()
    {
        return [

            ['field' => 'namamarketing',
            'label' => 'Nama Marketing',
			'rules' => 'required'],
			
			['field' => 'nohp',
            'label' => 'No HP',
			'rules' => 'required']
        ];
    }

    public function getAll()
    {
		$this->db->select('tblmarketing.idmarketing,tblmarketing.namamarketing,tblmarketing.nohp');
		$this->db->from('tblmarketing');
		$query = $this->db->get();
        return $query->result();
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["idmarketing" => $id])->row();
    }

    public function save()
    {
		$post = $this->input->post();
		$this->namamarketing = $post["namamarketing"];
		$this->nohp = $post["nohp"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
		$post = $this->input->post();
		$this->namamarketing = $post["namamarketing"];
		$this->nohp = $post["nohp"];
		$this->db->update($this->_table, $this, array('idmarketing' => $post['idmarketing']));
	}
	

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idmarketing" => $id));
	}
	
}
