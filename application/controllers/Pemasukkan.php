<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemasukkan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_logged_in_sp();
        $this->load->model('pemasukkan_model');
        $this->load->model('kas_model');
        $this->load->model('next_model');
        date_default_timezone_set("Asia/Jakarta");
    }
    public function index()
    {
        $data = [
            'title' => "Pemasukkan",
            'pemasukkan' => $this->pemasukkan_model->show(),
            'tanggal' => date("Y-m-d"),
            'kategori' => $this->db->get_where('kategori', ['arah' => 1])->result_array()
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
                $no = $this->next_model->getNextNota($tanggal, "pemasukkan");
            };
            $kategori = htmlspecialchars($this->input->post('kategori'));
            $catatan = htmlspecialchars($this->input->post('catatan'));
            $masuk = htmlspecialchars($this->input->post('masuk'));

            if (empty($id)) {
                $saldo = $this->kas_model->getLatest();
                $data = [
                    'id' => $nextId,
                    'tanggal' => $tanggal,
                    'arah' => 1,
                    'no' => $no,
                    'kategori' => $kategori,
                    'catatan' => $catatan,
                    'masuk' => $masuk,
                    'saldo' => $saldo + $masuk
                ];
                $this->pemasukkan_model->insert($data);
                $this->session->set_flashdata('message', '<script>$.notify({icon: "done_outline",title: "Data berhasil ditambahkan",message: "",},{type: "success",placement: {from: "top",align: "right"},time: 1000,});</script>');
                redirect('pemasukkan');
            } else {
                $saldo = $this->kas_model->getSpesific($id); //return array
                $data = [
                    'id' => $id,
                    'tanggal' => $tanggal,
                    'no' => $no,
                    'kategori' => $kategori,
                    'catatan' => $catatan,
                    'masuk' => $masuk,
                ];
                $this->pemasukkan_model->edit($saldo, $data);
                $this->session->set_flashdata('message', '<script>$.notify({icon: "done_outline",title: "Data berhasil diubah",message: "",},{type: "success",placement: {from: "top",align: "right"},time: 1000,});</script>');
                redirect('pemasukkan');
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar');
        $this->load->view('pemasukkan/index', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        $this->kas_model->delete($id, 'pemasukkan');
        $this->pemasukkan_model->delete($id);
        $this->session->set_flashdata('message', '<script>$.notify({icon: "done_outline",title: "Data berhasil dihapus",message: "",},{type: "success",placement: {from: "top",align: "right"},time: 1000,});</script>');
        redirect('pemasukkan');
    }
}
