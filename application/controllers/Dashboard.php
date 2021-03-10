<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		is_logged_in_sp();
		$this->load->model('dashboard_sp_model');
		date_default_timezone_set("Asia/Jakarta");
	}

	public function index()
	{

		$today = date("Y-m-d");
		$from = date_sub(date_create($today), date_interval_create_from_date_string("7 days"));
		$from = date_format($from, "Y-m-d");

		$data = [
			'title' => "Dashboard",
			'hutang' => $this->dashboard_sp_model->showHutang(),
			'pemasukkan' => $this->dashboard_sp_model->showPemasukkan(),
			'pengeluaran' => $this->dashboard_sp_model->showPengeluaran(),
			// 'chartPemasukkan' => $this->dashboard_sp_model->showPemasukkan7($from)
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/navbar');
		$this->load->view('dashboard/index', $data);
		$this->load->view('templates/footer');
	}

	// public function chartPemasukkan()
	// {

	// 	$today = date("Y-m-d");
	// 	$from = date_sub(date_create($today), date_interval_create_from_date_string("7 days"));

	// 	$from = date_format($from, "Y-m-d");

	// 	$data = [
	// 		'pemasukkan' => $this->dashboard_sp_model->showPemasukkan7($from)
	// 	];
	// }
}
