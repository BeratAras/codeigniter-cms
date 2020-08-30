<?php $this->load->view('back/includes/head') ?>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
    <!--============= start main area -->

    <?php $this->load->view('back/includes/navbar') ?>

    <?php $this->load->view('back/includes/sidebar') ?>

    <?php $this->load->view('back/includes/navbar_search') ?>

    <!-- APP MAIN ==========-->
    <main id="app-main" class="app-main" style="padding: 40px;">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Yeni E-Posta Ekle</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?php echo base_url("Email/add") ?>" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Protokol</label>
                        <input type="text" name="protocol" class="form-control">
                        <?php if(isset($form_error)){ ?>
                            <small class="input-form-error"><?php echo form_error('protocol'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Host</label>
                        <input type="text" name="host" class="form-control">
                        <?php if(isset($form_error)){ ?>
                            <small class="input-form-error"><?php echo form_error('host'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Port</label>
                        <input type="text" name="port" class="form-control">
                        <?php if(isset($form_error)){ ?>
                            <small class="input-form-error"><?php echo form_error('port'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Gönderen</label>
                        <input type="email" name="user" class="form-control">
                        <?php if(isset($form_error)){ ?>
                            <small class="input-form-error"><?php echo form_error('user'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Şifre</label>
                        <input type="password" name="password" class="form-control">
                        <?php if(isset($form_error)){ ?>
                            <small class="input-form-error"><?php echo form_error('password'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Kimden</label>
                        <input type="text" name="from" class="form-control">
                        <?php if(isset($form_error)){ ?>
                            <small class="input-form-error"><?php echo form_error('from'); ?></small>
                        <?php } ?>
                    </div>
                    
                    <div class="form-group">
                        <label>Kime</label>
                        <input type="text" name="to" class="form-control">
                        <?php if(isset($form_error)){ ?>
                            <small class="input-form-error"><?php echo form_error('to'); ?></small>
                        <?php } ?>
                    </div>
                    
                    <div class="form-group">
                        <label>Gönderim Adı</label>
                        <input type="text" name="user_name" class="form-control">
                        <?php if(isset($form_error)){ ?>
                            <small class="input-form-error"><?php echo form_error('user_name'); ?></small>
                        <?php } ?>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md">Ekle</button>
                    <a href="javascript:history.go(-1)" class="btn btn-danger btn-md">Geri Dön</a>
                </form>
            </div>
        </div>
        <?php $this->load->view('back/includes/footer') ?>
    </main>

    <?php $this->load->view('back/includes/footer_script') ?>