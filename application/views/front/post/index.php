<div class="breadcrumb">
    <div class="container">
        <ul class="breadcrumb my-3">
            <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>
<div class="container mb-3">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <?php foreach ($post as $post) : ?>
                    <div class="col-md-4">
                        <div class="post-slide3">
                            <div class="post-img">
                                <div class="img-frame">
                                    <img src="<?php echo base_url('assets/img/post/thumbs/' . $post->post_image); ?>" alt="">
                                </div>
                                <span class="post-icon">
                                    <i class="fa fa-book"></i>
                                </span>
                            </div>
                            <div class="post-body">
                                <ul class="post-bar">
                                    <li><?php echo date('j M Y', strtotime("$post->created_at")); ?></li>
                                    <li>
                                        <a href="<?php echo base_url('category/item/' . $post->category_slug); ?>"><?php echo $post->category_name; ?></a>
                                    </li>
                                </ul>
                                <h3 class="post-title"><a href="<?php echo base_url('post/detail/' . $post->post_slug); ?>">
                                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                                            <?php echo $post->post_title_en; ?>
                                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                            <?php echo $post->post_title; ?>
                                        <?php else : ?>
                                            <?php echo $post->post_title; ?>
                                        <?php endif; ?>
                                    </a></h3>
                                <p class="post-description">
                                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                                        <?php echo substr($post->post_description_en, 0, 95); ?>
                                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                        <?php echo substr($post->post_description, 0, 95); ?>
                                    <?php else : ?>
                                        <?php echo substr($post->post_description, 0, 95); ?>
                                    <?php endif; ?> </p>
                                <a href="<?php echo base_url('post/detail/' . $post->post_slug); ?>" class="read-more">
                                    <i class="fa fa-long-arrow-right"></i>
                                    <span>
                                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                                            Read More
                                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                            Selengkapnya
                                        <?php else : ?>
                                            Selengkapnya
                                        <?php endif; ?>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="pagination col-md-12 text-center">
                <?php if (isset($pagination)) {
                    echo $pagination;
                } ?>
            </div>
        </div>
        <div class="col-md-3">
            <?php include "sidebar.php"; ?>
        </div>
    </div>











    <div class="pagination col-md-12 text-center">
        <?php if (isset($paginasi)) {
            echo $paginasi;
        } ?>
    </div>
</div>