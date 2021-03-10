<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Kas toko</h4>
                        <p class="card-category">Lihat kas keuangan toko</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table">
                                <thead class=" text-primary">
                                    <th>#</th>
                                    <th>
                                        Tanggal
                                    </th>
                                    <th>
                                        Kategori
                                    </th>
                                    <th>
                                        Pemasukkan
                                    </th>
                                    <th class="text-danger">Pengeluaran</th>
                                    <th>Saldo</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($kas as $k) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td>
                                                <?= $k['tanggal']; ?>
                                            </td>
                                            <td>
                                                <?= $k['kategori']; ?>
                                            </td>
                                            <td class="text-primary">
                                                <?php if ($k['masuk']) : ?>
                                                    Rp.<?= number_format($k['masuk'], 0, ',', '.'); ?>
                                                <?php endif ?>
                                            </td>
                                            <td class="text-danger">
                                                <?php if ($k['keluar']) : ?>
                                                    Rp.<?= number_format($k['keluar'], 0, ',', '.'); ?>
                                                <?php endif ?>
                                            </td>
                                            <td class="text-primary">
                                                Rp.<?= number_format($k['saldo'], 0, ',', '.'); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>