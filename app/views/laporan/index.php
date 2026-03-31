<div class="container-fluid">
    <div class="card shadow-sm mb-4 no-print">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Filter & Cetak Rekap</h5>
            <form action="<?= BASEURL; ?>/index.php" method="GET" class="row g-3">
                <input type="hidden" name="url" value="laporan">
                <div class="col-md-3">
                    <label class="form-label">Tanggal Awal</label>
                    <input type="date" name="tgl_awal" class="form-control" value="<?= $_GET['tgl_awal'] ?? ''; ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal Akhir</label>
                    <input type="date" name="tgl_akhir" class="form-control" value="<?= $_GET['tgl_akhir'] ?? ''; ?>" required>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2"><i class="bi bi-search"></i> Filter</button>
                    <a href="<?= BASEURL; ?>/index.php?url=laporan" class="btn btn-secondary me-2">Reset</a>
                    <button type="button" onclick="window.print()" class="btn btn-success"><i class="bi bi-printer"></i> Cetak PDF</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="text-center mb-4">
                <h4 class="fw-bold">LAPORAN REKAP PENGADUAN SARANA</h4>
                <p class="mb-0">
                    Periode: 
                    <strong>
                        <?= (isset($_GET['tgl_awal']) && $_GET['tgl_awal'] != '') ? date('d-m-Y', strtotime($_GET['tgl_awal'])) : 'Semua'; ?> 
                        s/d 
                        <?= (isset($_GET['tgl_akhir']) && $_GET['tgl_akhir'] != '') ? date('d-m-Y', strtotime($_GET['tgl_akhir'])) : 'Semua'; ?>
                    </strong>
                </p>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Tgl Lapor</th>
                            <th width="10%">NIS</th>
                            <th width="15%">Lokasi</th>
                            <th>Keterangan</th>
                            <th width="12%">Status</th>
                            <th>Tanggapan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($data['aspirasi'])) : ?>
                            <?php $i = 1; foreach($data['aspirasi'] as $row) : ?>
                            <tr>
                                <td class="text-center"><?= $i++; ?></td>
                                <td class="text-center"><?= date('d/m/Y', strtotime($row['tgl_pelaporan'])); ?></td>
                                <td><?= $row['nis']; ?></td>
                                <td><?= $row['lokasi']; ?></td>
                                <td><?= $row['ket']; ?></td>
                                <td class="text-center">
                                    <span class="badge <?= ($row['status'] == 'selesai') ? 'bg-success' : 'bg-warning text-dark'; ?>">
                                        <?= strtoupper($row['status'] ?? 'PROSES'); ?>
                                    </span>
                                </td>
                                <td><?= $row['feedback'] ?: '-'; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7" class="text-center py-4">Data tidak ditemukan pada periode ini.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="d-none d-print-block mt-5">
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4 text-center">
                        <p>Dicetak pada: <?= date('d/m/Y'); ?></p>
                        <br><br><br>
                        <p class="fw-bold">( __________________ )</p>
                        <p>Petugas Sarpras</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print, .btn, .form-label { display: none !important; }
    .card { border: none !important; box-shadow: none !important; }
    .container-fluid { width: 100% !important; padding: 0 !important; margin: 0 !important; }
    table { width: 100% !important; border-collapse: collapse !important; font-size: 11px; }
    .table-dark { background-color: #343a40 !important; color: white !important; }
    /* Menghilangkan Header/Footer Browser (Tanggal/URL di pojok kertas) */
    @page { margin: 1cm; }
}
</style>