<?php
class Customer_model extends CI_Model {

private $primary_key='customer_number';
private $table_name='customers';

function __construct(){
	parent::__construct();
}
function customer_list(){
        $query=$this->db->query("select customer_number,company from customers");
        $ret=array();
        $ret['']='- Select Customer -';
        foreach ($query->result() as $row)
        {
                $ret[$row->customer_number]=$row->company;
        }		 
        return $ret;
}
function select_list(){return $this->customer_list();}

	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc')
	{
                $nama='';
                if(isset($_GET['nama'])){
                    $nama=$_GET['nama'];
                }
                if($nama!='')$this->db->where("company like '%$nama%'");

		if (empty($order_column)||empty($order_type))
		$this->db->order_by($this->primary_key,'asc');
		else
		$this->db->order_by($order_column,$order_type);
		return $this->db->get($this->table_name,$limit,$offset);
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function info($id){
		$data=$this->get_by_id($id)->row();
		if(count($data)){    
			$ret='<strong>'.$id.' - '.$data->company.'</strong><br/>'
					.$data->street.' - '.$data->city;
		} else $ret='';
		return $ret;
	}
	function customer_type($id){
		return $this->db->select("customer_record_type")
			->where("customer_number",$id)->get("customers")
			->row()->customer_record_type;
	}
	function save($data){           
		$type=explode(" - ",$data['customer_record_type']);
		if(count($type)>1)$data['customer_record_type']=$type[0];

		return $this->db->insert($this->table_name,$data);            
		//return $this->db->insert_id();
	}
	function update($id,$data){
		$type=explode(" - ",$data['customer_record_type']);
		if(count($type)>1)$data['customer_record_type']=$type[0];
		$this->db->where($this->primary_key,$id);
		return  $this->db->update($this->table_name,$data);
	}
	function exist_customer_transaction($id){
		$ret="";
		if($cnt=$this->db->select("count(1) as cnt")->where("sold_to_customer",$id)
			->get("sales_order")->row()->cnt){
			$ret="Masih ada transaksi sales order !";
			return $ret;
		}
		
		if($cnt=$this->db->select("count(1) as cnt")->where("sold_to_customer",$id)
			->get("invoice")->row()->cnt){
			$ret="Masih ada transaksi faktur atau surat jalan !";
			return $ret;
		}
	}
	function delete($id){
		$id=urldecode($id);
		$ret=$this->exist_customer_transaction($id);
		if($ret==""){
			$this->db->where($this->primary_key,$id);
			$this->db->delete($this->table_name);
		} 
		return $ret;
	}
	function saldo_piutang_summary()
	{
		$sql="select c.company,sum(f.amount) as sum_amount 
		from invoice f
		left join customers c on c.customer_number=f.sold_to_customer
		where invoice_type='I' 
		group by c.company
		order by sum(f.amount) desc
		limit 0,10";
		$query=$this->db->query($sql);
		foreach($query->result() as $row){
			$supp=$row->company;
			if($supp=="")$supp="Unknown";
			 
			$amount=$row->sum_amount;
			if($amount==null)$amount=0;
			if($amount>0)$amount=round($amount/1000);
			$data[]=array(substr($supp,0,10),$amount);
		}
		return $data;
	}
	function shipto_add($data){           
		return $this->db->insert("customer_shipto",$data);            
	}
	
	function shipto_del($id){           
		$this->db->where("id",$id);
		return $this->db->delete("customer_shipto");
	}
	function list_travel(){
		$ret['']='- Select -';
		if($query=$this->db->query("select customer_number,company
			from customers order by company")) {
			foreach ($query->result() as $row){
				$ret[$row->customer_number]=$row->company;
			}		 
		}
		return $ret;
	}
	function exist($id){
	   return $this->db->count_all($this->table_name." where customer_number='".$id."'")>0;
	}
		
}
