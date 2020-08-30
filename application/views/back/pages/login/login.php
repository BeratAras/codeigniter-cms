<?php $this->load->view('back/includes/head') ?>

<body class="simple-page">
    <div id="back-to-home">
        <a href="#" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
    </div>
    <div class="simple-page-wrap">
        <div class="simple-page-logo animated swing">
            <a href="index.html">
                <span><i class="fa fa-gg"></i></span>
                <span>Berat Aras - CMS</span>
            </a>
        </div>
        <div class="simple-page-form animated flipInY" id="login-form">
            <h4 class="form-title m-b-xl text-center">Hoşgeldin! Admin Olarak Giriş Yap!</h4>
            <form method="POST" action="<?php echo base_url("Auth/login") ?>">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Kullanıcı Adı">
                    <?php if(isset($form_error)){ ?>
                        <small class="input-form-error"><?php echo form_error('username'); ?></small>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Şifre">
                    <?php if(isset($form_error)){ ?>
                        <small class="input-form-error"><?php echo form_error('password'); ?></small>
                    <?php } ?>
                </div>

                <div class="form-group m-b-xl">
                    <div class="checkbox checkbox-primary">
                        <input type="checkbox" id="keep_me_logged_in" />
                        <label>Beni Hatırla</label>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Giriş">
            </form>
        </div>

        <div class="simple-page-footer">
            <p><a href="<?php echo base_url("password-forget") ?>">Şifreni mi Unuttun?</a></p>
        </div>


    </div>
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