<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelunasan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('customer_model','customer');
		$this->load->model('crud_model','crud');
	}

	public function index()
	{
		// dd($this->session->all_userdata());
		$data['title'] = 'Bayar Pelunasan';
		$data['list_customer'] = $this->customer->get_all_select2();
		$page = 'pembayaran/pelunasan/v_pelunasan';

		template($page , $data);
	}

	public function create()
	{
		// dd($_POST);
		$this->db->trans_begin();

		$data_pembayaran = [
			'customerid'	=> $this->input->post('idcustomer'),
			'tipebayar'		=> $this->input->post('tipebayar'),
			'carabayar'		=> $this->input->post('carabayar'),
			'codekhusus'	=> $this->input->post('codekhusus'),
			'keterangan'	=> $this->input->post('keterangan'),
			'nominal' 		=> array_sum($this->input->post('pembayaran')),
			'tglbayar'		=> date('Y-m-d H:i:s')
		];

		$id_pembayaran = $this->crud->create('pembayaran',$data_pembayaran, TRUE);

		$orders = $this->input->post('trorderid');
		$nominals = $this->input->post('pembayaran');
		$data_pembayaran_detail = [];

		foreach($orders as $key => $value) {
			$rows['pembayaranid'] = $id_pembayaran;
			$rows['trorderid'] = $value;
			
			foreach($nominals as $k => $v) {
				if($value == $k) {
					$rows['nominal'] = $v;
				}
			}

			$data_pembayaran_detail[] = $rows;
		}

		$this->crud->create_batch('pembayarandetail',$data_pembayaran_detail);

		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			
			$this->session->set_flashdata(['type'=>'error','message'=>'Pembayaran gagal disimpan.!']);

			return redirect('pelunasan');	
        } else {
        	$this->db->trans_commit();
			$this->session->set_flashdata(['type'=>'success','message'=>'Pembayaran berhasil disimpan.!']);

			return redirect('pembayaran/detail/'.$id_pembayaran);	
        }
	}


	public function order()
	{
		$id = $_POST['idcustomer'];
		// $id = 25;
		$sql = $this->db->query("
			SELECT * 
			FROM inv_list_view 
			WHERE customerid = '".$id."'
				AND sisapembayaran > 0
			ORDER BY trorderid DESC
			LIMIT 100
		")->result_array();
		$no = 1;
		foreach($sql as $row){
			echo '<tr>
			<td>'.$no++.'</td>
			<td>no inv</td>
			<td>'.$row['projectname'].'</td>
			<td>'.$row['tglorder'].'</td>
			<td>'.$row['tipeorder'].'</td>
			<td>'.number_format($row['totalharga'],2).'</td>
			<td>'.number_format($row['sisapembayaran'],2).'</td>
			<td><button type="button" class="btn btn-xs btn-primary" onclick="btnPaymentItem
			(\''.$row['trorderid'].'\', \'no inv\', \''.$row['projectname'].'\', \''.$row['sisapembayaran'].'\')" >Tambahkan</button></td>
			</tr>';
		}
		// echo json_encode($sql);
		// echo '<pre>';
		// print_r($sql);
	}

}

/* End of file Pelunasan.php */
/* Location: ./application/controllers/Pelunasan.php */