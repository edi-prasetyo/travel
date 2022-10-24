<?php $setting = $this->setting_model->detail();
$term = $this->homepage_model->get_homepage();

?>
<div class="breadcrumb pt-5">
    <div class="container">
        <ul class="breadcrumb my-auto">
            <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>" class="text-muted"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item text-muted active"><?php echo $title ?></li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow border-0">
                        <div class="card-header bg-white">
                            Detail Produk
                        </div>
                        <img src="<?php echo base_url('assets/img/artikel/' . $tour->tour_image); ?>" alt="">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php if ($this->session->userdata('language') == 'EN') : ?>
                                    <?php echo $tour->tour_title_en; ?>
                                <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                    <?php echo $tour->tour_title; ?>
                                <?php else : ?>
                                    <?php echo $tour->tour_title; ?>
                                <?php endif; ?>
                            </h5>
                            <i class="feather-calendar mr-3  fa-fw"></i> <?php echo date('j M Y', strtotime("$tour->schedule_date")); ?>
                            <h2>IDR. <?php echo number_format($tour->schedule_price, 0, ",", "."); ?>/pack</h2>
                            <p class="card-text"> <?php if ($this->session->userdata('language') == 'EN') : ?>
                                    <?php echo substr($tour->tour_description_en, 0, 95); ?>
                                <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                    <?php echo substr($tour->tour_description, 0, 95); ?>
                                <?php else : ?>
                                    <?php echo substr($tour->tour_description, 0, 95); ?>
                                <?php endif; ?> </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header bg-white">
                            Detail Pemesan
                        </div>
                        <div class="card-body">
                            <?php echo form_open_multipart('order/create',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
                            <input type="hidden" name="tour_id" value="<?php echo $tour->tour_id; ?>">
                            <input type="hidden" name="tour_title" value="<?php echo $tour->tour_title; ?>">
                            <input type="hidden" name="price" value="<?php echo $tour->schedule_price; ?>">
                            <input type="hidden" name="tour_date" value="<?php echo $tour->schedule_date; ?>">
                            <input type="hidden" name="schedule_id" value="<?php echo $tour->id; ?>">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="payment" value="<?php if ($setting->payment_gateway == 0) {
                                                                            echo "manual";
                                                                        } else {
                                                                            echo "transfer";
                                                                        } ?>">
                            <div class="form-group mb-3">
                                <label for="basic-url" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="fullname" required>
                                <div class="invalid-feedback">Silahkan masukan nama</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="basic-url" class="form-label">Nomor Whatsapp</label>
                                <input type="text" class="form-control" name="phone" required>
                                <div class="invalid-feedback">Silahkan masukan Nomor Whatsapp</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="basic-url" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" required>
                                <div class="invalid-feedback">Silahkan masukan email</div>
                            </div>
                            <div class="col-md-12">
                                <label for="basic-url" class="form-label">Alamat</label>
                                <div class="input-group mb-3">
                                    <textarea class="form-control" name="address" required></textarea>
                                    <div class="invalid-feedback">Silahkan masukan Alamat Lengkap</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <h4>Syarat dan Ketentuan</h4>
                                    <?php echo $term->term_id; ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Proses Checkout</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>