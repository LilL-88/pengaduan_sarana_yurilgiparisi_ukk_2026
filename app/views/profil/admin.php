<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm mt-4" style="border-radius: 20px;">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($data['admin_name']); ?>&size=128&background=3b82f6&color=fff" 
                             class="rounded-circle shadow-sm border border-4 border-white" width="120">
                    </div>
                    <h3 class="fw-bold mb-1"><?php echo $data['admin_name']; ?></h3>
                    <p class="text-muted text-uppercase mb-4" style="letter-spacing: 2px; font-size: 10px;">
                        <span class="badge bg-primary px-3 py-2 rounded-pill"><?php echo $data['role']; ?> system</span>
                    </p>
                    
                    <hr class="my-4" style="opacity: 0.1;">
                    
                    <div class="text-start mb-4">
                        <label class="small text-muted mb-1">username admin</label>
                        <div class="p-3 bg-light rounded-3 fw-bold">
                            <i class="bi bi-person-circle me-2 text-primary"></i> <?php echo $data['admin_name']; ?>
                        </div>
                    </div>

                    <div class="alert alert-info border-0 rounded-3 small">
                        <i class="bi bi-info-circle-fill me-2"></i> 
                        akun ini memiliki hak akses penuh untuk mengelola laporan pengaduan sarana sekolah.
                    </div>

                    <a href="<?php echo baseurl; ?>/index.php?url=aspirasi/admin" class="btn btn-outline-secondary w-100 rounded-pill mt-2">
                        kembali ke dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>