<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Tambah">
    <i class="fa fa-plus"></i> Tambah Baru
</button>

<div class="modal modal-default fade" id="Tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Paket</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url('admin/mobil/paket/' . $id_mobil)); ?>
                <div class="form-group">
                    <label>Nama Paket</label>
                    <input type="text" class="form-control" name="paket_name" placeholder="Nama Paket" required="required">
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" class="form-control" name="paket_price" placeholder="Harga" required="required">
                </div>
                <div class="form-group">
                    <label>Syarat & Ketentuan</label>
                    <select name="ketentuan_id" class="form-control form-control-chosen">
                        <option value="">Pilih Ketentuan</option>
                        <?php foreach ($ketentuan as $ketentuan) { ?>
                            <option value="<?php echo $ketentuan->id ?>">
                                <?php echo $ketentuan->ketentuan_name ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary pull-right" data-bs-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>