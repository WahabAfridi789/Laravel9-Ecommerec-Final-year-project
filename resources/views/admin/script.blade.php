<!-- plugins:js -->
<script src="admin/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="admin/vendors/chart.js/Chart.min.js"></script>
<script src="admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="admin/vendors/progressbar.js/progressbar.min.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="admin/js/off-canvas.js"></script>
<script src="admin/js/hoverable-collapse.js"></script>
<script src="admin/js/template.js"></script>
<script src="admin/js/settings.js"></script>
<script src="admin/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="admin/js/jquery.cookie.js" type="text/javascript"></script>
<script src="admin/js/dashboard.js"></script>
<script src="admin/js/Chart.roundedBarCharts.js"></script>
<script type="text/javascript">
                $('#search_orders').on('keyup', function() {
                    value = $(this).val();

                    if (value.length > 0) {
                        $('.all_records').hide();
                        $('.search_record_table').show();
                    } else {
                        $('.all_records').show();
                        $('.search_record_table').hide();
                    }

                    $.ajax({
                        url: '{{ url('search') }}',
                        method: 'GET',
                        data: {
                            value: value
                        },
                        success: function(data) {

                            console.log(data)
                            $('#tbody_ajax').html(data);
                        }
                    });
                })
            </script>
