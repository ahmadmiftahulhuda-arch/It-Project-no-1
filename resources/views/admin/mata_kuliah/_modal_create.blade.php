<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Mata Kuliah Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('mata_kuliah.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="create_nama" class="form-label">Nama Mata Kuliah</label>
                        <input type="text" id="create_nama" name="nama" class="form-control" placeholder="Contoh: Pemrograman Web Lanjut" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="create_kode" class="form-label">Kode</label>
                            <input type="text" id="create_kode" name="kode" class="form-control" placeholder="Contoh: IF202" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="create_semester" class="form-label">Semester</label>
                            <input type="number" id="create_semester" name="semester" class="form-control" placeholder="Contoh: 3" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
