<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    function create($param)
    {
        $query = $this->db->insert('user', $param);
        return $query;
    }
    
    function info($param)
    {
        $where = array();
        if (isset($param['user_id']))
        {
            $where += array('user_id' => $param['user_id']);
        }
        
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }
    
    function lists($param)
    {
        $where = array();
        if (isset($param['q']))
        {
            $where += array('username LIKE ' => '%'.$param['q'].'%');
        }
        if (isset($param['not_status']))
        {
            $where += array('status != ' => $param['not_status']);
        }
        if (isset($param['order']) && isset($param['sort']))
        {
            $this->db->order_by($param['order'], $param['sort']);
        }
        if (isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'], $param['offset']);
        }
        
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }
    
    function update($id, $param)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->update('user', $param);
        return $query;
    }
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */