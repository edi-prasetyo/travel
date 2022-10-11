<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
$meta           = $this->meta_model->get_meta();
$menu           = $this->menu_model->get_menu();
$setting           = $this->setting_model->detail();
?>
<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white shadow-sm" aria-label="Main navigation">
  <div class="container">
    <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/img/logo/' . $meta->logo); ?>"></a>
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