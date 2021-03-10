<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_logged_in_sp();
        $this->load->model('pengeluaran_model');
        $this->load->model('kas_model');
        $this->load->model('next_model');
        date_default_timezone_set("Asia/Jakarta");
    }
    public function index()
    {
        $data = [
            'title' => "Pengeluaran",
            'pengeluaran' => $this->pengeluaran_model->show(),
            'tanggal' => date("Y-m-d"),
            'kategori' => $this->db->get_where('kategori', ['arah' => 0])->result_array(),
            'barang' => $this->db->get('barang')->result_array()
        ];

        if (isset($_POST['submit'])) {
            $nextId = $this->next_model->getNextId('kas');

            $id = htmlspecialchars($this->input->post('id'));
            $tanggal = htmlspecialchars($this->input->post('tanggal'));
            if (!$tanggal) {
                $datestring = '%Y-%m-%d %h:%i:%s';
                $time = time();
                $tanggal = mdate($datestring, $time);
            }
            $no = htmlspecialchars($this->input->post('no'));
            if (!$no) {
                $no = $this->next_model->getNextNota($tanggal, "pengeluaran");
            };
            $kategori = htmlspecialchars($this->input->post('kategori'));
            $catatan = htmlspecialchars($this->input->post('catatan'));
            $keluar = htmlspecialchars($this->input->post('keluar'));

            if (empty($id)) {
                $saldo = $this->kas_model->getLatest();
                $data = [
                    'id' => $nextId,
                    'tanggal' => $tanggal,
                    'arah' => 0,
                    'no' => $no,
                    'kategori' => $kategori,
                    'catatan' => $catatan,
                    'keluar' => $keluar,
                    'saldo' => $saldo - $keluar
                ];
                $this->pengeluaran_model->insert($data);
                $this->session->set_flashdata('message', '<script>$.notify({icon: "done_outline",title: "Data berhasil ditambahkan",message: "",},{type: "success",placement: {from: "top",align: "right"},time: 1000,});</script>');
                redirect('pengeluaran');
            } else {
                $saldo = $this->kas_model->getSpesific($id); //return array
                $data = [
                    'id' => $id,
                    'tanggal' => $tanggal,
                    'no' => $no,
                    'kategori' => $kategori,
                    'catatan' => $catatan,
                    'keluar' => $keluar,
                ];
                $this->pengeluaran_model->edit($saldo, $data);
                $this->session->set_flashdata('message', '<script>$.notify({icon: "done_outline",title: "Data berhasil diubah",message: "",},{type: "success",placement: {from: "top",align: "right"},time: 1000,});</script>');
                redirect('pengeluaran');
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar');
        $this->load->view('pengeluaran/index', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        $this->kas_model->delete($id, 'pengeluaran');
        $this->pengeluaran_model->delete($id);
        $this->session->set_flashdata('message', '<script>$.notify({icon: "done_outline",title: "Data berhasil dihapus",message: "",},{type: "success",placement: {from: "top",align: "right"},time: 1000,});</script>');
        redirect('pengeluaran');
    }
}
