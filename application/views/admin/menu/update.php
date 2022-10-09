<div class="col-md-7 mx-auto">
    <div class="card mb-4">
        <div class="card-header">
            <?php echo $title; ?>
        </div>
        <div class="card-body">
            <div class="text-center">
                <?php echo $this->session->flashdata('message'); ?>
            </div>
            <?php echo form_open('admin/menu/update/' . $menu->id); ?>
            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Nama Menu (ID) <span class="text-danger">*</span>
                </label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="name_id" value="<?php echo $menu->name_id; ?>">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Menu Name (EN) <span class="text-danger">*</span>
                </label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="name_en" value="<?php echo $menu->name_en; ?>">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Url <span class="text-danger">*</span>
                </label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="url" value="<?php echo $menu->url; ?>">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Urutan <span class="text-danger">*</span>
                </label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="urutan" value="<?php echo $menu->urutan; ?>">
                </div>
            </div>
            <div class="form-group row mb-3">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Update Menu
                    </button>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>