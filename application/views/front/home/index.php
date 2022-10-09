<?php $meta = $this->meta_model->get_meta(); ?>
<section>
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner bg-dark" style="min-height: 450px; background-size: cover; background-image: linear-gradient(rgba(0,0,0,.7), rgba(0,0,0,1.9)), url(<?php echo base_url('assets/img/galery/' . $homepage->hero_img); ?>);background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">

            <?php $i = 1;
            foreach ($popular_tour as $popular_tour) : ?>
                <div class="carousel-item <?php if ($i == 1) {
                                                echo 'active';
                                            } ?>">
                    <div class="container">
                        <div class="row gx-5 align-items-center justify-content-center col-10 mx-auto">
                            <div class="col-md-9 col-xl-7 col-xxl-6">
                                <div class="my-5 text-center text-xl-start">
                                    <h1 class="display-5 fw-bolder text-white mb-2">
                                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                                            <?php echo $popular_tour->tour_title_en; ?>
                                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                            <?php echo $popular_tour->tour_title; ?>
                                        <?php else : ?>
                                            <?php echo $popular_tour->tour_title; ?>
                                        <?php endif; ?>
                                    </h1>
                                    <p class="lead fw-normal text-white mb-4">
                                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                                            <?php echo substr($popular_tour->tour_description_en, 0, 95); ?>...
                                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                            <?php echo substr($popular_tour->tour_description, 0, 95); ?>...
                                        <?php else : ?>
                                            <?php echo substr($popular_tour->tour_description, 0, 95); ?>...
                                        <?php endif; ?>
                                    </p>
                                    <div class="text-white text-sm">
                                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                                            Start From
                                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                            Harga Mulai
                                        <?php else : ?>
                                            Harga Mulai
                                        <?php endif; ?>
                                    </div>
                                    <span class="display-4 fw-bold text-white"> IDR <?php echo number_format($popular_tour->tour_price, 0, ",", "."); ?></span><span class="text-warning">/pack</span>
                                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                                        <a class="btn btn-primary btn-lg px-4 me-sm-3 text-white mt-2" href="<?php echo base_url('tour/detail/' . $popular_tour->tour_slug); ?>">
                                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                                View Schedule
                                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                                Lihat Jadwal
                                            <?php else : ?>
                                                Lihat Jadwal
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                                <div class="img-slide">
                                    <img class="img-fluid rounded-3 my-5" src="<?php echo base_url('assets/img/tour/thumbs/' . $popular_tour->tour_image) ?>" alt="<?php echo $popular_tour->tour_title; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++;
            endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<section class="form-pencarian bg-none" style="margin-top:-60px;">
    <div class="container">
        <div class="card shadow border-0 col-md-10 mx-auto">
            <div class="card-header bg-white">
                <h4><i class="fa-solid fa-umbrella-beach me-5"></i>
                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                        Find Tour Schedule
                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                        Cari Jadwal Wisata
                    <?php else : ?>
                        Cari Jadwal Wisata
                    <?php endif; ?>
                </h4>
            </div>
            <div class="card-body">
                <?php echo form_open('open_trip', array('method' => 'get', 'class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="start_date" placeholder="Tanggal" aria-label="Tanggal" id="startDate">
                            <span class="input-group-text bg-white"><i class="feather feather-calendar"></i></span>
                            <input type="text" class="form-control" name="end_date" placeholder="Tanggal" aria-label="Tanggal" id="endDate">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" name="submit">Cari Trip</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>
<section class="py-5 my-5">
    <div class="container">
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
                        <div class="card-footer bg-white">
                            <div class="row">
                                <div class="col-6">
                                    <i class="fa-solid fa-calendar-day"></i> <?php echo $tour->tour_duration; ?>
                                </div>
                                <div class="col-6 text-end">
                                    <i class="fa-regular fa-heart"></i> <?php echo $tour->tour_views; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="py-5 bg-light border-top shadow-sm" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-3 mb-5 mb-lg-0">
                <h2 class="mb-0 display-2 fw-bold">
                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                        <?php echo $homepage->service_title_en; ?>
                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                        <?php echo $homepage->service_title_id; ?>
                    <?php else : ?>
                        <?php echo $homepage->service_title_id; ?>
                    <?php endif; ?>
                </h2>
                <p class="lead">
                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                        <?php echo $homepage->service_desc_en; ?>
                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                        <?php echo $homepage->service_desc_id; ?>
                    <?php else : ?>
                        <?php echo $homepage->service_desc_id; ?>
                    <?php endif; ?>
                </p>
            </div>
            <div class="col-lg-9">
                <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                    <?php foreach ($service as $service) : ?>
                        <div class="col-md-4">
                            <div class="card text-center shadow my-3">
                                <div class="card-image-overflow rounded bg-light-primary text-center py-4">
                                    <span class="display-6 p-5 text-primary"> <?php echo $service->service_icon; ?></span>
                                </div>
                                <div class="card-body">
                                    <h3 class="fw-bold">
                                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                                            <?php echo $service->service_name_en; ?>
                                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                            <?php echo $service->service_name_id; ?>
                                        <?php else : ?>
                                            <?php echo $service->service_name_id; ?>
                                        <?php endif; ?>
                                    </h3>
                                    <p>
                                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                                            <?php echo $service->service_desc_en; ?>
                                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                            <?php echo $service->service_desc_id; ?>
                                        <?php else : ?>
                                            <?php echo $service->service_desc_id; ?>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="my-5 mt-5">
    <div class="container">
        <h2 class="display-4 fw-bold text-center pt-5">
            <?php if ($this->session->userdata('language') == 'EN') : ?>
                Latest Articles
            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                Artikel Terbaru
            <?php else : ?>
                Artikel Terbaru
            <?php endif; ?>
        </h2>
        <p class="text-center">
            <?php if ($this->session->userdata('language') == 'EN') : ?>
                Collection of Articles and Travel reviews
            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                Kumpulan Artikel dan review Wisata
            <?php else : ?>
                Kumpulan Artikel dan review Wisata
            <?php endif; ?>
        </p>
        <div class="row my-5 pt-5">
            <?php foreach ($post as $post) : ?>
                <div class="col-md-4 col-12">
                    <div class="card shadow border-0 my-5">
                        <div class="card-image-thumb">
                            <div class="img-frame">
                                <img src="<?php echo base_url('assets/img/post/' . $post->post_image); ?>" alt="">
                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="card-title">
                                <?php if ($this->session->userdata('language') == 'EN') : ?>
                                    <?php echo $post->post_title_en; ?>
                                <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                    <?php echo $post->post_title; ?>
                                <?php else : ?>
                                    <?php echo $post->post_title; ?>
                                <?php endif; ?>
                            </h2>
                            <p class="card-text">
                                <?php if ($this->session->userdata('language') == 'EN') : ?>
                                    <?php echo substr($post->post_description_en, 0, 95); ?>
                                <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                    <?php echo substr($post->post_description, 0, 95); ?>
                                <?php else : ?>
                                    <?php echo substr($post->post_description, 0, 95); ?>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="row">
                                <div class="col-6">
                                    <i class="fa-solid fa-calendar"></i> <?php echo date('j M Y', strtotime("$post->created_at")); ?>
                                </div>
                                <div class="col-6">
                                    <a href="<?php echo base_url('post/detail/' . $post->post_slug); ?>" class="btn btn-primary text-white">
                                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                                            Detail
                                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                            Selengkapnya
                                        <?php else : ?>
                                            Selengkapnya
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>