<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Delete<?php
                                                                                                    echo $data->id ?>">
    <i class="ti-trash"></i> Hapus
</button>
<div class="modal fade" id="Delete<?php echo $data->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"> Menghapus Data</h6>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda Yakin Ingin Menghapus Data <b><?php echo $data->schedule_date ?></b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left" data-bs-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                <a href="<?php echo base_url('admin/mobil/delete_paket/' . $data->id) ?>" class="btn btn-danger pull-right"><i class="fa fa-close"></i> Ya, Hapus Artikel</a>
            </div>
        </div>
    </div>
</div>