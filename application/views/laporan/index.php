<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Laporan Keuangan</h4>
                        <p class="card-category">Lihat laporan keuangan toko</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-12 ">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">today</i>
                                        </span>
                                    </div>
                                    <input id="from" type="date" class="form-control" onchange="getLaporan()">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-5 col-12 ">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">event_busy</i>
                                        </span>
                                    </div>
                                    <input id="to" type="date" value="<?= date('Y-m-d'); ?>" class="form-control" onchange="getLaporan()">
                                </div>
                            </div>
                        </div>
                        <div id="laporan">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function getLaporan() {
        // membuat objek ajax
        var from = document.getElementById('from').value;
        var to = document.getElementById('to').value;
        $.ajax({
            url: "<?= base_url('laporan/ajax/') ?>" + from + "/" + to,
            type: 'post',
            data: {
                from: from,
                to: to
            },
            success: function(data) {
                document.getElementById('laporan').innerHTML = data;
            }
        });
    }
</script>