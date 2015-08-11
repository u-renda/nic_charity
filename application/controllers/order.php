<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('barang_model');
        $this->load->model('order_model');
    }
    
	function checkout()
	{
		$order_id = $this->input->get('id');
		
		$get = $this->order_model->lists(array('order_id' => $order_id, 'status' => 'ordered'));
		
		if ($get->num_rows() > 0)
		{
			foreach ($get->result() as $row)
			{
				$param = array();
				$param['status'] = 'sold';
				$query = $this->barang_model->update($row->barang_id, $param);
			}
			
			$param2 = array();
			$param2['status'] = 'paid';
			$query2 = $this->order_model->update($order_id, $param2);
			
			if ($query2)
			{
				$data['dynamiccontent'] = 'order/order_checkout';
				$this->load->view('templates/frame', $data);
			}
		}
	}
	
	function create()
	{
		$order_id = $this->input->get_post('id');
		
		if ($this->input->post('submit'))
		{
			$comment = '';
			$count = $this->order_model->count() + 1;
			$order_count = 'NIC_' . $count;
			
			for ($i=1;$i<=10;$i++)
			{
				$barang_id = $this->input->post('barang_id_'.$i);
				
				if ($barang_id != '')
				{
					$get = $this->barang_model->info(array('barang_id' => $barang_id, 'status' => 'stock'));
				
					if ($get->num_rows() > 0)
					{
						$param2 = array();
						if ($order_id)
						{
							$get_order_id = $this->order_model->info(array('order_id' => $order_id));
							$param2['order_id'] = $get_order_id->row()->order_id;
						}
						else
						{
							$param2['order_id'] = $order_count;
						}
						
						$param2['order_temp_id'] = md5($get->row()->barang_id . $param2['order_id'] . $i);
						$param2['barang_id'] = $get->row()->barang_id;
						$param2['status'] = 'ordered';
						
						$get_order = $this->order_model->info(array('order_id' => $param2['order_id'], 'barang_id' => $param2['barang_id'], 'not_status' => 'deleted'));
						
						if ($get_order->num_rows() == 0)
						{
							$query = $this->order_model->create($param2);
							$comment = 1;
						}
					}
				}
			}
			
			if ($comment == 1)
			{
				$response =  array('msg' => 'Create order success', 'type' => 'success', 'location' => 'order_lists?id='.$param2['order_id']);
			}
			else
			{
				$response =  array('msg' => 'Kode barang salah/barang kosong', 'type' => 'error');
			}
			
			echo json_encode($response);
			exit();
		}
		
		$data['id'] = $order_id;
		$data['dynamiccontent'] = 'order/order_create';
		$this->load->view('templates/frame', $data);
    }
	
	function delete()
	{
		$id = $this->input->get('temp_id');
		
		$get = $this->order_model->info(array('order_temp_id' => $id));
		
		if ($get->num_rows() > 0)
		{
			$param = array();
			$param['status'] = 'deleted';
			$query = $this->order_model->update_temp($id, $param);
			
			if ($query)
			{
				redirect('order_lists?id='.$get->row()->order_id);
			}
		}
		else
		{
			echo "Data Not Found";
		}
	}
	
	function get()
	{
		$order_id = $this->input->post('order_id');
		$page = $this->input->post('page') ? $this->input->post('page') : 1;
		$pageSize = $this->input->post('pageSize') ? $this->input->post('pageSize') : 20;
		$offset = ($page - 1) * $pageSize;
		$i = $offset * 1 + 1;
		
		$get = $this->order_model->lists(array('not_status' => 'deleted', 'order_id' => $order_id, 'limit' => $pageSize, 'offset' => $offset));
		$jsonData = array('total' => $get->num_rows(), 'results' => array());
		
		if ($get->num_rows() > 0)
		{
			foreach ($get->result() as $row)
			{
				$get_barang = $this->barang_model->info(array('barang_id' => $row->barang_id))->row();
				
				$action = '<a title="Delete" href="order_delete?temp_id='.$row->order_temp_id.'"><i class="fa fa-times fg-color-red fg-font19"></i></a>';
				
				$entry = array(
					'no' => $i,
					'barang_id' => $row->barang_id,
					'harga' => number_format($get_barang->harga),
					'action' => $action
				);
				
				$jsonData['results'][] = $entry;
				$i++;
			}
			
			echo json_encode($jsonData);
		}
		else
		{
			echo json_encode(array('results' => array()));
		}
	}
	
	function lists()
	{
		$data['order_id'] = $this->input->get_post('id');
		
		$get = $this->order_model->lists(array('not_status' => 'deleted', 'order_id' => $data['order_id']));
		
		if ($get->num_rows() > 0)
		{
			$total = 0;
			foreach ($get->result() as $row)
			{
				$get_barang = $this->barang_model->info(array('barang_id' => $row->barang_id));
				
				if ($get_barang->num_rows() > 0)
				{
					$harga = $get_barang->row()->harga;
					$total = $total + $harga;
				}
			}
		}
		else
		{
			redirect('order_create');
		}
		
		$data['total'] = number_format($total);
		$data['dynamiccontent'] = 'order/order_lists';
		$this->load->view('templates/frame', $data);
	}
}

/* End of file penjualan.php */
/* Location: ./application/controllers/penjualan.php */