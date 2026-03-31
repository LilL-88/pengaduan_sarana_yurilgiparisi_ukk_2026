<div class="row">
    <div class="col-lg-12">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-800 text-dark mb-1">Riwayat Pengaduan</h4>
                <p class="text-muted small mb-0">Pantau status dan tanggapan laporan Anda secara real-time.</p>
            </div>
            <span class="badge bg-white shadow-sm text-primary p-2 px-3" style="border-radius: 10px;">
                <i class="bi bi-calendar3 me-2"></i><?php echo date('d M Y'); ?>
            </span>
        </div>

        <div class="row mb-4">
            <?php 
                $total = count($data['riwayat']);
                $selesai = 0; $proses = 0; $tunggu = 0;
                foreach($data['riwayat'] as $r) {
                    if($r['status'] == 'Selesai') $selesai++;
                    elseif($r['status'] == 'Proses') $proses++;
                    else $tunggu++;
                }
            ?>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 15px; border-left: 5px solid #4e73df !important;">
                    <small class="text-muted fw-bold">TOTAL LAPORAN</small>
                    <h3 class="fw-800 mb-0"><?= $total ?></h3>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 15px; border-left: 5px solid #1cc88a !important;">
                    <small class="text-muted fw-bold">SELESAI</small>
                    <h3 class="fw-800 mb-0"><?= $selesai ?></h3>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 15px; border-left: 5px solid #f6c23e !important;">
                    <small class="text-muted fw-bold">PROSES</small>
                    <h3 class="fw-800 mb-0"><?= $proses ?></h3>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 15px; border-left: 5px solid #858796 !important;">
                    <small class="text-muted fw-bold">MENUNGGU</small>
                    <h3 class="fw-800 mb-0"><?= $tunggu ?></h3>
                </div>
            </div>
        </div>

        <div class="card shadow border-0" style="border-radius: 20px; overflow: hidden;">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #f8fafc;">
                        <tr>
                            <th class="ps-4 py-3 border-0 text-uppercase small fw-800 text-muted">Informasi Laporan</th>
                            <th class="py-3 border-0 text-uppercase small fw-800 text-muted">Lokasi</th>
                            <th class="py-3 border-0 text-uppercase small fw-800 text-muted text-center">Status</th>
                            <th class="py-3 border-0 text-uppercase small fw-800 text-muted">Tanggapan Admin</th>
                            <th class="pe-4 py-3 border-0 text-uppercase small fw-800 text-muted text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        <?php if (!empty($data['riwayat'])) : ?>
                            <?php foreach ($data['riwayat'] as $row) : 
                                $s = $row['status'];
                                $badgeColor = ($s == 'Selesai') ? '#1cc88a' : (($s == 'Proses') ? '#f6c23e' : '#858796');
                                $bgLight = ($s == 'Selesai') ? '#f0fff4' : (($s == 'Proses') ? '#fffdf0' : '#f8f9fc');
                            ?>
                            <tr>
                                <td class="ps-4 py-4">
                                    <div class="d-flex align-items-center">
                                        <?php if(!empty($row['foto'])): ?>
                                            <img src="<?= BASEURL; ?>/assets/img/laporan/<?= $row['foto']; ?>" 
                                                 class="rounded-3 shadow-sm me-3 border" 
                                                 style="width: 55px; height: 55px; object-fit: cover; cursor: pointer;"
                                                 data-bs-toggle="modal" data-bs-target="#zoomFotoSiswa<?= $row['id_pelaporan']; ?>">
                                        <?php else: ?>
                                            <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center border" style="width: 55px; height: 55px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <div class="fw-bold text-dark text-truncate" style="max-width: 200px;"><?= $row['ket']; ?></div>
                                            <small class="text-muted text-uppercase" style="font-size: 10px;">ID: #LAP-<?= $row['id_pelaporan']; ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border p-2 fw-normal" style="border-radius: 8px;">
                                        <i class="bi bi-geo-alt text-primary me-1"></i><?= $row['lokasi']; ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="fw-bold px-3 py-1 rounded-pill d-inline-block" 
                                         style="font-size: 11px; background-color: <?= $bgLight ?>; color: <?= $badgeColor ?>; border: 1px solid <?= $badgeColor ?>;">
                                        <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> <?= strtoupper($s); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="p-2 px-3 rounded-3 bg-light border-0 small text-muted shadow-sm" style="max-width: 250px; font-style: italic; border-left: 3px solid #dee2e6 !important;">
                                        <?= (!empty($row['feedback'])) ? $row['feedback'] : '<i class="bi bi-hourglass-split me-1"></i> Menunggu tanggapan...'; ?>
                                    </div>
                                </td>
                                <td class="pe-4 text-end">
                                    <?php if($s == 'Menunggu') : ?>
                                        <button class="btn btn-sm btn-white shadow-sm border rounded-pill px-3 me-1" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editModal<?= $row['id_pelaporan']; ?>">
                                            <i class="bi bi-pencil-square text-primary"></i>
                                        </button>
                                        <a href="<?= BASEURL; ?>/index.php?url=aspirasi/hapus/<?= $row['id_pelaporan']; ?>" 
                                           class="btn btn-sm btn-white shadow-sm border rounded-pill px-3" 
                                           onclick="return confirm('Hapus laporan ini?')">
                                            <i class="bi bi-trash text-danger"></i>
                                        </a>

                                        <div class="modal fade" id="editModal<?= $row['id_pelaporan']; ?>" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow-lg" style="border-radius: 25px;">
                                                    <div class="modal-header border-0 p-4" style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); border-radius: 25px 25px 0 0;">
                                                        <h5 class="modal-title fw-800 text-white"><i class="bi bi-pencil-square me-2"></i>Edit Pengaduan</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form action="<?= BASEURL; ?>/index.php?url=aspirasi/edit_siswa" method="POST">
                                                        <div class="modal-body p-4 text-start">
                                                            <input type="hidden" name="id" value="<?= $row['id_pelaporan']; ?>">
                                                            
                                                            <div class="mb-4">
                                                                <label class="form-label small fw-bold text-muted text-uppercase">Lokasi Spesifik</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text bg-light border-0"><i class="bi bi-geo-alt text-primary"></i></span>
                                                                    <input type="text" name="lokasi" class="form-control bg-light border-0 py-2" value="<?= $row['lokasi']; ?>" required>
                                                                </div>
                                                            </div>

                                                            <div class="mb-2">
                                                                <label class="form-label small fw-bold text-muted text-uppercase">Detail Laporan</label>
                                                                <textarea name="ket" class="form-control bg-light border-0" rows="4" required style="border-radius: 12px; resize: none;"><?= $row['ket']; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer border-0 p-4 pt-0">
                                                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm" style="background: #4e73df; border: none;">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <span class="badge bg-light text-muted fw-normal p-2 px-3 rounded-pill border">
                                            <i class="bi bi-lock-fill me-1"></i> Terkunci
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" style="width: 80px; opacity: 0.3;" class="mb-3">
                                    <p class="text-muted mb-0">Belum ada data pengaduan yang ditemukan.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .table thead th { letter-spacing: 0.5px; }
    .btn-white { background: white; transition: all 0.3s ease; }
    .btn-white:hover { background-color: #f8fafc; transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important; }
    .table tr { transition: all 0.2s ease; }
    .table tr:hover { background-color: rgba(78, 115, 223, 0.03); }
    .card { transition: transform 0.3s ease; }
    .input-group-text { border-radius: 10px 0 0 10px !important; }
    .form-control { border-radius: 0 10px 10px 0 !important; }
</style>