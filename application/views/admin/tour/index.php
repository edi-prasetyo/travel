<div class="card">
    <div class="card-header bg-white d-flex flex-row align-items-center justify-content-between">
        <?php echo $title; ?>
        <a href="<?php echo base_url('admin/tour/create'); ?>" class="btn btn-outline-white">Buat Data</a>
    </div>
    <?php
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
    }
    ?>
    <div class="table-responsive">
        <table class="table table-flush">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Jadwal</th>
                    <th>Views</th>
                    <th width="25%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($tour as $data) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data->tour_title; ?><br><i><?php echo $data->tour_title_en; ?></i></td>
                    <td><a href="<?php echo base_url('admin/tour/schedule/' . $data->id); ?>" class="btn btn-primary btn-sm text-white"><i class="ti-plus"></i> Tambah Jadwal</a> </td>
                    <td><?php echo $data->tour_views; ?></td>
                    <td>
                        <a href="<?php echo base_url('tour/detail/' . $data->tour_slug); ?>" class="btn btn-primary btn-sm text-white"><i class="ti-eye"></i> Lihat</a>
                        <a href="<?php echo base_url('admin/tour/update/' . $data->id); ?>" class="btn btn-success btn-sm text-white"><i class="ti-pencil-alt"></i> Edit</a>
                        <?php include "delete.php"; ?>
                    </td>
                </tr>
            <?php $no++;
            }; ?>
        </table>
        <div class="pagination col-md-12 text-center">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>
    </div>
</div>