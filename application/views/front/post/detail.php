<?php
$meta = $this->meta_model->get_meta();
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
$menu           = $this->menu_model->get_menu();
$link           = $this->link_model->get_link();
$menu_footer           = $this->menu_model->get_menu();
$setting        = $this->setting_model->detail();
$page           = $this->page_model->get_page();
$bank   = $this->bank_model->get_allbank();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $meta->title ?> | <?php echo $meta->tagline ?></title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo/' . $meta->favicon); ?>">
    <meta name="description" content="<?php echo $deskripsi ?>">
    <meta name="keywords" content="<?php echo $post->post_keywords; ?>">
    <meta name="author" content="<?php echo $post->user_name; ?>">
    <meta name="google-site-verification" content="<?php echo $meta->google_meta ?>" />
    <meta name="msvalidate.01" content="<?php echo $meta->bing_meta ?>" />
    <link rel="canonical" href="<?php echo base_url(); ?>" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $post->post_title; ?>" />
    <meta property="og:description" content="<?php echo $post->post_title; ?>" />
    <meta property="og:url" content="<?php echo base_url(); ?>" />
    <meta property="og:image" content="<?php echo base_url('assets/img/post/' . $post->post_image); ?>" />
    <meta property="og:site_name" content="<?php echo $meta->title; ?>" />
    <meta name="twitter:description" content="<?php echo $deskripsi; ?>" />
    <meta name="twitter:title" content="<?php echo $meta->title; ?>" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/template/web/vendor/offcanvas/offcanvas.css">
    <link href="<?php echo base_url('assets/template/web/vendor/icons/feather-icons/feather.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/template/web/vendor/icons/fontawesome/css/all.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/web/vendor/bootstrap-icons/bootstrap-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/web/vendor/flag-icon-css/css/flag-icon.min.css'); ?>">
    <link href="<?php echo base_url('assets/template/web/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/template/web/css/custom.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/web/vendor/date-time-picker-bootstrap-4/css/bootstrap-datetimepicker.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/web/vendor/fonts/poppins/styles.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white shadow-sm" aria-label="Main navigation">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img style="width:200px;" src="<?php echo base_url('assets/img/logo/' . $meta->logo); ?>"></a>
            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php foreach ($menu as $menu) : ?>
                        <li class="nav-item">
                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                <a class="nav-link" aria-current="page" href="<?php echo base_url() . $menu->url; ?>"><?php echo $menu->name_en; ?></a>
                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                <a class="nav-link" aria-current="page" href="<?php echo base_url() . $menu->url; ?>"><?php echo $menu->name_id; ?></a>
                            <?php else : ?>
                                <a class="nav-link" aria-current="page" href="<?php echo base_url() . $menu->url; ?>"><?php echo $menu->name_id; ?></a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo base_url('contact'); ?>">
                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                contact Us
                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                Hubungi Kami
                            <?php else : ?>
                                Hubungi Kami
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
                <ul class="nav">
                    <?php if ($setting->language == 1) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php if ($this->session->userdata('language') == 'EN') : ?>
                                    <i class="flag-icon flag-icon-us mr-2 border"></i> <?php echo $this->session->userdata('language', 'EN'); ?> <i class="feather-chevron-down"></i>
                                <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                    <i class="flag-icon flag-icon-id mr-2 border"></i> <?php echo $this->session->userdata('language', 'ID'); ?> <i class="feather-chevron-down"></i>
                                <?php else : ?>
                                    <i class="flag-icon flag-icon-id mr-2 border"></i> ID <i class="feather-chevron-down"></i>
                                <?php endif; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown01">
                                <li><a class="dropdown-item" href="<?php echo base_url('language/translate/ID'); ?>">Indonesia</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('language/translate/EN'); ?>">English</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('id')) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-regular fa-user"></i> <?php echo $user->user_name; ?> <i class="feather-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown01">
                                <li><a class="dropdown-item" href="<?php echo base_url('admin/dashboard') ?>"> <i class="ri-user-line"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="btn btn-primary text-white" href="<?php echo base_url('auth'); ?>">
                                <?php if ($this->session->userdata('language') == 'EN') : ?>
                                    Sign In
                                <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                    Masuk
                                <?php else : ?>
                                    Masuk
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <main class="my-5 mt-5">
        <div class="breadcrumb">
            <div class="container">
                <div class="col-md-10 mx-auto">
                    <ul class="breadcrumb my-3">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('post') ?>"> Berita</a></li>
                        <li class="breadcrumb-item active"><?php echo $title ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container mb-3">
            <div class="col-md-10 mx-auto">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2>
                                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                                        <?php echo $post->post_title_en; ?>
                                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                        <?php echo $post->post_title; ?>
                                    <?php else : ?>
                                        <?php echo $post->post_title; ?>
                                    <?php endif; ?>
                                </h2>
                            </div>
                            <img class="img-fluid" src="<?php echo base_url('assets/img/post/' . $post->post_image); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        Share <i class="fa-solid fa-square-share-nodes"></i>
                                    </div>
                                    <div class="col-md-3 col-6 my-2">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary btn-sm" onclick="_fb();" alt="facebook"><i class="fa-brands fa-facebook"></i> Facebook</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6 my-2">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-info btn-sm text-white" onclick="_twitter();" alt="twitter"><i class="fa-brands fa-twitter"></i> Twitter</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6 my-2">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-success btn-sm" onclick="_whatsapp();" alt="whatsapp"><i class="fa-brands fa-whatsapp"></i> Whatsapp</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6 my-2">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-danger btn-sm" onclick="_pinterest();" alt="pinterest"><i class="fa-brands fa-pinterest"></i> Pinterest</button>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($this->session->userdata('language') == 'EN') : ?>
                                    <?php echo $post->post_description_en; ?>
                                <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                    <?php echo $post->post_description; ?>
                                <?php else : ?>
                                    <?php echo $post->post_description; ?>
                                <?php endif; ?>
                            </div>
                            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                                <span><i class="bi-person"></i> <?php echo $post->user_name; ?></span>
                                <span><i class="bi-eye"></i> <?php echo $post->post_views; ?></span>
                                <span><i class="bi-calendar"></i><?php echo date('d/m/Y', strtotime($post->created_at)); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?php include "sidebar.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="bg-white mt-auto">
        <div class="container pt-4 pt-md-5 pb-md-5 border-top ">
            <div class="row">
                <div class="col-12 col-md-3 contact">
                    <h4 class="fw-bold">Contact</h4>
                    <i class="fa fa-phone"></i> <?php echo $meta->telepon ?><br>
                    <i class="far fa-envelope"></i> <?php echo $meta->email ?>
                </div>
                <div class="col-8 col-6 col-md footer">
                    <h4 class="fw-bold">Link</h4>
                    <ul class="list-unstyled">
                        <?php foreach ($link as $link) : ?>
                            <li> <a class="text-muted nav-item" href="<?php echo $link->link_url; ?>">
                                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                                        <?php echo $link->link_name_en; ?>
                                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                        <?php echo $link->link_name; ?>
                                    <?php else : ?>
                                        <?php echo $link->link_name; ?>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
                <div class="col-12 col-md-5">
                    <h4 class="fw-bold">Pembayaran</h4>
                    <?php if ($setting->payment_gateway == 0) : ?>
                        <?php foreach ($bank as $bank) : ?>

                            <img width="20%" class="img-fluid" src="<?php echo base_url('assets/img/bank/' . $bank->bank_logo); ?>">
                            <span class="fw-bold my-auto"><?php echo $bank->bank_number; ?></span>
                            A.n <?php echo $bank->bank_account; ?><br>

                        <?php endforeach; ?>
                    <?php else : ?>
                        <img class="img-fluid" src="<?php echo base_url('assets/img/bank/payment-method.png'); ?>">
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <div class="credit border-top py-3">
            <div class="container">
                <div class="credit bg-white text-muted py-md-3">Copyright &copy; <?php echo date('Y') ?> - <?php echo $meta->title ?> - <?php echo $meta->tagline ?></div>
            </div>
        </div>
    </footer>
    <script src="<?php echo base_url() ?>assets/template/web/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/template/web/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/template/web/vendor/offcanvas/offcanvas.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/template/web/vendor/date-time-picker-bootstrap-4/js/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/template/web/vendor/date-time-picker-bootstrap-4/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script>
        $(function() {
            var minDate = new Date();
            minDate.setDate(minDate.getDate() + 1);
            $('#id_tanggal').datetimepicker({
                locale: 'id',
                format: 'YYYY-MM-DD',
                minDate: minDate
            });
            $('#startDate').datetimepicker({
                locale: 'id',
                format: 'YYYY-MM-DD',
                minDate: minDate
            });
            $('#endDate').datetimepicker({
                locale: 'id',
                format: 'YYYY-MM-DD',
                minDate: minDate
            });
        });
        $("#id_tanggal").keydown(false);
    </script>
    <script>
        var title = "";
        var deskripsi = "";
        var currentLocation = window.location;
        var top = (screen.height - 570) / 2;
        var left = (screen.width - 570) / 2;
        var params = "menubar=no,toolbar=no,status=no,width=570,height=570,top=" + top + ",left=" + left;
        console.log(encodeURI(title + deskripsi));

        function _fb() {
            var url = "https://web.facebook.com/sharer.php?u=" + encodeURI(currentLocation);
            window.open(url, 'NewWindow', params);
        }

        function _twitter() {
            var url = "https://twitter.com/intent/tweet?url=" + encodeURI(currentLocation) + "&text=" + encodeURI(deskripsi);
            window.open(url, 'NewWindow', params);
        }

        function _whatsapp() {
            var url = "https://api.whatsapp.com/send?phone=&text=" + encodeURI(title + " " + deskripsi);
            window.open(url, 'NewWindow', params);
        }

        function _pinterest() {
            var url = "http://pinterest.com/pin/create/button/?url=" + encodeURI(currentLocation);
            window.open(url, 'NewWindow', params);
        }
    </script>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>