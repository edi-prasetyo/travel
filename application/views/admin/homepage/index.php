<div class="row mt-6">
    <div class="offset-xl-2 col-xl-8 offset-lg-1 col-lg-10 col-md-12
              col-12">
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
        <div class="row">
            <div class="col-12 mb-6">
                <div class="card">
                    <div class="card-header p-4 bg-white">
                        <h4 class="mb-0">Background Header</h4>
                    </div>
                    <div class="card-body">
                        <?php echo form_open_multipart('admin/homepage/image_hero/' . $homepage->id); ?>
                        <div class="form-group row">
                            <label class="col-md-3 text-end">Ubah Background</label>
                            <div class="col-md-6">
                                <input type="file" name="hero_img">
                                <img src="<?php echo base_url('assets/img/galery/' . $homepage->hero_img); ?>" class="img-fluid mt-2">
                                <div class="invalid-feedback">Silahkan Pilih Gambar.</div>

                                <button type="submit" class="btn btn-primary mt-3">Upload</button>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                        <hr>
                        <?php echo form_open('admin/homepage/hero_content/' . $homepage->id); ?>
                        <div class="form-group row mb-2">
                            <label class="col-md-4 text-end">Judul Indonesia</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="hero_title_id" value="<?php echo $homepage->hero_title_id; ?>" required>
                                <div class="invalid-feedback">Silahkan Masukan Text.</div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-md-4 text-end">Judul Inggris</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="hero_title_en" value="<?php echo $homepage->hero_title_en; ?>" required>
                                <div class="invalid-feedback">Silahkan Pilih Gambar.</div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-md-4 text-end">Tombol Indonesia</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="hero_button_id" value="<?php echo $homepage->hero_button_id; ?>" required>
                                <div class="invalid-feedback">Silahkan Masukan Text.</div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-md-4 text-end">Tombol Inggris</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="hero_button_en" value="<?php echo $homepage->hero_button_en; ?>" required>
                                <div class="invalid-feedback">Silahkan Masukan Text.</div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-md-4 text-end">Url</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="hero_url" value="<?php echo $homepage->hero_url; ?>" required>
                                <div class="invalid-feedback">Silahkan Masukan Url Link.</div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-md-4 text-end"></label>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header p-4 bg-white">
                        <h4 class="mb-0">Layanan</h4>
                    </div>
                    <div class="card-body">
                        <?php echo form_open('admin/homepage/service/' . $homepage->id); ?>
                        <div class="form-group row mb-2">
                            <label class="col-md-4 text-end">Judul Layanan ( ID )</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="service_title_id" value="<?php echo $homepage->service_title_id; ?>" required>
                                <div class="invalid-feedback">Silahkan Masukan Text.</div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-md-4 text-end">Service Title ( EN )</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="service_title_en" value="<?php echo $homepage->service_title_en; ?>" required>
                                <div class="invalid-feedback">Silahkan Pilih Gambar.</div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-md-4 text-end">Deskripsi Layanan ( ID ) </label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="service_desc_id" required><?php echo $homepage->service_desc_id; ?></textarea>
                                <div class="invalid-feedback">Silahkan Masukan Text.</div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-md-4 text-end">Service Description ( EN )</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="service_desc_en" required><?php echo $homepage->service_desc_en; ?></textarea>
                                <div class="invalid-feedback">Silahkan Masukan Text.</div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-md-4 text-end"></label>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header p-4 bg-white">
                        <h4 class="mb-0">Syarat dan ketentuan</h4>
                    </div>
                    <div class="card-body">
                        <?php echo form_open('admin/homepage/term/' . $homepage->id); ?>
                        <div class="form-group row mb-2">
                            <label class="col-md-4 text-end">Deskripsi Layanan ( ID ) </label>
                            <div class="col-md-8">
                                <textarea id="summernote" class="form-control" name="term_id" required><?php echo $homepage->term_id; ?></textarea>
                                <div class="invalid-feedback">Silahkan Masukan Text.</div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-md-4 text-end">Service Description ( EN )</label>
                            <div class="col-md-8">
                                <textarea id="summernote2" class="form-control" name="term_en" required><?php echo $homepage->term_en; ?></textarea>
                                <div class="invalid-feedback">Silahkan Masukan Text.</div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-md-4 text-end"></label>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>