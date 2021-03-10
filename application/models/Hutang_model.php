<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hutang_model extends CI_Model
{
    function tampilkanSemua()
    {
        $this->db->order_by('id', 'desc');
        $data = $this->db->get('hutang')->result_array();
        return $data;
    }

    function tampilkanLunas()
    {
        $this->db->order_by('id', 'desc');
        $data = $this->db->get_where('hutang', ['status' => 1])->result_array();
        return $data;
    }
    function tampilkanBelumLunas()
    {
        $this->db->order_by('id', 'desc');
        $data = $this->db->get_where('hutang', ['status' => 0])->result_array();
        return $data;
    }

    function insert($data)
    {
        $this->db->insert('hutang', $data);
    }

    function edit($data)
    {
        $this->db->where('id', $data['id'])->update('hutang', $data);
    }

    function delete($id)
    {

        $this->db->delete('hutang', ['id' => $id]);
    }
}
