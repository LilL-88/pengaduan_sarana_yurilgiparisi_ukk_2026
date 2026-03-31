<div class="container-fluid py-4" id="admin-dashboard">
    <style>
        :root { 
            --primary: #3b82f6;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1e293b;
            --glass: rgba(255, 255, 255, 0.95);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body { 
            background: #f1f5f9; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: #334155; 
            overflow-x: hidden;
        }

        /* Header Styling */
        .page-header {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            border-radius: 24px;
            padding: 35px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        .page-header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        /* Toast Modern Styling */
        #liveToast {
            border: none !important;
            border-radius: 16px !important;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2) !important;
            background: white !important;
            min-width: 300px;
        }

        #liveToast .toast-header {
            background-color: var(--primary) !important;
            color: white !important;
            border-radius: 16px 16px 0 0 !important;
            padding: 12px 15px;
        }

        /* Stats Card Modern */
        .card-stats {
            border: none;
            border-radius: 20px;
            background: white;
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.05);
            position: relative;
        }
        
        .card-stats:hover { 
            transform: translateY(-7px); 
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.08); 
        }
        
        .icon-shape {
            width: 55px;
            height: 55px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        /* Table Box */
        .table-box {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            border: 1px solid #eef2f6;
        }

        .table thead th {
            background: #f8fafc;
            padding: 20px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            border-bottom: 2px solid #f1f5f9;
        }

        .table tbody td { 
            padding: 20px; 
            vertical-align: middle; 
            border-bottom: 1px solid #f8fafc; 
        }

        /* Status Badges Custom */
        .st-selesai { background-color: #d1fae5 !important; color: #065f46 !important; }
        .st-proses { background-color: #fef3c7 !important; color: #92400e !important; }
        .st-menunggu { background-color: #f1f5f9 !important; color: #475569 !important; }

        .btn-action {
            padding: 8px 16px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 12px;
            transition: var(--transition);
        }

        /* Darkmode Overrides */
        .darkmode--activated .table-box,
        .darkmode--activated .card-stats {
            background: #1e293b !important;
            color: #f1f5f9 !important;
            border-color: #334155 !important;
        }

        @media print { .no-print { display: none !important; } }
    </style>

    <div class="page-header d-flex justify-content-between align-items-center no-print">
        <div>
            <h2 class="fw-bold mb-1">Pusat Kendali Pengaduan</h2>
            <div class="d-flex align-items-center gap-3 mt-2">
                <p class="opacity-75 mb-0">Selamat datang, Tim Sarpras. Pantau dan tindak lanjuti setiap laporan.</p>
                <span class="badge bg-white bg-opacity-10 border border-white border-opacity-25 rounded-pill px-3 py-2">
                    <i class="bi bi-clock me-2"></i>
                    <span id="realtime-clock" class="fw-semibold text-white">Memuat...</span>
                </span>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <?php
            $total_laporan = count($data['aspirasi']);
            $menunggu = 0; $proses = 0; $selesai = 0;
            foreach($data['aspirasi'] as $as) {
                $status = strtolower($as['status'] ?? 'menunggu');
                if($status == 'selesai') $selesai++;
                elseif($status == 'proses') $proses++;
                else $menunggu++;
            }
        ?>

        <div class="col-md-3">
            <div class="card card-stats p-4 shadow-sm" style="border-left: 5px solid #3b82f6;">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-shape bg-primary text-white">
                        <i class="bi bi-collection"></i>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold small mb-1">TOTAL DATA</h6>
                        <h3 class="fw-bold mb-0"><?= $total_laporan; ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats p-4 shadow-sm" style="border-left: 5px solid #ef4444;">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-shape bg-danger text-white">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold small mb-1">MENUNGGU</h6>
                        <h3 class="fw-bold mb-0"><?= $menunggu; ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats p-4 shadow-sm" style="border-left: 5px solid #f59e0b;">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-shape bg-warning text-white">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold small mb-1">DIPROSES</h6>
                        <h3 class="fw-bold mb-0"><?= $proses; ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats p-4 shadow-sm" style="border-left: 5px solid #10b981;">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-shape bg-success text-white">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold small mb-1">SELESAI</h6>
                        <h3 class="fw-bold mb-0"><?= $selesai; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-12">
            <div class="table-box">
                <div class="p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-3 bg-white sticky-top" style="z-index: 10;">
                    <div class="input-group" style="max-width: 350px;">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                        <input type="text" id="liveSearch" class="form-control bg-light border-0" placeholder="Cari NIS, lokasi, atau keluhan...">
                    </div>
                    <div class="d-flex gap-2">
                        <select class="form-select border-0 bg-light w-auto fw-bold" id="statusFilter">
                            <option value="">Semua Status</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Proses">Proses</option>
                            <option value="Menunggu">Menunggu</option>
                        </select>
                        <button class="btn btn-outline-primary border-0 bg-light fw-bold" onclick="window.print()">
                            <i class="bi bi-printer"></i>
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="mainTable">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>INFORMASI SISWA</th>
                                <th>KELUHAN & BUKTI</th> 
                                <th class="text-center">STATUS</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($data['aspirasi'])) : foreach ($data['aspirasi'] as $row) : ?>
                            <tr class="align-middle report-item">
                                <td class="text-center fw-bold text-muted small">#<?= $row['id_pelaporan']; ?></td>
                                <td>
                                    <div class="fw-bold text-dark"><?= $row['nis']; ?></div>
                                    <div class="text-primary small fw-bold"><i class="bi bi-geo-alt-fill"></i> <?= $row['lokasi']; ?></div>
                                </td>
                                <td>
                                    <div class="text-dark fw-semibold mb-1"><?= (strlen($row['ket']) > 80) ? substr($row['ket'], 0, 80) . '...' : $row['ket']; ?></div>
                                    
                                    <?php if(!empty($row['foto'])): ?>
                                        <div class="mt-2">
                                            <img src="<?= BASEURL; ?>/assets/img/laporan/<?= $row['foto']; ?>" 
                                                 class="rounded-3 shadow-sm border img-thumbnail" 
                                                 style="width: 70px; height: 50px; object-fit: cover; cursor: pointer;"
                                                 data-bs-toggle="modal" data-bs-target="#modalFotoAdmin<?= $row['id_pelaporan']; ?>">
                                        </div>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted fw-normal" style="font-size: 10px;">No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        $s = $row['status'] ?? 'Menunggu';
                                        $c = (strtolower($s) == 'selesai') ? 'st-selesai' : ((strtolower($s) == 'proses') ? 'st-proses' : 'st-menunggu');
                                    ?>
                                    <span class="badge rounded-pill px-3 py-2 <?= $c; ?> fw-bold" style="font-size: 10px;">
                                        <?= strtoupper($s); ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group shadow-sm rounded-3 overflow-hidden border">
                                        <button class="btn btn-white btn-sm border-end" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $row['id_pelaporan']; ?>" title="Lihat Detail">
                                            <i class="bi bi-eye text-primary"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#modalAksi<?= $row['id_pelaporan']; ?>">
                                            RESPON
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <tr><td colspan="5" class="text-center py-5">
                                <img src="https://illustrations.popsy.co/amber/no-results.svg" style="width: 150px;" class="mb-3">
                                <p class="text-muted fw-bold">Belum ada data pengaduan masuk.</p>
                            </td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="p-4 bg-light border-top d-flex justify-content-between align-items-center">
                    <small class="text-muted fw-bold">Menampilkan <?= count($data['aspirasi']); ?> laporan aktif</small>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bi bi-bell-fill me-2"></i>
            <strong class="me-auto">Sistem Notifikasi</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body fw-bold py-3" id="toastMessage">
            Data berhasil diperbarui!
        </div>
    </div>
</div>

<?php if(!empty($data['aspirasi'])) : foreach ($data['aspirasi'] as $row) : ?>
    
    <?php if(!empty($row['foto'])): ?>
    <div class="modal fade" id="modalFotoAdmin<?= $row['id_pelaporan']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 text-center position-relative">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" style="z-index: 100;"></button>
                    <img src="<?= BASEURL; ?>/assets/img/laporan/<?= $row['foto']; ?>" class="img-fluid rounded-4 shadow-lg border border-white border-4">
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="modal fade" id="modalDetail<?= $row['id_pelaporan']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 p-4 bg-light">
                    <h5 class="fw-bold mb-0"><i class="bi bi-info-circle me-2 text-primary"></i>Arsip Pengaduan #<?= $row['id_pelaporan']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-4 border">
                                <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Identitas Pelapor</label>
                                <h6 class="fw-bold mb-1"><?= $row['nis']; ?></h6>
                                <p class="small text-muted mb-0">Siswa Pelapor Sarana</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-4 border">
                                <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Waktu Pelaporan</label>
                                <h6 class="fw-bold mb-1"><?= $row['tgl'] ?? date('d F Y'); ?></h6>
                                <p class="small text-muted mb-0">Lokasi: <?= $row['lokasi']; ?></p>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Deskripsi Keluhan</label>
                            <div class="p-4 border rounded-4 bg-white shadow-sm italic text-dark" style="border-left: 5px solid var(--primary) !important;">
                                "<?= $row['ket']; ?>"
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Histori Tanggapan</label>
                            <div class="p-3 border-start border-primary border-4 bg-primary-subtle rounded-3">
                                <p class="mb-0 small fw-semibold">
                                    <i class="bi bi-chat-left-dots me-2"></i>
                                    <?= !empty($row['feedback']) ? $row['feedback'] : 'Belum ada tanggapan dari tim sarana prasarana.'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button class="btn btn-dark w-100 py-3 rounded-3 fw-bold" data-bs-dismiss="modal">TUTUP DETAIL</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAksi<?= $row['id_pelaporan']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="bg-primary p-4 text-white">
                    <h5 class="fw-bold mb-1">Tanggapi Laporan</h5>
                    <p class="small mb-0 opacity-75">Tentukan langkah perbaikan sarana sekolah</p>
                </div>
                <form action="<?= BASEURL; ?>/index.php?url=aspirasi/simpan_perubahan" method="POST" class="update-form">
                    <div class="modal-body p-4">
                        <input type="hidden" name="id" value="<?= $row['id_pelaporan']; ?>">
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Tentukan Progres</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="status" id="p_<?= $row['id_pelaporan']; ?>" value="Proses" <?= ($row['status'] == 'Proses') ? 'checked' : ''; ?> required>
                                    <label class="btn btn-outline-warning w-100 py-3 rounded-3 shadow-sm fw-bold" for="p_<?= $row['id_pelaporan']; ?>">
                                        <i class="bi bi-tools me-2"></i>PROSES
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="status" id="s_<?= $row['id_pelaporan']; ?>" value="Selesai" <?= ($row['status'] == 'Selesai') ? 'checked' : ''; ?>>
                                    <label class="btn btn-outline-success w-100 py-3 rounded-3 shadow-sm fw-bold" for="s_<?= $row['id_pelaporan']; ?>">
                                        <i class="bi bi-check-all me-2"></i>SELESAI
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold small text-muted text-uppercase">Pesan Feedback Untuk Siswa</label>
                            <textarea name="feedback" class="form-control border-0 bg-light p-3 rounded-3" rows="5" placeholder="Contoh: Meja sedang diperbaiki oleh tukang, mohon menunggu 2 hari..." required><?= $row['feedback'] ?? ''; ?></textarea>
                            <div class="form-text mt-2" style="font-size: 11px;">*Siswa akan melihat pesan ini di halaman riwayat mereka.</div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold shadow">SIMPAN & BERI TAHU SISWA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php endforeach; endif; ?>

<script>
    // 1. Variabel Global & Sinkronisasi Radar
    var radarCounter = 0; 

    // Fungsi Jam Realtime
    function updateClock() {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
        const el = document.getElementById('realtime-clock');
        if(el) el.textContent = now.toLocaleDateString('id-ID', options).replace(' pukul', ' •');
    }

    // Fungsi Deteksi Laporan Baru (Radar)
    function checkNewReports() {
        fetch('<?= BASEURL; ?>/index.php?url=aspirasi/cek_laporan_baru')
            .then(response => response.json())
            .then(data => {
                let totalData = parseInt(data.total);
                if (radarCounter === 0) {
                    radarCounter = totalData;
                } else if (totalData > radarCounter) {
                    radarCounter = totalData;
                    showNotification("🔔 Perhatian: Ada laporan pengaduan baru masuk!");
                }
            })
            .catch(err => console.warn("Radar standby mode."));
    }

    // Tampilkan Toast
    function showNotification(msg) {
        const toastEl = document.getElementById('liveToast');
        const toastMsg = document.getElementById('toastMessage');
        if (toastEl && toastMsg) {
            toastMsg.innerHTML = `<span class="text-primary">${msg}</span>`;
            let audio = new Audio('https://notificationsounds.com/storage/sounds/file-sounds-1150-pristine.mp3');
            audio.play().catch(() => console.log("Audio muted by browser policy."));
            new bootstrap.Toast(toastEl, { delay: 6000 }).show();
        }
    }

    // 2. Fungsi Filter & Pencarian
    function filterTable() {
        const searchText = document.getElementById('liveSearch').value.toLowerCase();
        const statusValue = document.getElementById('statusFilter').value.toLowerCase();
        const rows = document.querySelectorAll('#mainTable tbody tr.report-item');

        rows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            const rowStatusElement = row.querySelector('.badge');
            const rowStatus = rowStatusElement ? rowStatusElement.innerText.toLowerCase() : '';
            
            const matchSearch = rowText.includes(searchText);
            const matchStatus = statusValue === "" || rowStatus.includes(statusValue);

            row.style.display = (matchSearch && matchStatus) ? '' : 'none';
        });
    }

    // 3. Inisialisasi Saat Page Load
    document.addEventListener('DOMContentLoaded', function() {
        updateClock();
        setInterval(updateClock, 1000);

        checkNewReports(); 
        setInterval(checkNewReports, 15000); 

        const searchInput = document.getElementById('liveSearch');
        const statusSelect = document.getElementById('statusFilter');

        if(searchInput) searchInput.addEventListener('keyup', filterTable);
        if(statusSelect) statusSelect.addEventListener('change', filterTable);

        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('msg') === 'success') {
            showNotification("✅ Berhasil! Data pengaduan telah diperbarui.");
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
<script>
  function addDarkmodeWidget() {
    new Darkmode({ 
        bottom: '32px', 
        right: '32px', 
        label: '🌓',
        saveInCookies: true 
    }).showWidget();
  }
  window.addEventListener('load', addDarkmodeWidget);
</script>