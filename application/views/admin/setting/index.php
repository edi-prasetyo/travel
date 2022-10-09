<?php
//Error warning
echo validation_errors('<div class="alert alert-warning">', '</div>');
//Error Upload Gabar
if (isset($error_upload)) {
    echo '<div class="alert alert-warning">' . $error_upload . '</div>';
}
if ($this->session->flashdata('message')) {
    echo $this->session->flashdata('message');
    unset($_SESSION['message']);
}
?>
<section class="p-5 my-5">
    <div class="row">
        <div class="row mb-8">
            <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                <div class="mb-4 mb-lg-0">
                    <h4 class="mb-1">General Setting</h4>
                    <p class="mb-0 fs-5 text-muted">Profile configuration settings </p>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class=" mb-6">
                            <h4 class="mb-1">General Settings</h4>
                        </div>
                        <div class="mb-3 row">
                            <label for="addressLine" class="col-sm-4 col-form-label form-label">Language</label>
                            <div class="col-md-4 col-12">
                                <div class="d-grid gap-2">
                                    <?php if ($setting->language == 0) : ?>
                                        <div class="alert alert-danger">Inactive</div>
                                        <a href="<?php echo base_url('admin/setting/language_active'); ?>" class="btn btn-primary text-white">Active</a>
                                    <?php else : ?>
                                        <div class="alert alert-success">Active</div>
                                        <a href="<?php echo base_url('admin/setting/language_inactive'); ?>" class="btn btn-danger text-white">Inactive</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-12 col-12 my-3">
                <div class="mb-4 mb-lg-0">
                    <h4 class="mb-1">Payment Gateway</h4>
                    <p class="mb-0 fs-5 text-muted">Setting Payment Gateway </p>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12 col-12 my-3">
                <div class="card">
                    <div class="card-body">
                        <div class=" mb-6">
                            <h4 class="mb-1">Api Settings</h4>
                        </div>
                        <div class="mb-3 row">
                            <label for="addressLine" class="col-sm-4 col-form-label form-label">Payment Gateway</label>
                            <div class="col-md-8 col-12">
                                <div class="d-grid gap-2">
                                    <?php if ($setting->payment_gateway == 0) : ?>
                                        <div class="alert alert-danger">Inactive</div>
                                        <a href="<?php echo base_url('admin/setting/payment_active'); ?>" class="btn btn-primary text-white">Active</a>
                                    <?php else : ?>
                                        <div class="alert alert-success">Active</div>
                                        <a href="<?php echo base_url('admin/setting/payment_inactive'); ?>" class="btn btn-danger text-white">Inactive</a>
                                        <?php echo form_open('admin/setting/payment_gateway/'); ?>
                                        <div class="form-group row mb-3">
                                            <label class="col-lg-4 col-form-label">Environment <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <select name="midtrans_environment" class="form-control custom-select" required>
                                                    <option value="">Pilih Environment</option>
                                                    <option value="true" <?php if ($setting->midtrans_environment == 'false') {
                                                                                echo "selected";
                                                                            } ?>>Production</option>
                                                    <option value="" <?php if ($setting->midtrans_environment == '') {
                                                                            echo "selected";
                                                                        } ?>>Sandbox</option>
                                                </select>
                                                <div class="invalid-feedback">Silahkan pilih status tour</div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="addressLine" class="col-sm-4 col-form-label form-label">Server Key</label>
                                            <div class="col-md-8 col-12">
                                                <input type="text" class="form-control" name="midtrans_server_key" value="<?php echo $setting->midtrans_server_key; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="addressLine" class="col-sm-4 col-form-label form-label">Client Key</label>
                                            <div class="col-md-8 col-12">
                                                <input type="text" class="form-control" name="midtrans_client_key" value="<?php echo $setting->midtrans_client_key; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="addressLineTwo" class="col-sm-4 col-form-label form-label"></label>
                                            <div class="col-md-8 col-12">
                                                <button type="submit" class="btn btn-primary text-white btn-block">
                                                    <i class="fa fa-save"></i> Update
                                                </button>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>