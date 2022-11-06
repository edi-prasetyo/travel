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
        <?php if ($tour == null) : ?>
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4>
                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                Sorry, there is no schedule for the date
                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                Maaf Belum Ada Jadwal Untuk tanggal
                            <?php else : ?>
                                Maaf Belum Ada Jadwal Untuk tanggal
                            <?php endif; ?>
                            <?php echo date("d F Y", strtotime($start_date)); ?></h4>
                        <p>
                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                Please find another date
                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                Silahkan Cari Tanggal Yang Lain
                            <?php else : ?>
                                Silahkan Cari Tanggal Yang Lain
                            <?php endif; ?>
                        </p>

                        <?php echo form_open('open_trip', array('method' => 'get', 'class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
                        <div class="row">
                            <div class="col-md-8">

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="start_date" placeholder="Tanggal" aria-label="Tanggal" id="startDate">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary" name="submit">
                                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                                Search Trip
                                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                                Cari Trip
                                            <?php else : ?>
                                                Cari Trip
                                            <?php endif; ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="col-md-12">
                <div class="row">
                    <?php foreach ($tour as $tour) : ?>
                        <div class="col-md-3 col-12">
                            <div class="card shadow border-0 my-3">
                                <div class="img-frame">
                                    <img src="<?php echo base_url('assets/img/tour/thumbs/' . $tour->tour_image); ?>" alt="">
                                </div>
                                <div class="card-body text-center">
                                    <h2 class="card-title">
                                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                                            <?php echo $tour->tour_title_en; ?>
                                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                            <?php echo $tour->tour_title; ?>
                                        <?php else : ?>
                                            <?php echo $tour->tour_title; ?>
                                        <?php endif; ?>
                                    </h2>
                                    <small>
                                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                                            Start From
                                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                            Harga Mulai
                                        <?php else : ?>
                                            Harga Mulai
                                        <?php endif; ?>
                                    </small>
                                    <h3 class="fw-bold">
                                        IDR. <?php echo number_format($tour->tour_price, 0, ",", "."); ?>
                                    </h3>
                                    <a href="<?php echo base_url('tour/detail/' . $tour->tour_slug); ?>" class="btn btn-primary text-white">
                                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                                            View Schedule
                                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                            Lihat Jadwal
                                        <?php else : ?>
                                            Lihat Jadwal
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="card-footer bg-white d-flex justify-content-between align-items-start">
                                    <span><i class="fa-solid fa-calendar-day"></i> <?php echo $tour->tour_duration; ?></span>
                                    <span><i class="fa-regular fa-heart"></i> <?php echo $tour->tour_views; ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="pagination col-md-12 text-center">
                <?php if (isset($pagination)) {
                    echo $pagination;
                } ?>
            </div>
        <?php endif; ?>
    </div>
</div>