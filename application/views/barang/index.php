<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?= $this->session->flashdata('message'); ?>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Data Barang</h4>
                        <p class="card-category">Kelola data barang toko</p>
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
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">inventory</i>
                                                        </span>
                                                    </div>
                                                    <input name="nama" class="form-control" placeholder="masukkan nama barang" autofocus required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">local_offer</i>
                                                        </span>
                                                    </div>
                                                    <input name="harga" type="number" class="form-control" placeholder="masukkan harga" required>
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
                        <div class="table-responsive">
                            <table id="myTable" class="table">
                                <thead class=" text-primary">
                                    <th>
                                        Nama
                                    </th>
                                    <th>
                                        Harga
                                    </th>
                                    <th>
                                        Stok
                                    </th>
                                    <th>
                                        Aksi
                                    </th>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($barang as $b) : ?>
                                        <tr>

                                            <td>
                                                <?= $b['nama']; ?>
                                            </td>
                                            <td>
                                                <?= $b['harga']; ?>
                                            </td>
                                            <td>
                                                <?= $b['stok']; ?>
                                            </td>
                                            <td class="td-actions">
                                                <button type="button" class="btn btn-warning btn-link btn-sm" data-toggle="modal" data-target="#modalEdit" data-id="<?= $b['id'] ?>" data-nama="<?= $b['nama'] ?>" data-harga="<?= $b['harga'] ?>" data-stok="<?= $b['stok'] ?>" onclick="loadEditData(this)">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                                <a href="<?= base_url('barang/delete/') . $b['id']; ?>" onclick="return confirm('apakah anda yakain ingin menghapus?')">
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
                                                <input type="text" name="id" hidden>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">inventory</i>
                                                        </span>
                                                    </div>
                                                    <input name="nama" class="form-control" placeholder="masukkan nama barang" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">local_offer</i>
                                                        </span>
                                                    </div>
                                                    <input name="harga" type="number" class="form-control" placeholder="masukkan harga" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">pin</i>
                                                        </span>
                                                    </div>
                                                    <input name="stok" type="number" class="form-control" placeholder="masukkan jumlah" required>
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
    function loadEditData(baris) {
        var id = baris.getAttribute("data-id");
        var nama = baris.getAttribute("data-nama");
        var harga = baris.getAttribute("data-harga");
        var stok = baris.getAttribute("data-stok");

        // document.form's name.input's name.value
        document.edit.id.value = id;
        document.edit.nama.value = nama;
        document.edit.harga.value = harga;
        document.edit.stok.value = stok;
    }
</script>