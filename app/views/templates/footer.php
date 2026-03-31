</div> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Logika untuk memunculkan Toast otomatis jika ada parameter 'msg' di URL
        window.addEventListener('DOMContentLoaded', event => {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('msg') === 'success') {
                const toastEl = document.getElementById('liveToast');
                if (toastEl) {
                    // Jika pesan di admin.php belum terisi, kita isi manual
                    const toastMsg = document.getElementById('toastMessage');
                    if (toastMsg && toastMsg.textContent.trim() === "") {
                        toastMsg.textContent = "Data berhasil diperbarui!";
                    }
                    const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
                    toast.show();
                }
            }
        });

        console.log("Sistem E-SARPRAS Berhasil Dimuat");
    </script>
</body>
</html>