<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
    
	function index()
	{
		$get_user = $this->user_model->lists(array());
		
		$data['user_lists'] = $get_user->result();
		$data['dynamiccontent'] = 'welcome';
		$this->load->view('templates/frame', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */