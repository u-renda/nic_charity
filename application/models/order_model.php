<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model
{
    function count()
    {
        $this->db->select('COUNT(id_order) AS count');
        $this->db->from('order');
        $query = $this->db->get();
        return $query->row()->count;
    }
    
    function create($param)
    {
        $query = $this->db->insert('order', $param);
        return $query;
    }
    
    function info($param)
    {
        $where = array();
        if (isset($param['barang_id']))
        {
            $where += array('barang_id' => $param['barang_id']);
        }
        if (isset($param['order_id']))
        {
            $where += array('order_id' => $param['order_id']);
        }
        if (isset($param['order_temp_id']))
        {
            $where += array('order_temp_id' => $param['order_temp_id']);
        }
        if (isset($param['not_status']))
        {
            $where += array('status != ' => $param['not_status']);
        }
        
        $this->db->select('*');
        $this->db->from('order');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }
    
    function lists($param)
    {
        $where = array();
        if (isset($param['order_id']))
        {
            $where += array('order_id' => $param['order_id']);
        }
        if (isset($param['status']))
        {
            $where += array('status' => $param['status']);
        }
        if (isset($param['not_status']))
        {
            $where += array('status != ' => $param['not_status']);
        }
        if (isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'], $param['offset']);
        }
        
        $this->db->select('*');
        $this->db->from('order');
        $this->db->where($where);
        $this->db->order_by('id_order', 'ASC');
        $query = $this->db->get();
        return $query;
    }
    
    function update($id, $param)
    {
        $this->db->where('order_id', $id);
        $this->db->where('status', 'ordered');
        $query = $this->db->update('order', $param);
        return $query;
    }
    
    function update_temp($id, $param)
    {
        $this->db->where('order_temp_id', $id);
        $query = $this->db->update('order', $param);
        return $query;
    }
}

/* End of file order_model.php */
/* Location: ./application/models/order_model.php */