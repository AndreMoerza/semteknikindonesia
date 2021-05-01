<?php defined('BASEPATH') OR exit('No direct script access allowed');

class cashflow_model extends CI_Model
{
    private $_table = "tblcashflow";

	public $tanggal;
	public $keterangan;
	public $jumlah;
	public $ppn;
	public $nomorpo;
	public $jenis;
	public $jenis2;
	public $status;
	public $user;
    public function rules()
    {
        return [

            ['field' => 'tanggal',
            'label' => 'Tanggal',
            'rules' => 'required'],
            ['field' => 'keterangan',
            'label' => 'Keterangan',
			'rules' => 'required'],
			['field' => 'jumlah',
            'label' => 'Jumlah',
			'rules' => 'required'],
			['field' => 'jenis',
            'label' => 'Jenis',
			'rules' => 'required'],
			['field' => 'status',
            'label' => 'Status',
			'rules' => 'required'],
			
        ];
    }

    public function getAll($user)
    {
		$this->db->select('cf.kdcashflow,cf.tanggal,cf.keterangan,cf.jumlah,cf.ppn,cf.nomorpo,tblcust.nama,cf.jenis,cf.jenis2,cf.status');
		$this->db->from('tblcashflow as cf');
		$this->db->join('tblpurchaseorder','tblcashflow.nomorpo=tblpurchaseorder.nopo');
		$this->db->join('tblcust','tblpurchaseorder.idcust=tblcust.idcust');
		if ($user != 'admin')
		{
			$this->db->where('tblcashflow.user',$user);
		}
		$query = $this->db->get();
        return $query->result();
        return $this->db->get($this->_table)->result();
    }


    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["kdcashflow" => $id])->row();
    }

	public function getCashFlowDatatables($postData, $user){

		$response = array();
   
		## Read value
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value
   
		## Search 
		$searchQuery = "";
		if($searchValue != ''){
		   $searchQuery = " (cf.keterangan like '%".$searchValue."%' ";
		}
   
		## Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('tblcashflow as cf');
		$records = $this->db->get()->result();
		$totalRecords = $records[0]->allcount;
   
		## Total number of record with filtering
		$this->db->select('count(cf.kdcashflow) as allcount');
		$this->db->from('tblcashflow as cf');
		$this->db->join('tblpurchaseorder','cf.nomorpo=tblpurchaseorder.nopo');
		$this->db->join('tblcust','tblpurchaseorder.idcust=tblcust.idcust');
		if ($user != 'admin')
		{
			$this->db->where('cf.user',$user);
		}
		if($searchQuery != '')
		   $this->db->where($searchQuery);
		
		$records = $this->db->get()->result();
		$totalRecordwithFilter = $records[0]->allcount;
   
		## Fetch records
		$this->db->select('cf.kdcashflow,cf.tanggal,cf.keterangan,cf.jumlah,cf.ppn,cf.nomorpo,tblcust.nama,cf.jenis,cf.jenis2,cf.status');
		$this->db->from('tblcashflow as cf');
		$this->db->join('tblpurchaseorder','cf.nomorpo=tblpurchaseorder.nopo');
		$this->db->join('tblcust','tblpurchaseorder.idcust=tblcust.idcust');
		if ($user != 'admin')
		{
			$this->db->where('cf.user',$user);
		}
		
		if($searchQuery != '')
		   $this->db->where($searchQuery);
		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		$query = $this->db->get();
        $records = $query->result();
   
		$data = array();
   
		foreach($records as $record ){
   
		   $data[] = array( 
			  "kdcashflow"=>$record->kdcashflow,
			  "tanggal"=>$record->tanggal,
			  "keterangan"=>$record->keterangan,
			  "jumlah"=>$record->jumlah,
			  "ppn"=>$record->ppn,
			  "nomorpo"=>$record->nomorpo,
			  "nama"=>$record->nama,
			  "jenis"=>$record->jenis,
			  "jenis2"=>$record->jenis2,
			  "status"=>$record->status
		   ); 
		}
   
		## Response
		$response = array(
		   "draw" => intval($draw),
		   "iTotalRecords" => $totalRecords,
		   "iTotalDisplayRecords" => $totalRecordwithFilter,
		   "aaData" => $data
		);
   
		return $response; 
	}
    

	function count_filtered($user)
    {
        $this->db->select('tblcashflow.kdcashflow,tblcashflow.tanggal,tblcashflow.keterangan,tblcashflow.jumlah,tblcashflow.ppn,tblcashflow.nomorpo,tblcust.nama,tblcashflow.jenis,tblcashflow.jenis2,tblcashflow.status');
		$this->db->from('tblcashflow');
		$this->db->join('tblpurchaseorder','tblcashflow.nomorpo=tblpurchaseorder.nopo');
		$this->db->join('tblcust','tblpurchaseorder.idcust=tblcust.idcust');
		if ($user != 'admin')
		{
			$this->db->where('tblcashflow.user',$user);
		}
		$query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($user)
    {
        $this->db->from($this->_table);
		if ($user != 'admin')
		{
			$this->db->where('tblcashflow.user',$user);
		}
        return $this->db->count_all_results();
    }

    public function save($user)
    {
		$post = $this->input->post();
		$this->tanggal = $post["tanggal"];
		$this->keterangan = $post["keterangan"];
		$this->jumlah = $post["jumlah"];
		$this->ppn = $post["ppn"];
		$this->nomorpo = $post["nomorpo"];
		$this->jenis = $post["jenis"];
		$this->jenis2 = $post["jenis2"];
		$this->status = $post["status"];
		$this->user = $user;
        $this->db->insert($this->_table, $this);
    }


    public function update()
    {
		$post = $this->input->post();
		$this->tanggal = $post["tanggal"];
		$this->keterangan = $post["keterangan"];
		$this->jumlah = $post["jumlah"];
		$this->ppn = $post["ppn"];
		$this->nomorpo = $post["nomorpo"];
		$this->jenis = $post["jenis"];
		$this->jenis2 = $post["jenis2"];
		$this->status = $post["status"];
		$this->db->update($this->_table, $this, array('kdcashflow' => $post['kdcashflow']));
	}
	

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("kdcashflow" => $id));
	}
	

}
