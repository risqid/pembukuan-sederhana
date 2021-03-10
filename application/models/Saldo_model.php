<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Saldo_model extends CI_Model
{
    function getLatest()
    {
        $data = $this->db->limit(1)->order_by('id', 'DESC')->get('saldo')->row_array();
        if ($data) {
            return $data['saldo'];
        }
        return 0;
    }

    function getSpesific($idSaldo)
    {
        $data = $this->db->get_where('saldo', ['id' => $idSaldo])->row_array();
        return $data;
    }

    function delete($id, $option)
    {
        $laterSaldo = $this->db->get_where('saldo', ['id >' => $id])->result_array();
        if ($option == 'pemasukkan') {
            $pemasukkan = $this->db->get_where($option, ['id_saldo' => $id])->row_array();
            foreach ($laterSaldo as $ls) {
                $ls['saldo'] -= $pemasukkan['masuk'];
                $this->db->where('id', $ls['id'])->update('saldo', $ls);
            }
        } else {
            $pengeluaran = $this->db->get_where($option, ['id_saldo' => $id])->row_array();
            foreach ($laterSaldo as $ls) {
                $ls['saldo'] += $pengeluaran['masuk'];
                $this->db->where('id', $ls['id'])->update('saldo', $ls);
            }
        }
        $this->db->delete('saldo', ['id' => $id]);
    }
}
