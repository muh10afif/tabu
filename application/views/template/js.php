<!-- jQuery  -->
<script src="<?= base_url() ?>assets/template/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/template/assets/js/jquery.slimscroll.js"></script>
<script src="<?= base_url() ?>assets/template/assets/js/waves.min.js"></script>

<script src="<?= base_url()  ?>assets/template/plugins/moment/moment.js"></script>
<script src="<?= base_url()  ?>assets/template/plugins/moment/locale/id.js"></script>

<!-- chartjs js -->
<script src="<?= base_url() ?>assets/template/plugins/chartjs/chart.min.js"></script>

<script src="<?= base_url(); ?>assets/input_spinner/dist/js/jquery.input-counter.min.js"></script>

<!-- Sweet Alerts js -->
<script src="<?= base_url() ?>assets/swa/sweetalert2.all.min.js"></script>

<!-- numeric -->
<script src="<?= base_url(); ?>assets/numeric/jquery.numeric-only.js"></script>
<!-- number separator -->
<script src="<?= base_url(); ?>assets/number_divider/dist/number-divider.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url() ?>assets/template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?= base_url() ?>assets/template/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/datatables/jszip.min.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/datatables/pdfmake.min.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/datatables/vfs_fonts.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/datatables/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/datatables/buttons.print.min.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="<?= base_url() ?>assets/template/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- Plugins js -->
<script src="<?= base_url() ?>assets/template/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>   
<!-- Plugins Init js -->
<script src="<?= base_url() ?>assets/template/assets/pages/form-advanced.js"></script>

<!-- App js -->
<script src="<?= base_url() ?>assets/template/assets/js/app.js"></script>

<script>
    $(document).ready(function () {

        var interval = setInterval(function() {
        var momentNow = moment();
            $('.date-part').html(momentNow.format('dddd')
                                .toUpperCase() + ', ' +
                                momentNow.format('DD MMMM YYYY')
                                );
            $('.tgl-part').html(momentNow.format('dddd')
                                .toUpperCase() + '<br>' +
                                momentNow.format('DD MMMM YYYY')
                                );
            $('.time-part').html(momentNow.format('HH:mm:ss'));
        }, 100);

        $('.numeric').numericOnly();

        $('.number_separator').divide({
            delimiter:'.',
            divideThousand: true, // 1,000..9,999
            delimiterRegExp: /[\.\,\s]/g
        });

        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: false,
            format: "dd-mm-yyyy",
            clearBtn: true,
            orientation: 'bottom'
        });

        var options = {
            selectors: {
                addButtonSelector		: '.btn-add',
                subtractButtonSelector	: '.btn-subtract',
                inputSelector			: '.counter',
            },
            settings: {
                checkValue: true,
                isReadOnly: false,
            },
        };

        $(".input-counter").inputCounter(options);
        
    })
</script>