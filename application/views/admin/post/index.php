<div class="card">
    <div class="card-header bg-white d-flex flex-row align-items-center justify-content-between">
        <h4><?php echo $title; ?></h4>
        <a href="<?php echo base_url('admin/post/create'); ?>" class="btn btn-outline-white">Buat Post</a>
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
                    <th>Judul Berita</th>
                    <th>Kategori</th>
                    <th>Posted by</th>
                    <th>Views</th>
                    <th width="25%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($post as $data) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data->post_title; ?><br><i><?php echo $data->post_title_en; ?></i></td>
                    <td><?php echo $data->category_name; ?></td>
                    <td><?php echo $data->user_name; ?></td>
                    <td><?php echo $data->post_views; ?></td>
                    <td>
                        <a href="<?php echo base_url('post/detail/' . $data->post_slug); ?>" class="btn btn-primary btn-sm text-white"><i class="ti-eye"></i> Lihat</a>
                        <a href="<?php echo base_url('admin/post/update/' . $data->id); ?>" class="btn btn-success btn-sm text-white"><i class="ti-pencil-alt"></i> Edit</a>
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