<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
    {
        parent::__construct();
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
				$param1 = array();
				$param1['user_id'] = md5($this->input->post('username'));
				$param1['username'] = strtolower($this->input->post('username'));
				$param1['status'] = 'active';
				$query = $this->user_model->create($param1);
				
				if ($query)
				{
					$response =  array('msg' => 'Create user success', 'type' => 'success', 'location' => 'barang_create');
				}
				else
				{
					$response =  array('msg' => 'Create user failed', 'type' => 'error');
				}
				
				echo json_encode($response);
				exit();
			}
		}
		
        $data['dynamiccontent'] = 'user/user_create';
		$this->load->view('templates/frame', $data);
	}
	
	function delete()
	{
		$data = array();
		$data['id'] = $this->input->post('id');
		$data['action'] = $this->input->post('action');
		
		$get_user = $this->user_model->info(array('user_id' => $data['id']));
		
		if ($get_user->num_rows() > 0)
		{
			if ($this->input->post('delete'))
			{
				$param = array();
				$param['status'] = 'deleted';
				$query = $this->user_model->update($data['id'], $param);
				
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
	
	function get()
	{
		$page = $this->input->post('page') ? $this->input->post('page') : 1;
		$pageSize = $this->input->post('pageSize') ? $this->input->post('pageSize') : 20;
		$offset = ($page - 1) * $pageSize;
		$i = $offset * 1 + 1;
		$q = '';
		$order = 'username';
		$sort = 'asc';
		
		if ($this->input->post('sort'))
		{
			$order = $_POST['sort'][0]['field'];
			$sort = $_POST['sort'][0]['dir'];
		}
		
		if ($this->input->post('filter'))
		{
			$q = $_POST['filter']['filters'][0]['value'];
		}
		
		$get = $this->user_model->lists(array('not_status' => 'deleted', 'q' => $q, 'order' => $order, 'sort' => $sort, 'limit' => $pageSize, 'offset' => $offset));
		$jsonData = array('total' => $get->num_rows(), 'results' => array());
		
		if ($get->num_rows() > 0)
		{
			foreach ($get->result() as $row)
			{
				$action = '<a title="Delete" id="'.$row->user_id.'" class="delete '.$row->user_id.'-delete" href="#"><i class="fa fa-times fg-color-red fg-font19"></i></a>';
				
				$entry = array(
					'no' => $i,
					'username' => ucwords($row->username),
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
		$data['dynamiccontent'] = 'user/user_lists';
		$this->load->view('templates/frame', $data);
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */