<button type="button" class="btn btn-outline-white" data-bs-toggle="modal" data-bs-target="#Tambah">
    <i class="fa fa-plus"></i> Tambah Baru
</button>
<div class="modal modal-default fade" id="Tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <?php echo form_open('admin/category',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control" name="category_name" placeholder="Nama Kategori" required>
                    <div class="invalid-feedback">Silahkan masukan nama Kategori</div>
                </div>
                <div class="form-group mb-3">
                    <label>Category name (En)</label>
                    <input type="text" class="form-control" name="category_name_en" placeholder="Category Name" required>
                    <div class="invalid-feedback">Please Fill Category Name</div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>