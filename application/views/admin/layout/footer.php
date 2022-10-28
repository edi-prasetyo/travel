</div>
</div>
</div>
<script src="<?php echo base_url('assets/template/web/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/template/web/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url('assets/template/web/vendor/autocomplete/jquery-ui.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(function() {
            var minDate = new Date();
            minDate.setDate(minDate.getDate() + 1);
            $("#getDate").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: minDate
            });
            $("#startDate").datepicker({
                dateFormat: 'yy-mm-dd'
            });
            $("#endDate").datepicker({
                dateFormat: 'yy-mm-dd'
            }).bind("change", function() {
                var minValue = $(this).val();
                minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
                minValue.setDate(minValue.getDate() + 1);
                $("#to").datepicker("option", "minDate", minValue);
            })
        });
    });
</script>
<link href="<?php echo base_url('assets/template/web/vendor/summernote/summernote-lite.min.css'); ?> " rel="stylesheet">
<script src="<?php echo base_url('assets/template/web/vendor/summernote/summernote-lite.min.js'); ?>"></script>
<script>
    $('#summernote').summernote({
        tabsize: 2,
        height: 130,

        tooltip: false
    });
    $('#summernote2').summernote({
        tabsize: 2,
        height: 130,

        tooltip: false
    });
    $('#summernote3').summernote({
        tabsize: 2,
        height: 130,

        tooltip: false
    });
    $('#summernote4').summernote({
        tabsize: 2,
        height: 130,

        tooltip: false
    });
    $('#summernote5').summernote({
        tabsize: 2,
        height: 130,

        tooltip: false
    });
</script>
<!--Menu Toggle Script-->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
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