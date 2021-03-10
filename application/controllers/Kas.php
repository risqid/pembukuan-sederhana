<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kas extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_logged_in_sp();
        $this->load->model('kas_model');
        date_default_timezone_set("Asia/Jakarta");
    }
    public function index()
    {
        $data = [
            'title' => "Kas",
            'kas' => $this->kas_model->tampilkan()
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar');
        $this->load->view('kas/index', $data);
        $this->load->view('templates/footer');
    }
}
