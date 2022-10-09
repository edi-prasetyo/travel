<?php
$meta      = $this->meta_model->get_meta();
$menu      = $this->menu_model->get_menu();
$page      = $this->page_model->get_page();
$homepage  = $this->homepage_model->get_homepage();
?>
</main>
<footer class="bg-white mt-auto">
    <div class="bg-primary py-md-3">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-light display-6 fw-bold">
                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                        Need help ? Contact us
                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                        Butuh Bantuan ? Hubungi Kami
                    <?php else : ?>
                        Butuh Bantuan ? Hubungi Kami
                    <?php endif; ?>
                </div>
                <div class="col-md-4 text-light"><span style="font-size:30px;font-weight:700;"><i class="fab fa-whatsapp"></i> <?php echo $meta->whatsapp; ?></span></div>
            </div>
        </div>
    </div>
    <div class="container pt-4 pt-md-5 pb-md-5 border-top ">
        <div class="row">
            <div class="col-12 col-md-3 contact">
                <h4 class="fw-bold">Contact</h4>
                <i class="fa fa-phone"></i> <?php echo $meta->telepon ?><br>
                <i class="far fa-envelope"></i> <?php echo $meta->email ?>
            </div>
            <div class="col-8 col-6 col-md footer">
                <h4 class="fw-bold">Menu</h4>
                <ul class="list-unstyled">
                    <?php foreach ($menu as $menu) : ?>
                        <li> <a class="text-muted nav-item" href="<?php echo base_url() . $menu->url; ?>">
                                <?php if ($this->session->userdata('language') == 'EN') : ?>
                                    <?php echo $menu->name_en; ?>
                                <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                    <?php echo $menu->name_id; ?>
                                <?php else : ?>
                                    <?php echo $menu->name_id; ?>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <li> <a class="text-muted nav-item" href="#">
                            FAQ
                        </a>
                    </li>
                    <li> <a class="text-muted nav-item" href="#">
                            Ketentuan
                        </a>
                    </li>

                </ul>
            </div>
            <div class="col-12 col-md-5">
                <h4 class="fw-bold">Pembayaran</h4>
                <img class="img-fluid" src="<?php echo base_url('assets/img/bank/payment-method.png'); ?>">

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