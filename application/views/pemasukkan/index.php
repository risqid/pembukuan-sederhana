<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?= $this->session->flashdata('message'); ?>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Data Pemasukkan</h4>
                        <p class="card-category">Kelola data pemasukkan toko</p>
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
                                                            <i class="material-icons">today</i>
                                                        </span>
                                                    </div>
                                                    <input name="tanggal" type="date" value="<?= $tanggal; ?>" class="form-control" placeholder="">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">flag</i>
                                                        </span>
                                                    </div>
                                                    <select name="kategori" class="form-control" data-style="btn btn-link" required onchange="showStok(this.value)">
                                                        <option value="">Pilih Kategori</option>
                                                        <?php foreach ($kategori as $k) : ?>
                                                            <option value="<?= $k['kategori']; ?>"><?= $k['kategori']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div id="stok" hidden>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="material-icons">inventory</i>
                                                            </span>
                                                        </div>
                                                        <select name="barang" class="form-control" data-style="btn btn-link" onchange="setHarga(this.value)">
                                                            <option value="">Pilih barang</option>
                                                            <?php foreach ($barang as $b) : ?>
                                                                <option value="<?= $b['harga']; ?>"><?= $b['nama']; ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="material-icons">pin</i>
                                                            </span>
                                                        </div>
                                                        <input name="jumlah" id="jumlah" type="number" value="0" class="form-control" placeholder="masukkan jumlah barang" autocomplete="off" oninput="setTotal(this)">
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">article</i>
                                                        </span>
                                                    </div>
                                                    <textarea name="catatan" class="form-control" rows="1" placeholder="masukkan catatan jika ada"></textarea>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">monetization_on</i>
                                                        </span>
                                                    </div>
                                                    <input name="masuk" type="number" class="form-control" required placeholder="masukkan nominal" autofocus>
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
                                        #
                                    </th>
                                    <th>
                                        Tanggal
                                    </th>
                                    <th>
                                        Nota
                                    </th>
                                    <th>
                                        Kategori
                                    </th>
                                    <th>
                                        Catatan
                                    </th>
                                    <th>
                                        Nominal
                                    </th>
                                    <th>
                                        Aksi
                                    </th>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($pemasukkan as $p) : ?>
                                        <tr>
                                            <td>
                                                <?= $i++; ?>
                                            </td>
                                            <td>
                                                <?= $p['tanggal']; ?>
                                            </td>
                                            <td>
                                                <?= 'm' . str_replace("-", "", str_replace("2021", "21", $p['tanggal'])) . $p['no']; ?>
                                            </td>
                                            <td>
                                                <?= $p['kategori']; ?>
                                            </td>
                                            <td>
                                                <?= $p['catatan']; ?>
                                            </td>
                                            <td class="text-primary">
                                                Rp.<?= number_format($p['masuk'], 0, ',', '.')  ?>
                                            </td>
                                            <td class="td-actions">
                                                <button type="button" class="btn btn-warning btn-link btn-sm" data-toggle="modal" data-target="#modalEdit" data-id="<?= $p['id'] ?>" data-tanggal="<?= $p['tanggal'] ?>" data-kategori="<?= $p['kategori'] ?>" data-catatan="<?= $p['catatan'] ?>" data-masuk="<?= $p['masuk'] ?>" onclick="loadEditData(this)">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                                <a href="<?= base_url('pemasukkan/delete/') . $p['id']; ?>" onclick="return confirm('apakah anda yakain ingin menghapus?')">
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
                                                <input type="text" name="id" class="form-control" hidden>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">today</i>
                                                        </span>
                                                    </div>
                                                    <input name="tanggal" type="date" value="<?= $tanggal; ?>" class="form-control" placeholder="">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">flag</i>
                                                        </span>
                                                    </div>
                                                    <select name="kategori" class="form-control" data-style="btn btn-link" required>
                                                        <?php foreach ($kategori as $k) : ?>
                                                            <option value="<?= $k['kategori']; ?>"><?= $k['kategori']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">article</i>
                                                        </span>
                                                    </div>
                                                    <textarea name="catatan" class="form-control" rows="1" placeholder="masukkan catatan jika ada"></textarea>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">monetization_on</i>
                                                        </span>
                                                    </div>
                                                    <input name="masuk" type="number" class="form-control" required placeholder="Masukkan Nominal" autofocus>
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
    function loadEditData(baris) {
        var id = baris.getAttribute("data-id");
        var tanggal = baris.getAttribute("data-tanggal");
        var kategori = baris.getAttribute("data-kategori");
        var catatan = baris.getAttribute("data-catatan");
        var masuk = baris.getAttribute("data-masuk");

        // document.form's name.input's name.value
        document.edit.id.value = id;
        document.edit.tanggal.value = tanggal;
        document.edit.kategori.value = kategori;
        document.edit.catatan.value = catatan;
        document.edit.masuk.value = masuk;
    }

    // function showStok(val) {
    //     container = document.getElementById('stok');
    //     if (val == "Penjualan") {
    //         container.removeAttribute("hidden");
    //     } else {
    //         container.setAttribute("hidden", true);
    //     }
    // }

    // function setHarga(val) {
    //     jumlah = document.getElementById('jumlah');
    //     jumlah.setAttribute("data-harga", val);
    // }

    // function setTotal(val) {
    //     jumlah = val.value;
    //     harga = val.getAttribute('data-harga');

    //     document.input.masuk.value = jumlah * harga;
    // }
</script>