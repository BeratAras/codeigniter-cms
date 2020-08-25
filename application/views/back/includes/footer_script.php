<!-- build:js ../assets/js/core.min.js -->
<script src="<?php echo base_url("public/back") ?>/libs/bower/jquery/dist/jquery.js"></script>
<script src="<?php echo base_url("public/back") ?>/libs/bower/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url("public/back") ?>/libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
<script src="<?php echo base_url("public/back") ?>/libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
<script src="<?php echo base_url("public/back") ?>/libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="<?php echo base_url("public/back") ?>/libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js">
</script>
<script src="<?php echo base_url("public/back") ?>/libs/bower/PACE/pace.min.js"></script>
<!-- endbuild -->

<!-- build:js ../assets/js/app.min.js -->
<?php $this->load->view('back/includes/library') ?>
<script src="<?php echo base_url("public/back") ?>/assets/js/plugins.js"></script>
<script src="<?php echo base_url("public/back") ?>/assets/js/app.js"></script>
<!-- endbuild -->
<script src="<?php echo base_url("public/back") ?>/libs/bower/moment/moment.js"></script>
<script src="<?php echo base_url("public/back") ?>/libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="<?php echo base_url("public/back") ?>/assets/js/fullcalendar.js"></script>
<script src="<?php echo base_url("public/back") ?>/assets/js/sweatalert2.all.js"></script>
<script src="<?php echo base_url("public/back") ?>/assets/js/iziToast.min.js"></script>



</body>
</html>


<?php 
    $alert = $this->session->userdata("alert");

    if($alert)
    {
        if($alert["type"] === "success"){ ?>
            <script>
                iziToast.success({
                    title: '<?php echo $alert['title'] ?>',
                    message: '<?php echo $alert['text'] ?>',
                    position: "topCenter"
                });
            </script>
        <?php }else{ ?>
            <script>
                iziToast.error({
                    title: '<?php echo $alert['title'] ?>',
                    message: '<?php echo $alert['text'] ?>',
                    position: "topCenter"
                });
            </script>
        <?php } 
    }

?>