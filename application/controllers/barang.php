<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('barang_model');
        $this->load->model('user_model');
    }
	
	function create()
	{
        $data = array();
        
        if ($this->input->post('submit'))
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_message('required', '%s harus diisi');
			$this->form_validation->set_rules('username', 'Nama penyumbang', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$data['error'] = validation_errors();
			}
			else
			{
                $user_id = $this->input->post('username');
                $harga = $this->input->post('harga');
				$user_info = $this->user_model->info(array('user_id' => $user_id))->row();
				$barang_id = $this->file_name($user_info, $harga);
				
				$param1 = array();
				$param1['barang_id'] = $barang_id;
				$param1['user_id'] = $user_id;
                $param1['harga'] = $this->input->post('harga');
                $param1['status'] = 'stock';
				$query = $this->barang_model->create($param1);
				
				if ($query)
				{
					$response =  array('msg' => 'Create user success', 'type' => 'success', 'location' => 'barang_lists');
				}
				else
				{
					$response =  array('msg' => 'Create user failed', 'type' => 'error');
				}
				
				echo json_encode($response);
				exit();
			}
		}
        
		$get_user = $this->user_model->lists(array());
		
        $data['user_lists'] = $get_user->result();
        $data['dynamiccontent'] = 'barang/barang_create';
		$this->load->view('templates/frame', $data);
	}
	
	function create_many()
	{
		$data = array();
        
        if ($this->input->post('submit'))
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_message('required', '%s harus diisi');
			$this->form_validation->set_rules('username', 'Nama penyumbang', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$data['error'] = validation_errors();
			}
			else
			{
                $user_id = $this->input->post('username');
                $harga = $this->input->post('harga');
				$user_info = $this->user_model->info(array('user_id' => $user_id))->row();
				$quantity = $this->input->post('qty');
				
				for ($i=1;$i<=$quantity;$i++)
				{
					$barang_id = $this->file_name($user_info, $harga);
					
					$param1 = array();
					$param1['barang_id'] = $barang_id;
					$param1['user_id'] = $user_id;
					$param1['harga'] = $this->input->post('harga');
					$param1['status'] = 'stock';
					$query = $this->barang_model->create($param1);
				}
				
				if ($query)
				{
					$response =  array('msg' => 'Create user success', 'type' => 'success', 'location' => 'barang_lists');
				}
				else
				{
					$response =  array('msg' => 'Create user failed', 'type' => 'error');
				}
				
				echo json_encode($response);
				exit();
			}
		}
        
		$get_user = $this->user_model->lists(array());
		
        $data['user_lists'] = $get_user->result();
        $data['dynamiccontent'] = 'barang/barang_create_many';
		$this->load->view('templates/frame', $data);
	}
	
	function delete()
	{
		$data = array();
		$data['id'] = $this->input->post('id');
		$data['action'] = $this->input->post('action');
		
		$get = $this->barang_model->info(array('barang_id' => $data['id']));
		
		if ($get->num_rows() > 0)
		{
			if ($this->input->post('delete'))
			{
				$param = array();
				$param['status'] = 'deleted';
				$query = $this->barang_model->update($data['id'], $param);
				
				if ($query)
				{
					$response =  array('msg' => 'Delete data success', 'type' => 'success');
				}
				else
				{
					$response =  array('msg' => 'Delete data failed', 'type' => 'error');
				}
				
				echo json_encode($response);
				exit();
			}
			else
			{
				$this->load->view('delete_confirm', $data);
			}
		}
		else
		{
			echo "Data Not Found";
		}
	}
	
	function edit()
	{
		$data = array();
		$data['id'] = $this->input->get_post('id');
		
		$get_barang = $this->barang_model->info(array('barang_id' => $data['id']));
		
		if ($get_barang->num_rows() > 0)
		{
			if ($this->input->post('submit'))
			{
				$param1 = array();
				$param1['status'] = $this->input->post('status');
				$param1['harga'] = $this->input->post('harga');
				
				$user_info = $this->user_model->info(array('user_id' => $get_barang->row()->user_id))->row();
				$barang_id = $this->file_name($user_info, $param1['harga']);
				
				if ($param1['harga'] != $get_barang->row()->harga)
				{
					$param1['barang_id'] = $barang_id;
				}
				
				$query = $this->barang_model->update($data['id'], $param1);
				
				if ($query)
				{
					redirect('barang_lists');
				}
				else
				{
					$response =  array('msg' => 'Update data failed', 'type' => 'error');
				}
				
				echo json_encode($response);
				exit();
			}
			else
			{
				$data['barang'] = $get_barang->row();
				$data['code_barang_status'] = $this->config->item('code_barang_status');
				$data['dynamiccontent'] = 'barang/barang_edit';
				$this->load->view('templates/frame', $data);
			}
		}
		else
		{
			echo "Data Not Found";
		}
	}
    
	function file_name($user_info, $harga)
	{
		$id_user = $user_info->id_user;
		$user_initial = str_pad($id_user, 2, 0, STR_PAD_LEFT);
		$count = $this->barang_model->count() + 1;
		$barang_count = str_pad($count, 4, 0, STR_PAD_LEFT);
		
		if (strlen($harga) == 6)
		{
			$harga_initial = substr($harga, 0, 3);
		}
		else
		{
			$harga_temp = substr($harga, 0, 2);
			$harga_initial = str_pad($harga_temp, 3, 0, STR_PAD_LEFT);
		}
		
		$barang_id = $user_initial . $harga_initial . $barang_count;
		return $barang_id;
	}
	
	function get()
	{
		$user_id_post = $this->input->post('user_id') ? $this->input->post('user_id') : '';
		$status_post = $this->input->post('status') ? $this->input->post('status') : '';
		$page = $this->input->post('page') ? $this->input->post('page') : 1;
		$pageSize = $this->input->post('pageSize') ? $this->input->post('pageSize') : 20;
		$offset = ($page - 1) * $pageSize;
		$i = $offset * 1 + 1;
		$order = 'barang_id';
		$sort = 'asc';
		$q = '';
		
		if ($this->input->post('sort'))
		{
			$order = $_POST['sort'][0]['field'];
			$sort = $_POST['sort'][0]['dir'];
		}
		
		if ($this->input->post('filter'))
		{
			$q = $_POST['filter']['filters'][0]['value'];
		}
		
		if ($user_id_post == '')
		{
			$user_id = '';
		}
		else
		{
			$user_id = 'user_id';
		}
		
		if ($status_post == '')
		{
			$status = '';
		}
		else
		{
			$status = 'status';
		}
		
		$get = $this->barang_model->lists(array('not_status' => 'deleted', 'q' => $q, $user_id => $user_id_post, $status => $status_post, 'order' => $order, 'sort' => $sort, 'limit' => $pageSize, 'offset' => $offset));
		$total = $this->barang_model->count(array('not_status' => 'deleted', 'q' => $q, $user_id => $user_id_post, $status => $status_post));
		$jsonData = array('total' => $total, 'results' => array());
		
		if ($get->num_rows() > 0)
		{
			foreach ($get->result() as $row)
			{
				$get_user = $this->user_model->info(array('user_id' => $row->user_id));
				
				if ($get_user->row()->status != 'deleted')
				{
					$action = '<a title="Edit" href="barang_edit?id='.$row->barang_id.'"><i class="fa fa-pencil fg-ripe-lemon fg-font19"></i></a>&nbsp;
							<a title="Delete" id="'.$row->barang_id.'" class="delete '.$row->barang_id.'-delete" href="#"><i class="fa fa-times fg-color-red fg-font19"></i></a>';
				
					if ($row->status == 'stock')
					{
						$status_color = '<span class="label bg-green-jungle">' . ucwords($row->status) . '</span>';
					}
					else
					{
						$status_color = '<span class="label bg-red-thunderbird">' . ucwords($row->status) . '</span>';
					}
					
					$entry = array(
						'no' => $i,
						'barang_id' => $row->barang_id,
						'username' => ucwords($get_user->row()->username),
						'harga' => number_format($row->harga),
						'status' => $status_color,
						'action' => $action
					);
					
					$jsonData['results'][] = $entry;
					$i++;
				}
			}
			
			echo json_encode($jsonData);
		}
		else
		{
			echo "Data Not Found";
		}
	}
	
	function lists()
	{
		$get_user = $this->user_model->lists(array());
		
		$data['code_barang_status'] = $this->config->item('code_barang_status');
		$data['user_lists'] = $get_user->result();
		$data['dynamiccontent'] = 'barang/barang_lists';
		$this->load->view('templates/frame', $data);
	}
}

/* End of file barang.php */
/* Location: ./application/controllers/barang.php */