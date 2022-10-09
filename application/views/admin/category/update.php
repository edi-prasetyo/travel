<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#Edit<?php echo $data->id; ?>">
    <i class="fa fa-edit"></i> Edit
</button>

<div class="modal modal-default fade" id="Edit<?php echo $data->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <?php echo form_open('admin/category/update/' . $data->id,   array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control" name="category_name" value="<?php echo $data->category_name ?>" required>
                    <div class="invalid-feedback">Silahkan masukan nama Kategori</div>
                </div>
                <div class="form-group">
                    <label>Category Name (En)</label>
                    <input type="text" class="form-control" name="category_name_en" value="<?php echo $data->category_name_en ?>" required>
                    <div class="invalid-feedback">Please Fill Category Name</div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" name="submit" value="Update Data">
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->