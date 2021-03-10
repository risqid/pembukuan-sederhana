<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kas_model extends CI_Model
{
    function getLatest()
    {
        $data = $this->db->limit(1)->order_by('id', 'DESC')->get('kas')->row_array();
        if ($data) {
            return $data['saldo'];
        }
        return 0;
    }

    function getSpesific($id)
    {
        $data = $this->db->get_where('kas', ['id' => $id])->row_array();
        return $data['saldo'];
    }

    function tampilkan()
    {
        $this->db->order_by('id', 'desc');
        $data = $this->db->get('kas')->result_array();
        return $data;
    }

    function delete($id, $option)
    {
        $laterSaldo = $this->db->get_where('kas', ['id >' => $id])->result_array();
        if ($option == 'pemasukkan') {
            $pemasukkan = $this->db->get_where('kas', ['id' => $id])->row_array();
            foreach ($laterSaldo as $ls) {
                $ls['saldo'] -= $pemasukkan['masuk'];
                $this->db->where('id', $ls['id'])->update('kas', $ls);
            }
        } elseif ($option == 'pengeluaran') {
            $pengeluaran = $this->db->get_where('kas', ['id' => $id])->row_array();
            foreach ($laterSaldo as $ls) {
                $ls['saldo'] += $pengeluaran['keluar'];
                $this->db->where('id', $ls['id'])->update('kas', $ls);
            }
        }
    }
}
