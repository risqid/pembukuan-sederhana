<!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">input</i>
            </div>
            <p class="card-category">Pemasukkan Hari Ini</p>
            <h3 class="card-title">Rp.<?= number_format($pemasukkan['masuk'], 0, ',', '.'); ?>
            </h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">search</i>
              <a href="<?= base_url('sp/pemasukkan'); ?>">lihat semua pemasukkan</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">logout</i>
            </div>
            <p class="card-category">Pengeluaran Hari Ini</p>
            <h3 class="card-title">Rp.<?= number_format($pengeluaran['keluar'], 0, ',', '.') ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">search</i>
              <a href="<?= base_url('sp/pengeluaran'); ?>">lihat semua pengeluaran</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-danger card-header-icon">
            <div class="card-icon">
              <i class="material-icons">supervisor_account</i>
            </div>
            <p class="card-category">Hutang Belum Dilunasi</p>
            <h3 class="card-title"><?= $hutang; ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">search</i>
              <a href="<?= base_url('sp/hutang'); ?>">lihat semua hutang</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="card card-chart">
          <div class="card-header card-header-success">
            <div class="ct-chart" id="dailySalesChart"></div>
          </div>
          <div class="card-body">
            <h4 class="card-title">Pemasukkan Harian</h4>
            <p class="card-category">
              <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> pertambahan pemasukkan hari ini.
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card card-chart">
          <div class="card-header card-header-warning">
            <div class="ct-chart" id="websiteViewsChart"></div>
          </div>
          <div class="card-body">
            <h4 class="card-title">Pengeluaran Harian</h4>
            <p class="card-category">Last Campaign Performance</p>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">access_time</i> campaign sent 2 days ago
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card card-chart">
          <div class="card-header card-header-danger">
            <div class="ct-chart" id="completedTasksChart"></div>
          </div>
          <div class="card-body">
            <h4 class="card-title">Hutang dilunasi</h4>
            <p class="card-category">Last Campaign Performance</p>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">access_time</i> campaign sent 2 days ago
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>
</div>

<script>
  dataChartPemasukkan = {
    labels: ['S', 'S', 'R', 'K', 'J', 'S', 'M'],
    series: [
      [12, 17, 7, 17, 23, 18, 0]
    ]
  };

  optionsChartPemasukkan = {
    lineSmooth: Chartist.Interpolation.cardinal({
      tension: 0
    }),
    low: 0,
    high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
    chartPadding: {
      top: 0,
      right: 0,
      bottom: 0,
      left: 0
    },
  }

  var dailySalesChart = new Chartist.Line('#dailySalesChart', dataChartPemasukkan, optionsChartPemasukkan);
  var animationHeaderChart = new Chartist.Line('#websiteViewsChart', dataChartPemasukkan, optionsChartPemasukkan);

  dataChartPengeluaran = {
    labels: ['S', 'S', 'R', 'K', 'J', 'S', 'M'],
    series: [
      [12, 17, 7, 17, 23, 18, 0]
    ]
  };

  optionsChartPengeluaran = {
    lineSmooth: Chartist.Interpolation.cardinal({
      tension: 0
    }),
    low: 0,
    high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
    chartPadding: {
      top: 0,
      right: 0,
      bottom: 0,
      left: 0
    },
  }

  var chartPengeluaran = new Chartist.Line('#chartPengeluaran', dataChartPengeluaran, optionsChartPengeluaran);
  var animationHeaderChart = new Chartist.Line('#websiteViewsChart', dataChartPengeluaran, optionsChartPengeluaran);
</script>