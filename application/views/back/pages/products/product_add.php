<?php $this->load->view('back/includes/head') ?>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
    <!--============= start main area -->

    <?php $this->load->view('back/includes/navbar') ?>

    <?php $this->load->view('back/includes/sidebar') ?>

    <?php $this->load->view('back/includes/navbar_search') ?>

    <!-- APP MAIN ==========-->
    <main id="app-main" class="app-main">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Yeni Ürün Ekle</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?php echo base_url("products/add") ?>" method="POST">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea class="form-control" rows="10" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md">Ekle</button>
                    <a href="javascript:history.go(-1)" class="btn btn-danger btn-md">Geri Dön</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
        <?php $this->load->view('back/includes/footer') ?>
    </main>

    <?php $this->load->view('back/includes/footer_script') ?>