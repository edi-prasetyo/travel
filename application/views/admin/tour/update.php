<?php $setting = $this->setting_model->detail(); ?>
<div class="card mb-4">
    <div class="card-header bg-white py-3">
        <?php echo $title; ?>
    </div>
    <div class="card-body">
        <div class="text-center">
            <?php
            echo $this->session->flashdata('message');
            if (isset($errors_upload)) {
                echo '<div class="alert alert-warning">' . $errors_upload . '</div>';
            }
            ?>
        </div>
        <?php echo form_open_multipart('admin/tour/update/' . $tour->id,  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Judul <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="tour_title" placeholder="Judul" value="<?php echo $tour->tour_title; ?>" required>
                <div class="invalid-feedback">Judul Harus Di isi</div>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Harga <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="tour_price" placeholder="Harga" value="<?php echo $tour->tour_price; ?>">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Durasi <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="tour_duration" placeholder="Durasi" value="<?php echo $tour->tour_duration; ?>">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Status <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <select name="tour_status" class="form-control custom-select" required>
                    <option value="">Pilih Status</option>
                    <option value="1" <?php if ($tour->tour_status == 1) {
                                            echo "selected";
                                        } ?>>active</option>
                    <option value="0" <?php if ($tour->tour_status == 0) {
                                            echo "selected";
                                        } ?>>inactive</option>
                </select>
                <div class="invalid-feedback">Silahkan pilih status tour</div>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" name="tour_image">
                    <div class="invalid-feedback">Silahkan pilih image</div>
                    <div class="col-md-6 my-3">
                        <img class="img-fluid" src="<?php echo base_url('assets/img/tour/' . $tour->tour_image); ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Plan <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <textarea class="form-control" id="summernote5" name="tour_plan" placeholder="Plan" required><?php echo $tour->tour_plan; ?></textarea>
                <div class="invalid-feedback">Silahkan Isi Deskripsi Tour Plan</div>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Fasilitas <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <textarea id="summernote3" class="form-control" name="tour_facility" placeholder="Facility"><?php echo $tour->tour_facility; ?></textarea>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Deskripsi <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <textarea class="form-control" id="summernote" name="tour_description" placeholder="Deskripsi" required><?php echo $tour->tour_description; ?></textarea>
                <div class="invalid-feedback">Silahkan Isi Deskripsi Berita</div>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Keywords
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="tour_keywords" placeholder="Pisahkan dengan koma" value="<?php echo $tour->tour_keywords; ?>">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Meta Deskripsi <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <textarea class="form-control" name="meta_description" placeholder="Deskripsi" required><?php echo $tour->meta_description; ?></textarea>
                <div class="invalid-feedback">Silahkan Isi Meta Deskripsi</div>
            </div>
        </div>
        <?php if ($setting->language == 1) : ?>
            <hr>
            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Tour Title (EN) <span class="text-danger">*</span>
                </label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="tour_title_en" placeholder="Tour Title" value="<?php echo $tour->tour_title_en; ?>">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Tour Facility (EN) <span class="text-danger">*</span>
                </label>
                <div class="col-lg-9">
                    <textarea id="summernote4" class="form-control" name="tour_facility_en" placeholder="Facility"><?php echo $tour->tour_facility_en; ?></textarea>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Tour Description (EN) <span class="text-danger">*</span>
                </label>
                <div class="col-lg-9">

                    <textarea class="form-control" id="summernote2" name="tour_description_en" placeholder="Deskripsi"><?php echo $tour->tour_description_en; ?></textarea>
                    <div class="invalid-feedback">Silahkan Isi Deskripsi Berita</div>
                </div>
            </div>
        <?php else : ?>
        <?php endif; ?>
        <div class="form-group row mb-3">
            <div class="col-lg-3"></div>
            <div class="col-lg-9">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Update
                </button>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>