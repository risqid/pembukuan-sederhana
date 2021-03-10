<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

    function show($from, $to)
    {
        $data = $this->db->where(['tanggal >=' => $from, 'tanggal <=' => $to, 'kategori !=' => 'Modal'])->get('kas')->result_array();
        return $data;
    }

    function hitung($from, $to)
    {
        $pemasukkan = $this->db->select_sum('masuk')->where(['tanggal >=' => $from, 'tanggal <=' => $to, 'kategori !=' => 'Modal'])->get('kas')->row_array();
        $pengeluaran = $this->db->select_sum('keluar')->where(['tanggal >=' => $from, 'tanggal <=' => $to])->get('kas')->row_array();
        $laba = $pemasukkan['masuk'] - $pengeluaran['keluar'];
        $data = [
            'pemasukkan' => $pemasukkan['masuk'],
            'pengeluaran' => $pengeluaran['keluar'],
            'laba' => $laba
        ];

        return $data;
    }
}
