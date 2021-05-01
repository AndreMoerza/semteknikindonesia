<?php defined('BASEPATH') OR exit('No direct script access allowed');

class po_model extends CI_Model
{
    private $_table = "tblpurchaseorder";

	public $nopo;
    public $tanggalpo;
	public $idcust;
	public $idpiccust;
	public $idmarketing;
	public $potongan;
	public $ppn;
	public $total;
    public function rules()
    {
        return [

            ['field' => 'nopo',
            'label' => 'No PO',
            'rules' => 'required'],
            ['field' => 'tanggalpo',
            'label' => 'Tanggal PO',
			'rules' => 'required'],
			['field' => 'idcust',
            'label' => 'Customer',
			'rules' => 'required'],
			['field' => 'idpiccust',
            'label' => 'PIC Customer',
			'rules' => 'required'],
			['field' => 'idmarketing',
            'label' => 'Marketing',
			'rules' => 'required'],
			['field' => 'potongan',
            'label' => 'Potongan',
			'rules' => 'required'],
			['field' => 'ppn',
            'label' => 'PPN',
			'rules' => 'required'],
			['field' => 'total',
            'label' => 'Total',
			'rules' => 'required']
        ];
    }

    public function getAll($user)
    {
		$this->db->select('tblpurchaseorder.nopo,tblpurchaseorder.tanggalpo,tblcust.nama,tblpiccust.namapic,tblmarketing.namamarketing,tblpurchaseorder.potongan,tblpurchaseorder.ppn,tblpurchaseorder.total');
		$this->db->from('tblpurchaseorder');
		$this->db->join('tblcust','tblpurchaseorder.idcust=tblcust.idcust');
		$this->db->join('tblpiccust','tblpurchaseorder.idpiccust=tblpiccust.idpiccust');
		$this->db->join('tblmarketing','tblpurchaseorder.idmarketing=tblmarketing.idmarketing');
		if ($user != 'admin')
		{
			$this->db->where('tblpurchaseorder.user',$user);
		}
		$query = $this->db->get();
        return $query->result();
        return $this->db->get($this->_table)->result();
    }

	public function getPODatatables($postData, $user){

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
		   $searchQuery = " (po.nopo like '%".$searchValue."%' or tblcust.nama like '%".$searchValue."%' ) ";
		}
   
		## Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('tblpurchaseorder as po');
		if ($user != 'admin')
		{
			$this->db->where('po.user',$user);
		}
		$records = $this->db->get()->result();
		$totalRecords = $records[0]->allcount;
   
		## Total number of record with filtering
		$this->db->select('count(po.nopo) as allcount');
		$this->db->from('tblpurchaseorder as po');
		$this->db->join('tblcust','po.idcust=tblcust.idcust');
		if ($user != 'admin')
		{
			$this->db->where('po.user',$user);
		}
		if($searchQuery != '')
		   $this->db->where($searchQuery);
		$records = $this->db->get()->result();
		$totalRecordwithFilter = $records[0]->allcount;
   
		## Fetch records
		$this->db->select('po.nopo,po.tanggalpo,tblcust.nama,tblpiccust.namapic,tblmarketing.namamarketing,po.potongan,po.ppn,po.total');
		$this->db->from('tblpurchaseorder as po');
		$this->db->join('tblcust','po.idcust=tblcust.idcust');
		$this->db->join('tblpiccust','po.idpiccust=tblpiccust.idpiccust');
		$this->db->join('tblmarketing','po.idmarketing=tblmarketing.idmarketing');
		if ($user != 'admin')
		{
			$this->db->where('po.user',$user);
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
			  "nopo"=>$record->nopo,
			  "tanggalpo"=>$record->tanggalpo,
			  "nama"=>$record->nama,
			  "namapic"=>$record->namapic,
			  "namamarketing"=>$record->namamarketing,
			  "potongan"=>$record->potongan,
			  "ppn"=>$record->ppn,
			  "total"=>$record->total
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
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["nopo" => $id])->row();
    }

	public function getPOById($id)
    {
		$this->db->select('tblpurchaseorder.nopo,tblpurchaseorder.tanggalpo,tblcust.idcust,tblcust.nama,tblcust.alamat,tblcust.telepon,tblpiccust.idpiccust,tblpiccust.namapic,tblmarketing.idmarketing,tblmarketing.namamarketing,tblpurchaseorder.potongan,tblpurchaseorder.ppn,tblpurchaseorder.total');
		$this->db->from('tblpurchaseorder');
		$this->db->join('tblcust','tblpurchaseorder.idcust=tblcust.idcust');
		$this->db->join('tblpiccust','tblpurchaseorder.idpiccust=tblpiccust.idpiccust');
		$this->db->join('tblmarketing','tblpurchaseorder.idmarketing=tblmarketing.idmarketing');
		$this->db->where("tblpurchaseorder.nopo", $id);
		$query = $this->db->get();
        return $query->row();
        return $this->db->get($this->_table)->row();
    }

	function count_filtered()
    {
        $this->db->select('tblpurchaseorder.nopo,tblpurchaseorder.tanggalpo,tblcust.nama,tblpiccust.namapic,tblmarketing.namamarketing,tblpurchaseorder.potongan,tblpurchaseorder.ppn,tblpurchaseorder.total');
		$this->db->from('tblpurchaseorder');
		$this->db->join('tblcust','tblpurchaseorder.idcust=tblcust.idcust');
		$this->db->join('tblpiccust','tblpurchaseorder.idpiccust=tblpiccust.idpiccust');
		$this->db->join('tblmarketing','tblpurchaseorder.idmarketing=tblmarketing.idmarketing');
		$query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }

    public function save()
    {
		$post = $this->input->post();
		$this->nopo = $post["nopo"];
		$this->tanggalpo = $post["tanggalpo"];
		$this->idcust = $post["idcustomer"];
		$this->idpiccust = $post["idpiccustomer"];
		$this->idmarketing = $post["idmarketing"];
		$this->potongan = $post["potongan"];
		$this->ppn = $post["ppn"];
		$this->total = $post["total"];
        $this->db->insert($this->_table, $this);
    }

	public function savePO($po)
    {
		$this->nopo = $po["nopo"];
		$this->tanggalpo = $po["tanggalpo"];
		$this->idcust = $po["customer"];
		$this->idpiccust = $po["piccustomer"];
		$this->idmarketing = $po["marketing"];
		$this->potongan = $po["potongan"];
		$this->ppn = $po["ppn"];
		$this->total = $po["grandtotal"];
        $this->db->insert($this->_table, $this);
    }

    public function updatePO($po)
    {
		$this->nopo = $po["nopo"];
		$this->tanggalpo = $po["tanggalpo"];
		$this->idcust = $po["customer"];
		$this->idpiccust = $po["piccustomer"];
		$this->idmarketing = $po["marketing"];
		$this->potongan = $po["potongan"];
		$this->ppn = $po["ppn"];
		$this->total = $po["grandtotal"];
		$this->db->update($this->_table, $this, array('nopo' => $po['nopo']));
	}
	

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("nopo" => $id));
	}
	

}
