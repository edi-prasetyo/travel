<div class="breadcrumb">
    <div class="container">
        <ul class="breadcrumb my-3">
            <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('berita') ?>"> Berita</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>
<div class="container">
    <?php foreach ($page as $page) : ?>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2><a href="<?php echo base_url('page/detail/' . $page->page_slug); ?>" class="text-muted">

                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                <?php echo substr($page->page_title_en, 0, 20); ?>
                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                <?php echo substr($page->page_title, 0, 20); ?>
                            <?php else : ?>
                                <?php echo substr($page->page_title, 0, 20); ?>
                            <?php endif; ?>
                        </a> </h2>
                    <p>
                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                            <?php echo substr($page->page_description_en, 0, 117); ?>
                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                            <?php echo substr($page->page_description, 0, 117); ?>
                        <?php else : ?>
                            <?php echo substr($page->page_description, 0, 117); ?>
                            <?php endif; ?>..
                    </p>
                    <a class="btn btn-outline-info" href="<?php echo base_url('page/detail/' . $page->page_slug); ?>">
                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                            Read More
                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                            Baca Selengkapnya
                        <?php else : ?>
                            Baca Selengkapnya
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>