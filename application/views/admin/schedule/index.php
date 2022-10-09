<div class="col-md-12">
</div>
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <img src="<?php echo base_url('assets/img/tour/thumbs/' . $tour->tour_image) ?>" class="img-fluid">
            </div>
            <div class="col-10">
                <h2> <?php echo $tour->tour_title; ?></h2>
                <h4><?php echo $tour->tour_duration; ?> </h4>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-white">
        Jadwal
    </div>
    <div class="card-body border-bottom">
        <?php echo form_open(base_url('admin/tour/schedule/' . $tour_id)); ?>
        <div class="row">
            <?php
            if ($this->session->flashdata('message')) {
                echo $this->session->flashdata('message');
                unset($_SESSION['message']);
            }
            ?>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" class="form-control" name="schedule_date" id="getDate" placeholder="Tanggal">
                    <?php echo form_error('schedule_date', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" class="form-control" name="schedule_price" placeholder="Harga">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Stock</label>
                    <input type="text" class="form-control" name="schedule_stock" placeholder="Stok">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Status</label>
                    <select name="schedule_status" class="form-control form-control-chosen">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <label class="text-white">Status</label>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-flush">
            <thead>
                <tr>
                    <th>Jadwal</th>
                    <th>Price</th>
                    <th>Stok</th>
                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($schedule as $data) { ?>
                    <tr>
                        <td><?php echo date('D j F Y', strtotime($data->schedule_date)); ?></td>
                        <td>Rp. <?php echo number_format($data->schedule_price, '0', ',', ','); ?></td>
                        <td><?php echo $data->schedule_stock ?>
                        <td>
                            <?php if ($data->schedule_status == 1) : ?>
                                <div class="badge bg-success">Active</div>
                            <?php else : ?>
                                <div class="badge bg-danger">Inactive</div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php include('update.php'); ?>
                            <?php include('delete.php'); ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>