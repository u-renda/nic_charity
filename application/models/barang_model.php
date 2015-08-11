<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    function count()
    {
        $where = array();
        if ( ! empty($param['user_id']))
        {
            $where += array('user_id' => $param['user_id']);
        }
        if ( ! empty($param['status']))
        {
            $where += array('status' => $param['status']);
        }
        if ( ! empty($param['q']))
        {
            $where += array('barang_id LIKE ' => '%'.$param['q'].'%');
        }
        if ( ! empty($param['not_status']))
        {
            $where += array('status != ' => $param['not_status']);
        }
        
        $this->db->select('COUNT(id_barang) AS count');
        $this->db->from('barang');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row()->count;
    }
    
    function create($param)
    {
        $query = $this->db->insert('barang', $param);
        return $query;
    }
    
    function info($param)
    {
        $where = array();
        if (isset($param['barang_id']))
        {
            $where += array('barang_id' => $param['barang_id']);
        }
        if (isset($param['status']))
        {
            $where += array('status' => $param['status']);
        }
        
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }
    
    function lists($param)
    {
        $where = array();
        if (isset($param['user_id']))
        {
            $where += array('user_id' => $param['user_id']);
        }
        if (isset($param['status']))
        {
            $where += array('status' => $param['status']);
        }
        if (isset($param['q']))
        {
            $where += array('barang_id LIKE ' => '%'.$param['q'].'%');
        }
        if (isset($param['not_status']))
        {
            $where += array('status != ' => $param['not_status']);
        }
        
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where($where);
        $this->db->order_by($param['order'], $param['sort']);
        $this->db->limit($param['limit'], $param['offset']);
        $query = $this->db->get();
        return $query;
    }
    
    function update($id, $param)
    {
        $this->db->where('barang_id', $id);
        $query = $this->db->update('barang', $param);
        return $query;
    }
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */