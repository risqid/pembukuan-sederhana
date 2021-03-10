<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemasukkan_model extends CI_Model
{
    function show()
    {
        $data = $this->db->order_by('id', 'desc')->get_where('kas', ['arah' => 1])->result_array();
        return $data;
    }

    function insert($data)
    {
        $this->db->insert('kas', $data);
    }

    function edit($saldo, $data)
    {
        $oldData = $this->db->get_where('kas', ['id' => $data['id']])->row_array();
        $laterSaldo = $this->db->get_where('kas', ['id >' => $data['id']])->result_array();

        if ($data['masuk'] > $oldData['masuk']) {
            $selisih = $data['masuk'] - $oldData['masuk'];
            $saldo += $selisih;
            $data['saldo'] = $saldo;
            $this->db->where('id', $data['id'])->update('kas', $data);

            foreach ($laterSaldo as $ls) {
                $ls['saldo'] += $selisih;
                $this->db->where('id', $ls['id'])->update('kas', $ls);
            }
        } elseif ($oldData['masuk'] > $data['masuk']) {
            $selisih = $oldData['masuk'] - $data['masuk'];
            $saldo -= $selisih;
            $data['saldo'] = $saldo;
            $this->db->where('id', $data['id'])->update('kas', $data);

            foreach ($laterSaldo as $ls) {
                $ls['saldo'] -= $selisih;
                $this->db->where('id', $ls['id'])->update('kas', $ls);
            }
        } else {
            $this->db->where('id', $data['id'])->update('kas', $data);
        }
    }

    function delete($id)
    {
        $this->db->delete('kas', ['id' => $id]); //hapus data
    }
}
