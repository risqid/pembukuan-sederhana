<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    is_logged_in_sp();
    $this->load->model('laporan_model');
    date_default_timezone_set("Asia/Jakarta");
  }
  public function index()
  {

    $data = [
      'title' => "Laporan"
    ];
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/navbar');
    $this->load->view('laporan/index', $data);
    $this->load->view('templates/footer');
  }

  public function ajax()
  {
    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $laporan = $this->laporan_model->show($from, $to);
    $laba = $this->laporan_model->hitung($from, $to);

    echo '          <div class="row">

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">input</i>
              </div>
              <p class="card-category">Pemasukkan</p>
              <h3 class="card-title">Rp' . number_format($laba['pemasukkan'], 0, ',', '.') . '</h3>
            </div>
            <div class="card-footer">

            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">logout</i>
            </div>
            <p class="card-category">Pengeluaran</p>
            <h3 class="card-title">Rp' . number_format($laba['pengeluaran'], 0, ',', '.') . '
            </h3>
          </div>
          <div class="card-footer">
            
          </div>
        </div>
      </div>';
    if ($laba['laba'] >= 0) {
      echo '
          <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
              <i class="material-icons">monetization_on</i>
              </div>
              <p class="card-category">Laba</p>
              <h3 class="card-title">Rp' . number_format($laba['laba'], 0, ',', '.') . '</h3>
            </div>
            <div class="card-footer">

            </div>
          </div>
        </div>
      </div>';
    } else {

      echo '
      <div class="col-lg-4 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-danger card-header-icon">
          <div class="card-icon">
          <i class="material-icons">monetization_on</i>
          </div>
          <p class="card-category">Rugi</p>
          <h3 class="card-title">Rp' . number_format($laba['laba'], 0, ',', '.') . '</h3>
        </div>
        <div class="card-footer">

        </div>
      </div>
    </div>
  </div>';
    }

    echo '<div  class="table-responsive"><table id="myTable" class="table">
        <thead class=" text-primary">
            <th>
                Transaksi
            </th>
            <th class="text-success">
                Pemasukkan
            </th>
            <th class="text-danger">Pengeluaran</th>
        </thead>
        <tbody>';
    foreach ($laporan as $l) {
      echo '<tr><td>' . $l['kategori'] . '</td><td>' . $l['masuk'] . '</td><td>' . $l['keluar'] . '</td></tr>';
    }
    echo '</tbody></table></div><script>
        $(document).ready(function() {
          $("#myTable").DataTable({});
        });
      </script>';
  }
}
