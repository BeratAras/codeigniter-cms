<?php $this->load->view('back/includes/head') ?>

<body class="simple-page">
    <div id="back-to-home">
        <a href="index.html" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
    </div>
    <div class="simple-page-wrap">
        <div class="simple-page-logo animated swing">
            <a href="index.html">
                <span><i class="fa fa-gg"></i></span>
                <span>Infinity</span>
            </a>
        </div><!-- logo -->
        <div class="simple-page-form animated flipInY" id="reset-password-form">
            <h4 class="form-title m-b-xl text-center">E-Posta Adresinizi Giriniz</h4>

            <form method="POST" action="<?php echo base_url('auth/reset_password') ?>">
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="E-Posta">
                </div>
                <input type="submit" class="btn btn-primary" value="E-Posta Gönder">
            </form>
        </div>

        <div class="simple-page-footer">
            <p><a href="<?php echo base_url("login") ?>">Giriş Yap</a></p>
        </div>

    </div><!-- .simple-page-wrap -->
</body>

</html>

<script src="<?php echo base_url("public/back") ?>/assets/js/sweatalert2.all.js"></script>
<script src="<?php echo base_url("public/back") ?>/assets/js/iziToast.min.js"></script>

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