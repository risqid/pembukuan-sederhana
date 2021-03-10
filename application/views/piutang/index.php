<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <?= $this->session->flashdata('message'); ?>

                <div class="card">
                    <div class="card-header card-header-tabs card-header-primary">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <span class="nav-tabs-title">Status:</span>
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#semua" data-toggle="tab">
                                            <i class="material-icons">all_inclusive</i>Semua
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#lunas" data-toggle="tab">
                                            <i class="material-icons">check_circle</i>Lunas
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#belum-lunas" data-toggle="tab">
                                            <i class="material-icons">warning</i>Belum Lunas
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <button class="btn float-left btn-primary mb-3" data-toggle="modal" data-target="#modalInput">
                            Tambah
                        </button>
                        <!-- modal input -->
                        <div id="modalInput" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Input Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form name="input" method="post" action="">
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="material-icons">today</i>
                                                                </span>
                                                            </div>
                                                            <input name="tanggal" type="date" value="<?= $tanggal; ?>" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="material-icons">event_busy</i>
                                                                </span>
                                                            </div>
                                                            <input name="batas_pelunasan" type="date" value="<?= $batasPelunasan; ?>" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">person</i>
                                                        </span>
                                                    </div>
                                                    <input name="nama" class="form-control" placeholder="masukkan nama" required></input>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">monetization_on</i>
                                                        </span>
                                                    </div>
                                                    <input name="nominal" type="number" class="form-control" placeholder="masukkan nominal" required>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="semua">
                                <div class="table-responsive">
                                    <table id="myTable" class="table">
                                        <thead class="text-primary">
                                            <th>
                                                #
                                            </th>
                                            <th>Tanggal</th>
                                            <th>
                                                Nama
                                            </th>
                                            <th>
                                                Nominal
                                            </th>
                                            <th>Status</th>
                                            <th>Batas Pelunasan</th>
                                            <th>
                                                Aksi
                                            </th>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1 ?>
                                            <?php foreach ($semua as $s) : ?>
                                                <tr>
                                                    <td>
                                                        <?= $i++; ?>
                                                    </td>
                                                    <td>
                                                        <?= $s['tanggal']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $s['nama']; ?>
                                                    </td>
                                                    <td class="text-primary">
                                                        Rp.<?= number_format($s['nominal'], 0, ',', '.'); ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <?php if ($s['status'] == 0) : ?>
                                                                    <input class="form-check-input" type="checkbox">
                                                                <?php else : ?>
                                                                    <input class="form-check-input" type="checkbox" checked>
                                                                <?php endif ?>
                                                                <span class="form-check-sign">
                                                                    <span class="check" data-id="<?= $s['id']; ?>" onclick="return confirm('apakah anda yakin?') , changeStatus(this)"></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= $s['batas_pelunasan']; ?></td>
                                                    <td class="td-actions">
                                                        <button type="button" class="btn btn-warning btn-link btn-sm" data-toggle="modal" data-target="#modalEdit" data-id="<?= $s['id'] ?>" data-tanggal="<?= $s['tanggal'] ?>" data-nama="<?= $s['nama'] ?>" data-nominal="<?= $s['nominal'] ?>" data-batas_pelunasan="<?= $s['batas_pelunasan'] ?>" onclick="loadEditData(this)">
                                                            <i class="material-icons">edit</i>
                                                        </button>
                                                        <a href="<?= base_url('piutang/delete/') . $s['id']; ?>" onclick="return confirm('apakah anda yakain ingin menghapus?')">
                                                            <button type="button" class="btn btn-danger btn-link btn-sm">
                                                                <i class="material-icons">delete</i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="lunas">
                                <div class="table-responsive">
                                    <table id="myTable" class="table">
                                        <thead class="text-primary">
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                Nama
                                            </th>
                                            <th>
                                                Nominal
                                            </th>
                                            <th>Status</th>
                                            <th>
                                                Batas Pelunasan
                                            </th>
                                            <th>
                                                Aksi
                                            </th>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1 ?>
                                            <?php foreach ($lunas as $l) : ?>
                                                <tr>
                                                    <td>
                                                        <?= $i++; ?>
                                                    </td>
                                                    <td>
                                                        <?= $l['nama']; ?>
                                                    </td>
                                                    <td class="text-primary">
                                                        Rp.<?= number_format($l['nominal'], 0, ',', '.'); ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <?php if ($l['status'] == 0) : ?>
                                                                    <input class="form-check-input" type="checkbox">
                                                                <?php else : ?>
                                                                    <input class="form-check-input" type="checkbox" checked>
                                                                <?php endif ?>
                                                                <span class="form-check-sign">
                                                                    <span class="check" data-id="<?= $l['id']; ?>" onclick="return confirm('apakah anda yakin?') , changeStatus(this)"></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td><?= $l['batas_pelunasan']; ?></td>
                                                    <td class="td-actions">
                                                        <button type="button" class="btn btn-warning btn-link btn-sm" data-toggle="modal" data-target="#modalEdit" data-id="<?= $l['id'] ?>" data-tanggal="<?= $l['tanggal'] ?>" data-nama="<?= $l['nama'] ?>" data-nominal="<?= $l['nominal'] ?>" data-batas_pelunasan="<?= $s['batas_pelunasan'] ?>" onclick="loadEditData(this)">
                                                            <i class="material-icons">edit</i>
                                                        </button>
                                                        <a href="<?= base_url('hutang/delete/') . $s['id']; ?>" onclick="return confirm('apakah anda yakain ingin menghapus?')">
                                                            <button type="button" class="btn btn-danger btn-link btn-sm">
                                                                <i class="material-icons">delete</i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="belum-lunas">
                                <div class="table-responsive">
                                    <table id="myTable" class="table">
                                        <thead class="text-primary">
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                Nama
                                            </th>
                                            <th>
                                                Nominal
                                            </th>
                                            <th>Status</th>
                                            <th>Batas Pelunasan</th>
                                            <th>
                                                Aksi
                                            </th>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1 ?>
                                            <?php foreach ($belumLunas as $bl) : ?>
                                                <tr>
                                                    <td>
                                                        <?= $i++; ?>
                                                    </td>
                                                    <td>
                                                        <?= $bl['nama']; ?>
                                                    </td>
                                                    <td class="text-primary">
                                                        Rp.<?= number_format($bl['nominal'], 0, ',', '.'); ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <?php if ($bl['status'] == 0) : ?>
                                                                    <input class="form-check-input" type="checkbox">
                                                                <?php else : ?>
                                                                    <input class="form-check-input" type="checkbox" checked>
                                                                <?php endif ?>
                                                                <span class=" form-check-sign">
                                                                    <span class="check" data-id="<?= $bl['id']; ?>" onclick="return confirm('apakah anda yakin?') , changeStatus(this)"></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td><?= $bl['batas_pelunasan']; ?></td>
                                                    <td class="td-actions">
                                                        <button type="button" class="btn btn-warning btn-link btn-sm" data-toggle="modal" data-target="#modalEdit" data-id="<?= $bl['id'] ?>" data-tanggal="<?= $bl['tanggal'] ?>" data-nama="<?= $bl['nama'] ?>" data-nominal="<?= $bl['nominal'] ?>" data-batas_pelunasan="<?= $s['batas_pelunasan'] ?>" onclick="loadEditData(this)">
                                                            <i class="material-icons">edit</i>
                                                        </button>
                                                        <a href="<?= base_url('hutang/delete/') . $s['id']; ?>" onclick="return confirm('apakah anda yakain ingin menghapus?')">
                                                            <button type="button" class="btn btn-danger btn-link btn-sm">
                                                                <i class="material-icons">delete</i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- modal edit -->
                        <div id="modalEdit" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form name="edit" method="post" action="">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="text" name="id" class="form-control" hidden>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="material-icons">today</i>
                                                                </span>
                                                            </div>
                                                            <input name="tanggal" type="date" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="material-icons">event_busy</i>
                                                                </span>
                                                            </div>
                                                            <input name="batas_pelunasan" type="date" class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">person</i>
                                                        </span>
                                                    </div>
                                                    <input name="nama" class="form-control" placeholder="masukkan nama" required></input>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">monetization_on</i>
                                                        </span>
                                                    </div>
                                                    <input name="nominal" type="number" class="form-control" placeholder="Masukkan Nominal" required>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function loadEditData(row) {
        var id = row.getAttribute("data-id");
        var tanggal = row.getAttribute("data-tanggal");
        var nama = row.getAttribute("data-nama");
        var nominal = row.getAttribute("data-nominal");
        var batas_pelunasan = row.getAttribute("data-batas_pelunasan");

        // document.form's name.input's name.value
        document.edit.id.value = id;
        document.edit.tanggal.value = tanggal;
        document.edit.nama.value = nama;
        document.edit.nominal.value = nominal;
        document.edit.batas_pelunasan.value = batas_pelunasan;
    }

    function changeStatus(data) {
        var id = data.getAttribute('data-id');

        $.ajax({
            url: "<?= base_url('piutang/changestatus/') ?>",
            type: 'post',
            data: {
                id: id
            },
            success: function() {
                document.location.href = "<?= base_url('piutang'); ?>";
            }
        });
    }
</script>