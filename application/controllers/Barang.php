<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_logged_in_sp();
        $this->load->model('barang_model');
        $this->load->model('next_model');
        date_default_timezone_set("Asia/Jakarta");
    }
    public function index()
    {
        $data = [
            'title' => "Daftar Barang",
            'barang' => $this->barang_model->show()

        ];

        if (isset($_POST['submit'])) {
            $nextId = $this->next_model->getNextId('barang');

            $id = htmlspecialchars($this->input->post('id'));
            $nama = htmlspecialchars($this->input->post('nama'));
            $slug = url_title($nama, '-', true);
            $harga = htmlspecialchars($this->input->post('harga'));
            $stok = htmlspecialchars($this->input->post('stok'));


            if (empty($id)) {
                $data = [
                    'id' => $nextId,
                    'nama' => $nama,
                    'slug' => $slug,
                    'harga' => $harga,
                ];

                $isExist = $this->db->get_where('barang', ['nama' => $nama])->row_array();
                if ($isExist) {
                    $this->session->set_flashdata('message', '<script>$.notify({icon: "done_outline",title: "Nama barang sudah ada",message: "",},{type: "danger",placement: {from: "top",align: "right"},time: 1000,});</script>');
                    redirect('barang');
                } else {
                    $this->barang_model->insert($data);
                    $this->session->set_flashdata('message', '<script>$.notify({icon: "done_outline",title: "Data berhasil ditambahkan",message: "",},{type: "success",placement: {from: "top",align: "right"},time: 1000,});</script>');
                    redirect('barang');
                }
            } else {
                $data = [
                    'id' => $id,
                    'nama' => $nama,
                    'slug' => $slug,
                    'harga' => $harga,
                    'stok' => $stok
                ];
                $this->barang_model->edit($data);
                $this->session->set_flashdata('message', '<script>$.notify({icon: "done_outline",title: "Data berhasil diubah",message: "",},{type: "success",placement: {from: "top",align: "right"},time: 1000,});</script>');
                redirect('barang');
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar');
        $this->load->view('barang/index', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        $this->barang_model->delete($id);
        $this->session->set_flashdata('message', '<script>$.notify({icon: "done_outline",title: "Data berhasil dihapus",message: "",},{type: "success",placement: {from: "top",align: "right"},time: 1000,});</script>');
        redirect('barang');
    }

    public function harga($nama)
    {
        $data = $this->db->get_where('barang', ['nama' => $nama])->row_array();
        echo $data['harga'];
    }

    public function search($keyword)
    {
        $data = $this->barang_model->search($keyword);

        //output the response
        foreach ($data as $d) {
            echo '<span class="sugesstion" data-harga="' . $d['harga'] . '" data-nama="' . $d['nama'] . '" onclick="setBarang(this)">' . $d['nama'] . '</span><br>';
        }
    }
}
