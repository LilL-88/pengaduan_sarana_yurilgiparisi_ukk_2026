<div class="container-fluid py-4" id="form-pengaduan-siswa">
    
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-header-premium p-4 shadow-sm mb-4" style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); border-radius: 20px; color: white;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="fw-800 mb-1"><i class="bi bi-megaphone-fill me-2"></i> Suara Siswa</h2>
                        <p class="opacity-75 mb-0">Laporkan kendala fasilitas sekolah. Laporanmu adalah langkah awal perbaikan kami.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <div class="d-inline-block bg-white bg-opacity-25 p-3 rounded-3 backdrop-blur">
                            <h6 class="small fw-bold mb-1 text-uppercase">Status Sesi</h6>
                            <div class="d-flex align-items-center">
                                <div class="bg-success rounded-circle me-2" style="width: 10px; height: 10px;"></div>
                                <span class="fw-bold"><?php echo $_SESSION['siswa']['nama']; ?> (<?php echo $data['nis_user']; ?>)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4"><i class="bi bi-lightbulb text-warning me-2"></i>Tips Melapor</h5>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <span class="badge bg-primary-soft text-primary rounded-circle p-2 px-3">1</span>
                        </div>
                        <p class="small text-muted mb-0"><strong>Foto Jelas:</strong> Pastikan foto bukti terlihat jelas kerusakannya.</p>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <span class="badge bg-primary-soft text-primary rounded-circle p-2 px-3">2</span>
                        </div>
                        <p class="small text-muted mb-0"><strong>Lokasi Detail:</strong> Sebutkan nama kelas atau lantai agar teknisi cepat menemukan lokasi.</p>
                    </div>
                    <div class="d-flex">
                        <div class="me-3">
                            <span class="badge bg-primary-soft text-primary rounded-circle p-2 px-3">3</span>
                        </div>
                        <p class="small text-muted mb-0"><strong>Pantau Status:</strong> Cek menu 'Riwayat' secara berkala untuk melihat tanggapan admin.</p>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm bg-dark text-white overflow-hidden" style="border-radius: 20px;">
                <div class="card-body p-4 position-relative">
                    <div style="z-index: 2; position: relative;">
                        <h5 class="fw-bold">Butuh Bantuan Cepat?</h5>
                        <p class="small opacity-75">Hubungi sarpras jika ada keadaan darurat yang membahayakan siswa.</p>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-pill">Hubungi Kami</a>
                    </div>
                    <i class="bi bi-shield-check position-absolute" style="font-size: 100px; right: -20px; bottom: -20px; opacity: 0.1;"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-8 mb-5">
            <div class="card shadow-lg border-0" style="border-radius: 24px;">
                <div class="card-body p-4 p-md-5">
                    
                    <div class="step-container d-flex justify-content-between mb-5">
                        <div class="step-item active text-center">
                            <div class="step-icon mx-auto mb-2"><i class="bi bi-pencil"></i></div>
                            <span class="small fw-bold">Isi Data</span>
                        </div>
                        <div class="step-line"></div>
                        <div class="step-item text-center">
                            <div class="step-icon mx-auto mb-2"><i class="bi bi-camera"></i></div>
                            <span class="small fw-bold">Bukti Foto</span>
                        </div>
                        <div class="step-line"></div>
                        <div class="step-item text-center">
                            <div class="step-icon mx-auto mb-2"><i class="bi bi-check-all"></i></div>
                            <span class="small fw-bold">Selesai</span>
                        </div>
                    </div>

                    <form action="<?php echo BASEURL; ?>/index.php?url=aspirasi/simpan" method="POST" enctype="multipart/form-data" id="mainReportForm">
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-floating custom-form-group">
                                    <input type="number" name="nis" class="form-control border-0 bg-light" id="nisInput" value="<?php echo $data['nis_user']; ?>" readonly>
                                    <label for="nisInput" class="fw-bold"><i class="bi bi-person-badge me-2"></i>NIS SISWA</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="form-floating custom-form-group">
                                    <select name="id_kategori" class="form-select border-0 bg-light" id="catSelect" required>
                                        <option value="" selected disabled>Pilih Kategori...</option>
                                        <option value="1">🏫 Ruang Kelas</option>
                                        <option value="2">🔬 Laboratorium</option>
                                        <option value="3">⚽ Olahraga & Kantin</option>
                                        <option value="4">🚻 Toilet & Sanitasi</option>
                                        <option value="5">🔌 Listrik & IT</option>
                                    </select>
                                    <label for="catSelect" class="fw-bold"><i class="bi bi-tags me-2"></i>KATEGORI MASALAH</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-floating custom-form-group">
                                <input type="text" name="lokasi" class="form-control border-0 bg-light" id="locInput" placeholder="Lokasi" required>
                                <label for="locInput" class="fw-bold"><i class="bi bi-geo-alt me-2"></i>LOKASI SPESIFIK</label>
                            </div>
                            <div class="form-text mt-2"><i class="bi bi-info-circle"></i> Contoh: Lab Komputer 1, Sebelah AC</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-800 text-muted text-uppercase mb-2">Detail Keluhan Anda</label>
                            <textarea name="ket" class="form-control border-0 bg-light p-3" rows="5" placeholder="Jelaskan secara detail masalahnya di sini..." required style="border-radius: 15px; resize: none;"></textarea>
                        </div>

                        <div class="mb-5">
                            <label class="form-label small fw-800 text-muted text-uppercase mb-2">Lampiran Foto Bukti</label>
                            <div class="upload-area p-4 border-dashed rounded-4 text-center position-relative transition-all" id="dropZone">
                                <input type="file" name="foto" class="form-control position-absolute opacity-0 w-100 h-100 top-0 start-0" id="fileInput" accept="image/*" style="cursor: pointer; z-index: 10;">
                                
                                <div id="upload-placeholder">
                                    <div class="icon-upload-bg mx-auto mb-3">
                                        <i class="bi bi-cloud-arrow-up fs-2 text-primary"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Klik atau seret foto ke sini</h6>
                                    <p class="text-muted small mb-0">Format JPG, PNG (Maks. 2MB)</p>
                                </div>

                                <div id="preview-container" class="d-none mt-2">
                                    <img src="" id="imagePreview" class="img-fluid rounded-3 shadow-sm mb-3" style="max-height: 250px;">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-sm btn-danger rounded-pill px-3" id="removeBtn">
                                            <i class="bi bi-trash me-1"></i> Ganti Foto
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100 py-3 shadow-lg transition-all" id="submitBtn" style="border-radius: 16px; background: linear-gradient(45deg, #4e73df, #224abe); border: none;">
                                <span class="d-flex align-items-center justify-content-center">
                                    <i class="bi bi-send-fill fs-5 me-2"></i>
                                    <span class="fs-5 fw-bold">KIRIM PENGADUAN</span>
                                </span>
                            </button>
                            <p class="text-muted small mt-3 italic">Laporan yang sudah dikirim tidak dapat diedit selama masa proses.</p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    #form-pengaduan-siswa {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .fw-800 { font-weight: 800; }
    .backdrop-blur { backdrop-filter: blur(5px); }
    .transition-all { transition: all 0.3s ease; }

    /* Custom Form Floating */
    .custom-form-group .form-control, .custom-form-group .form-select {
        border-radius: 15px !important;
        padding-top: 1.625rem;
        padding-bottom: 0.625rem;
    }
    .custom-form-group label {
        padding-left: 1rem;
        color: #6c757d;
    }

    /* Steps Visual */
    .step-icon {
        width: 45px;
        height: 45px;
        background: #f1f5f9;
        color: #adb5bd;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transition: 0.4s;
    }
    .step-item.active .step-icon {
        background: #4e73df;
        color: white;
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.4);
    }
    .step-line {
        flex: 1;
        height: 2px;
        background: #f1f5f9;
        margin-top: 22px;
    }

    /* Upload Area */
    .upload-area {
        border: 2px dashed #cbd5e1;
        background-color: #f8fafc;
    }
    .upload-area:hover {
        border-color: #4e73df;
        background-color: #f0f7ff;
    }
    .icon-upload-bg {
        width: 65px;
        height: 65px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .bg-primary-soft { background-color: rgba(78, 115, 223, 0.1); }

    /* Button Hover */
    #submitBtn:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 25px rgba(78, 115, 223, 0.4) !important;
    }

    /* Validation focus */
    .form-control:focus, .form-select:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 4px rgba(78, 115, 223, 0.1) !important;
        border: 1px solid #4e73df !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fileInput');
    const imagePreview = document.getElementById('imagePreview');
    const previewContainer = document.getElementById('preview-container');
    const placeholder = document.getElementById('upload-placeholder');
    const removeBtn = document.getElementById('removeBtn');
    const dropZone = document.getElementById('dropZone');

    // 1. Live Preview Function
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            placeholder.classList.add('d-none');
            previewContainer.classList.remove('d-none');
            
            reader.onload = function(e) {
                imagePreview.setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });

    // 2. Remove / Reset Foto
    removeBtn.addEventListener('click', function() {
        fileInput.value = '';
        placeholder.classList.remove('d-none');
        previewContainer.classList.add('d-none');
        imagePreview.setAttribute('src', '');
    });

    // 3. Simple Form Submission Loading
    document.getElementById('mainReportForm').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Mengirim...';
        btn.classList.add('disabled');
    });

    // 4. Drag and Drop Visual Effect
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.add('border-primary'), false);
    });
    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.remove('border-primary'), false);
    });
});
</script>