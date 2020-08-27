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
                <h4 class="widget-title"> <b><?php echo $users->name . " " . $users->surname ?></b> Adlı Kullanıcıyı Düzenle</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?php echo base_url("users/update/$users->id") ?>" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Kullanıcı Adı</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $users->user_name ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="input-form-error"><?php echo form_error('username'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Ad</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $users->name ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="input-form-error"><?php echo form_error('name'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Soyad</label>
                        <input type="text" name="surname" class="form-control" value="<?php echo $users->surname ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="input-form-error"><?php echo form_error('surname'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>E-Posta</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $users->email ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="input-form-error"><?php echo form_error('email'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Şifre</label>
                        <input type="password" name="password" class="form-control"> 
                        <small>Burayı boş bırakırsanız şifreniz değişmez.</small>
                        <?php if(isset($form_error)){ ?>
                            <small class="input-form-error"><?php echo form_error('password'); ?></small>
                        <?php } ?>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md">Güncelle</button>
                    <a href="javascript:history.go(-1)" class="btn btn-danger btn-md">Geri Dön</a>

                </form>
            </div>
        </div>
        <?php $this->load->view('back/includes/footer') ?>
    </main>

    <?php $this->load->view('back/includes/footer_script') ?>
