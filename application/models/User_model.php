<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = "tbluser";

	public $username;
    public $password;
	public $type;
    public function rules()
    {
        return [

            ['field' => 'username',
            'label' => 'Username',
            'rules' => 'required'],
            
            ['field' => 'password',
            'label' => 'Password',
			'rules' => 'required'],
			
			['field' => 'type',
            'label' => 'Type',
			'rules' => 'required']
        ];
    }

    public function getAll()
    {
		$this->db->select('tbluser.username,tbluser.password,tbluser.type');
		$this->db->from('tbluser');
		$this->db->where('tbluser.type != "ADMIN"');
		$query = $this->db->get();
        return $query->result();
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["username" => $id])->row();
    }

    public function save()
    {
		$post = $this->input->post();
		$this->username = $post["username"];
		$this->password = md5($post["password"]);
		$this->type = $post["type"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
		$post = $this->input->post();
		$this->username = $post["username"];
		$this->password = md5($post["password"]);
		$this->type = $post["type"];
		$this->db->update($this->_table, $this, array('username' => $post['username']));
	}
	
	public function updatepwd($post)
    {
		$this->db->where('username', $post['username']);  
		$this->db->update($this->_table, array('password' => md5($post['password'])));      
		return true;  
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("username" => $id));
	}
	
	function cek_login($user, $pass){		
		$this->db->select('tbluser.username,tbluser.password,tbluser.type');
		$this->db->from('tbluser');
		$this->db->where('tbluser.username',$user);
		$this->db->where('tbluser.password',$pass);
		//$query = $this->db->get();
		return $this->db->get();
	}	
}
