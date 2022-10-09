<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Delete<?php
                                                                                                    echo $data->id ?>">
    <i class="fa fa-close"></i> Hapus
</button>
<div class="modal fade" id="Delete<?php echo $data->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Menghapus Data</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-close"></i></span></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda Yakin Ingin Menghapus Menu <b><?php echo $data->name_id ?></b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left text-white" data-bs-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                <a href="<?php echo base_url('admin/menu/delete/' . $data->id) ?>" class="btn btn-danger pull-right text-white"><i class="fa fa-close"></i> Ya, Hapus Artikel</a>
            </div>
        </div>
    </div>
</div>