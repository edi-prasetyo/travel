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
                        <div class="card-header">
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
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Detail Pemesan
                        </div>
                        <div class="card-body">
                            <?php echo form_open('order/create'); ?>
                            <input type="hidden" name="tour_id" value="<?php echo $tour->tour_id; ?>">
                            <input type="hidden" name="tour_title" value="<?php echo $tour->tour_title; ?>">
                            <input type="hidden" name="price" value="<?php echo $tour->schedule_price; ?>">
                            <input type="hidden" name="tour_date" value="<?php echo $tour->schedule_date; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="basic-url" class="form-label">Nama Lengkap</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon3"><i class="feather-user"></i></span>
                                        <input type="text" class="form-control" name="fullname" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="basic-url" class="form-label">Nomor Whatsapp</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon3"><i class="feather-phone"></i></span>
                                        <input type="text" class="form-control" name="phone" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="basic-url" class="form-label">Email</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon3"><i class="feather-mail"></i></span>
                                        <input type="text" class="form-control" name="email" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="basic-url" class="form-label">Jumlah Tiket</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon3"><i class="feather-tag"></i></span>
                                        <input type="text" class="form-control" name="quantity">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="basic-url" class="form-label">Alamat</label>
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" name="address"></textarea>
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