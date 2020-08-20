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
                <h4 class="widget-title"><?php echo $product->title ?> Adlı Ürünü Düzenle</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?php echo base_url("products/update/$product->id") ?>" method="POST">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $product->title ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="input-form-error"><?php echo form_error('title'); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea class="form-control" rows="10" name="description"><?php echo $product->description ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md">Güncelle</button>
                    <a href="javascript:history.go(-1)" class="btn btn-danger btn-md">Geri Dön</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
        <?php $this->load->view('back/includes/footer') ?>
    </main>

    <?php $this->load->view('back/includes/footer_script') ?>