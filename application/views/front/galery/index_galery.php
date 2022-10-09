<div class="breadcrumb-default">
    <div class="container my-5">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="row">
        <?php foreach ($galery as $galery) : ?>
            <div class="col-md-4">
                <figure class="card">
                    <a href="" data-bs-toggle="modal" data-bs-target="#View<?php echo $galery->id ?>">
                        <div class="img-frame">
                            <img class="card-img" src="<?php echo base_url('assets/img/galery/' . $galery->galery_img); ?>">
                        </div>

                        <div class="card-body text-center">
                            <h5 class="title"><?php echo substr($galery->galery_title, 0, 25); ?></h5>
                        </div>
                    </a>
                </figure>
            </div>
            <div class="modal fade" id="View<?php echo $galery->id ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><?php echo $galery->galery_title; ?> </h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img class="img-fluid" src="<?php echo base_url('assets/img/galery/' . $galery->galery_img); ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary pull-left" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="pagination col-md-12 text-center">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>
    </div>
</div>