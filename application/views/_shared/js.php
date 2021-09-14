<!-- <script src="<?php echo BASEURL ?>/public/assets/js/config.js"></script> -->
<script src="<?php echo BASEURL ?>/public/assets/js/jquery-3.5.1.min.js"></script>
<script src="<?php echo BASEURL ?>/public/assets/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASEURL ?>/public/assets/DataTables/datatables.js"></script>
<script src="<?php echo BASEURL ?>/public/assets/js/my-script.js"></script>
<script>
    $(document).ready(function() {
        $("#sreach").keyup(function(e) {
            if (e.keyCode == 13) {
                $("#sreach-product").trigger('click')
            }
        })
    })
</script>