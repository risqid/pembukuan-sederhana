<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_sp_model extends CI_Model
{
    function showPemasukkan()
    {
        $data = $this->db->like('tanggal', date("Y-m-d"), 'after')->select_sum('masuk')->get_where('kas', ['arah' => 1])->row_array();
        return $data;
    }
    function showPengeluaran()
    {
        $data = $this->db->like('tanggal', date("Y-m-d"), 'after')->select_sum('keluar')->get_where('kas', ['arah' => 0])->row_array();
        return $data;
    }
    function showHutang()
    {
        $data = $this->db->get_where('hutang', ['status' => 0])->result_array();
        return count($data);
    }
    // function showPemasukkan7($from)
    // {
    //     $dates = $this->db->select('tanggal')->distinct('tanggal')->get_where('kas', ['arah' => 1, 'tanggal >' => $from])->result_array();

    //     foreach ($dates as $d) {
    //         $data[$d['tanggal']] = $this->db->select_sum('masuk')->get_where('kas', ['arah' => 1, 'tanggal' => $d['tanggal']])->row_array();
    //     }

    //     if ($data) {
    //         return $data;
    //     }
    //     // $data = $this->db->get_where('pemasukkan', ['tanggal >' => $from])->result_array();
    // }
}
