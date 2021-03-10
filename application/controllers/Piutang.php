<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Piutang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_logged_in_sp();
        $this->load->model('hutang_model');
        $this->load->model('pemasukkan_model');
        $this->load->model('next_model');
        $this->load->model('kas_model');
        date_default_timezone_set("Asia/Jakarta");
    }
    public function index()
    {

        $data = [
            'title' => "Piutang",
            'semua' => $this->hutang_model->tampilkanSemua(),
            'lunas' => $this->hutang_model->tampilkanLunas(),
            'belumLunas' => $this->hutang_model->tampilkanBelumLunas(),
            'tanggal' => date("Y-m-d"),
            'batasPelunasan' => date_format(date_add(date_create(date("Y-m-d")), date_interval_create_from_date_string("30 days")), "Y-m-d")
        ];

        if (isset($_POST['submit'])) {
            $nextId = $this->next_model->getNextId('hutang');

            $id = htmlspecialchars($this->input->post('id'));
            $tanggal = htmlspecialchars($this->input->post('tanggal'));
            if (!$tanggal) {
                $tanggal = date("Y-m-d");
            }
            $nama = htmlspecialchars($this->input->post('nama'));
            $nominal = htmlspecialchars($this->input->post('nominal'));


            $batas_pelunasan = htmlspecialchars($this->input->post('batas_pelunasan'));
            if (!$batas_pelunasan) {
                $today = date("Y-m-d");
                $from = date_add(date_create($today), date_interval_create_from_date_string("30 days"));
                $batas_pelunasan = date_format($from, "Y-m-d");
            }

            if (empty($id)) {
                $data = [
                    'id' => $nextId,
                    'tanggal' => $tanggal,
                    'nama' => $nama,
                    'nominal' => $nominal,
                    'batas_pelunasan' => $batas_pelunasan
                ];
                $this->hutang_model->insert($data);
                $this->session->set_flashdata('message', '<script>$.notify({icon: "done_outline",title: "Data berhasil ditambahkan",message: "",},{type: "success",placement: {from: "top",align: "right"},time: 1000,});</script>');
                redirect('piutang');
            } else {
                $data = [
                    'id' => $id,
                    'tanggal' => $tanggal,
                    'nama' => $nama,
                    'nominal' => $nominal,
                    'batas_pelunasan' => $batas_pelunasan
                ];
                $this->hutang_model->edit($data);
                $this->session->set_flashdata('message', '<script>$.notify({icon: "done_outline",title: "Data berhasil diubah",message: "",},{type: "success",placement: {from: "top",align: "right"},time: 1000,});</script>');
                redirect('piutang');
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar');
        $this->load->view('piutang/index', $data);
        $this->load->view('templates/footer');
    }

    public function changestatus()
    {
        $id = $this->input->post('id');
        $hutang = $this->db->get_where('hutang', ['id' => $id])->row_array();

        if ($hutang['status'] == 0) {
            $this->db->where('id', $id)->set('status', 1)->update('hutang');

            $saldo = $this->kas_model->getLatest();
            $nextKasId = $this->next_model->getNextId('kas');
            $no = $this->next_model->getNextNota(date("Y-m-d"), "pemasukkan");
            $data = [
                'id' => $nextKasId,
                'tanggal' => date("Y-m-d"),
                'arah' => 1,
                'no' => $no,
                'kategori' => "Pembayaran utang",
                'masuk' => $hutang['nominal'],
                'saldo' => $saldo + $hutang['nominal']
            ];
            $this->pemasukkan_model->insert($data);
            $this->db->delete('hutang', ['id' => $id]);
        } else {
            $this->db->where('id', $id)->set('status', 0)->update('hutang');
        }

        $this->session->set_flashdata('message', '<script>$.notify({icon: "done_outline",title: "Data berhasil diubah",message: "",},{type: "success",placement: {from: "top",align: "right"},time: 1000,});</script>');
    }

    public function delete($id)
    {
        $this->hutang_model->delete($id);
        $this->session->set_flashdata('message', '<script>$.notify({icon: "done_outline",title: "Data berhasil dihapus",message: "",},{type: "success",placement: {from: "top",align: "right"},time: 1000,});</script>');
        redirect('piutang');
    }
}
