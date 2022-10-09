<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#Edit<?php echo $data->id; ?>">
    <i class="fa fa-edit"></i> Edit
</button>
<div class="modal modal-default fade" id="Edit<?php echo $data->id ?>">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Jadwal</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php echo form_open('admin/tour/update_schedule/' . $data->id,   array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="text" class="form-control" name="schedule_date" value="<?php echo $data->schedule_date ?>" readonly>
                            <div class="invalid-feedback">Silahkan masukan Harga</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" class="form-control" name="schedule_price" value="<?php echo $data->schedule_price ?>" required>
                            <div class="invalid-feedback">Silahkan masukan Harga</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="text" class="form-control" name="schedule_stock" value="<?php echo $data->schedule_stock ?>" required>
                            <div class="invalid-feedback">Silahkan masukan Harga</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="schedule_status" class="form-control form-control-chosen">
                                <option value="1" <?php if ($data->schedule_status == 1) {
                                                        echo "selected";
                                                    } ?>>Aktif</option>
                                <option value="0" <?php if ($data->schedule_status == 0) {
                                                        echo "selected";
                                                    } ?>>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="text-white">Status</label>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block" name="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>