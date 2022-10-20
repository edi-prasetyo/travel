<?php $meta = $this->meta_model->get_meta(); ?>
<div class="breadcrumb">
    <div class="container">
        <ul class="breadcrumb my-3">
            <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>
<div class="container mb-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <h2>
                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                            Contact Us
                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                            Hubungi Kami
                        <?php else : ?>
                            Hubungi Kami
                        <?php endif; ?>
                    </h2>
                    <p>
                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                            For information and reservations, please contact us via
                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                            Untuk Informasi dan Pemesanan Silahkan Hubungi Kami melalui
                        <?php else : ?>
                            Untuk Informasi dan Pemesanan Silahkan Hubungi Kami melalui
                        <?php endif; ?>
                    </p>
                    <p><i class="fa fa-home"></i> <?php echo $meta->alamat; ?></p>
                    <p><i class="fa fa-phone"></i> <?php echo $meta->telepon; ?></p>
                    <a class="btn btn-success text-white" href="https://wa.me/<?php echo $meta->whatsapp; ?>"><i class="fab fa-whatsapp"></i> Chat Whatsapp</a>

                </div>
                <div class="col-md-7">
                    <?php echo $meta->map; ?>
                </div>
            </div>
        </div>
    </div>
</div>