<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Next_model extends CI_Model
{
    function getNextId($table)
    {
        $lastId = $this->db->limit(1)->order_by('id', 'DESC')->select('id')->get($table)->row_array();
        if ($lastId) {
            $nextId = $lastId['id'] + 1;
        } else {
            $nextId = 1;
        }
        return $nextId;
    }

    function getNextNota($tanggal, $jenis)
    {
        if ($jenis == "pemasukkan") {
            $lastNota = $this->db->limit(1)->order_by('id', 'desc')->like('tanggal', $tanggal, 'after')->get_where('kas', ['arah' => 1])->row_array();
        } elseif ($jenis == "pengeluaran") {
            $lastNota = $this->db->limit(1)->order_by('id', 'desc')->like('tanggal', $tanggal, 'after')->get_where('kas', ['arah' => 0])->row_array();
        }
        if ($lastNota) {
            $nextNota = $lastNota['no'] + 1;
        } else {
            $nextNota = 1;
        }
        return $nextNota;
    }
}
