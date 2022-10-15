<?php
$meta      = $this->meta_model->get_meta();
$link      = $this->link_model->get_link();
$page      = $this->page_model->get_page();
$homepage  = $this->homepage_model->get_homepage();
$setting = $this->setting_model->detail();
$bank   = $this->bank_model->get_allbank();

?>
</main>
<footer class="bg-white mt-auto shadow ">
    <div class="container pt-5 pb-5">
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
        // $('#startDate').datetimepicker({
        //     locale: 'id',
        //     format: 'YYYY-MM-DD',
        //     minDate: minDate
        // });
        // $('#endDate').datetimepicker({
        //     locale: 'id',
        //     format: 'YYYY-MM-DD',
        //     minDate: minDate
        // });
    });
    $("#id_tanggal").keydown(false);
</script>


<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.css" integrity="sha512-lvdq1fIyCp6HMWx1SVzXvGC4jqlX3e7Xm7aCBrhj5F1WdWoLe0dBzU0Sy10sheZYSkJpJcboMNO/4Qz1nJNxfA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script>
    $(function() {
        $("#startDate").datepicker({
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 2,
            autoclose: true,
            minDate: 0,

            onClose: function(selectedDate) {
                $("#endDate").datepicker("option", "minDate", selectedDate);
                $("#endDate").datepicker("show");
            }
        });
        $("#endDate").datepicker({
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 2,
            minDate: 0,
            autoclose: true,


        });

    });
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