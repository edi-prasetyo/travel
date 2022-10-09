<?php
$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);
$meta = $this->meta_model->get_meta();
?>
<div class="d-flex" id="wrapper">
    <div class="border-end pb-5" id="sidebar-wrapper">
        <div class="sidebar-heading text-transparent"> </div>
        <div class="py-4 px-3">
            <div class="media">
                <img src="<?php echo base_url('assets/img/avatars/' . $user->user_image); ?>" alt="..." width="65" class="mr-3 rounded-circle shadow-sm">
                <div class="media-body my-3">
                    <h5 class="m-0 text-muted"><?php echo $user->user_name; ?></h5>
                    <small class="font-weight-light mb-0 text-success"><i class="fas fa-circle text-success"></i> Online</small>
                </div>
            </div>
        </div>
        <p class="text-muted font-weight-bold text-uppercase px-3 small pb-2 mb-0"><b>Main</b></p>
        <ul class="nav flex-column  mb-0">
            <li class="nav-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>" class="nav-link <?php if ($this->uri->segment(2) == "dashboard") {
                                                                                            echo 'active';
                                                                                        } ?>">
                    <i class="feather-home  fa-fw"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('admin/tour'); ?>" class="nav-link <?php if ($this->uri->segment(2) == "tour") {
                                                                                    echo 'active';
                                                                                } ?>">
                    <i class="feather-shopping-cart mr-3  fa-fw"></i>
                    Tour
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('admin/transaction'); ?>" class="nav-link <?php if ($this->uri->segment(2) == "transaction") {
                                                                                            echo 'active';
                                                                                        } ?>">
                    <i class="feather-credit-card mr-3  fa-fw"></i>
                    Transaksi
                </a>
            </li>
            <p class="text-muted font-weight-bold text-uppercase px-3 small py-2 mb-0"><b>Web Front</b></p>
            <li class="nav-item">
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between 
                <?php if ($this->uri->segment(2) == "homepage" || $this->uri->segment(2) == "post" || $this->uri->segment(2) == "category" || $this->uri->segment(2) == "page" || $this->uri->segment(2) == "service" || $this->uri->segment(2) == "galery" || $this->uri->segment(2) == "video") {
                    echo 'active';
                } ?>
                " data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <span><i class="feather-airplay mr-3  fa-fw"></i> Konten </span> <i class="feather-chevron-down me-3  fa-fw my-auto"></i>
                </a>
            </li>
            <ul class="collapse <?php if ($this->uri->segment(2) == "homepage" || $this->uri->segment(2) == "post" || $this->uri->segment(2) == "category" || $this->uri->segment(2) == "page" || $this->uri->segment(2) == "service" || $this->uri->segment(2) == "galery" || $this->uri->segment(2) == "video") {
                                    echo 'show';
                                } ?>" id="collapseExample" class="alert alert-primary">
                <li class="nav-child">
                    <a href="<?php echo base_url('admin/homepage'); ?>" class="<?php if ($this->uri->segment(2) == "homepage") {
                                                                                    echo 'active';
                                                                                } ?> nav-link">
                        <i class="fa-solid fa-caret-right mr-3  fa-fw"></i>
                        Homepage
                    </a>
                </li>
                <li class="nav-child">
                    <a href="<?php echo base_url('admin/post'); ?>" class="<?php if ($this->uri->segment(2) == "post") {
                                                                                echo 'active';
                                                                            } ?> nav-link">
                        <i class="fa-solid fa-caret-right mr-3  fa-fw"></i>
                        Berita
                    </a>
                </li>
                <li class="nav-child">
                    <a href="<?php echo base_url('admin/category'); ?>" class=" <?php if ($this->uri->segment(2) == "category") {
                                                                                    echo 'active';
                                                                                } ?>  nav-link">
                        <i class="fa-solid fa-caret-right mr-3  fa-fw"></i>
                        Kategori
                    </a>
                </li>
                <li class="nav-child">
                    <a href="<?php echo base_url('admin/page'); ?>" class="<?php if ($this->uri->segment(2) == "page") {
                                                                                echo 'active';
                                                                            } ?> nav-link">
                        <i class="fa-solid fa-caret-right mr-3  fa-fw"></i>
                        Page
                    </a>
                </li>
                <li class="nav-child">
                    <a href="<?php echo base_url('admin/service'); ?>" class="<?php if ($this->uri->segment(2) == "service") {
                                                                                    echo 'active';
                                                                                } ?> nav-link">
                        <i class="fa-solid fa-caret-right mr-3  fa-fw"></i>
                        Service
                    </a>
                </li>
                <li class="nav-child">
                    <a href="<?php echo base_url('admin/galery'); ?>" class="<?php if ($this->uri->segment(2) == "galery") {
                                                                                    echo 'active';
                                                                                } ?> nav-link">
                        <i class="fa-solid fa-caret-right mr-3  fa-fw"></i>
                        Galery
                    </a>
                </li>
                <li class="nav-child">
                    <a href="<?php echo base_url('admin/video'); ?>" class="<?php if ($this->uri->segment(2) == "video") {
                                                                                echo 'active';
                                                                            } ?> nav-link">
                        <i class="fa-solid fa-caret-right mr-3  fa-fw"></i>
                        Video
                    </a>
                </li>
            </ul>
            <p class="text-muted font-weight-bold text-uppercase px-3 small py-2 mb-0"> <b>Pengaturan</b></p>
            <li class="nav-item">
                <a href="<?php echo base_url('admin/user'); ?>" class="nav-link <?php if ($this->uri->segment(2) == "user") {
                                                                                    echo 'active';
                                                                                } ?>">
                    <i class="feather-user mr-3  fa-fw"></i>
                    User
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('admin/meta'); ?>" class="nav-link <?php if ($this->uri->segment(2) == "meta") {
                                                                                    echo 'active';
                                                                                } ?>">
                    <i class="feather-settings mr-3  fa-fw"></i>
                    Profile Web
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('admin/menu'); ?>" class="nav-link <?php if ($this->uri->segment(2) == "menu") {
                                                                                    echo 'active';
                                                                                } ?>">
                    <i class="feather-book-open mr-3  fa-fw"></i>
                    Menu
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('admin/setting'); ?>" class="nav-link <?php if ($this->uri->segment(2) == "setting") {
                                                                                        echo 'active';
                                                                                    } ?>">
                    <i class="feather-edit-3 mr-3  fa-fw"></i>
                    setting
                </a>
            </li>
        </ul>
    </div>