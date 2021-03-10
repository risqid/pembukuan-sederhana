<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    function show()
    {
        $this->db->order_by('id', 'desc');
        $data = $this->db->get('barang')->result_array();
        return $data;
    }

    function insert($data)
    {
        $this->db->insert('barang', $data);
    }

    function edit($data)
    {
        $this->db->where('id', $data['id'])->update('barang', $data);
    }

    function delete($id)
    {
        $this->db->delete('barang', ['id' => $id]);
    }
}
