<div class="card">
    <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
        <h4><?php echo $title; ?></h4>
        <a href="<?php echo base_url('admin/service/create'); ?>" class="btn btn-outline-white">Tambah Layanan</a>
    </div>
    <?php
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
    }
    ?>
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Layanan</th>
                    <th>Warna Icon</th>
                    <th>Icon</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($service as $data) : ?>
                    <tr>
                        <td class="text-info"><?php echo $no; ?></td>
                        <td><?php echo $data->service_name_id; ?></td>
                        <td>
                            <div style="color:<?php echo $data->service_color; ?>"> <i class="ri-focus-fill"></i></div>
                        </td>
                        <td><?php echo $data->service_icon; ?></td>
                        <td>
                            <a href="<?php echo base_url('admin/service/update/' . $data->id); ?>" class="btn btn-sm btn-success text-white"><i class="ti-edit"></i> Edit</a>
                            <?php include "delete.php"; ?>
                        </td>
                    </tr>
                <?php $no++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>