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
                <h4 class="widget-title"> <b><?php echo $news->title; ?></b> Adlı Haberi Düzenle</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?php echo base_url("news/update/$news->id") ?>" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Başlık</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $news->title ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="input-form-error"><?php echo form_error('title'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea class="form-control" rows="10" name="description"><?php echo $news->description ?></textarea>
                    </div>

                    <div class="form-group">
						<label>Tür</label>
                        <select class="form-control news-type-select" name="news_type">
                            <option value="image" <?php echo ($news->news_type == "image") ? "selected" : "" ?>>Fotoğraf</option>
                            <option value="video" <?php echo ($news->news_type == "video") ? "selected" : "" ?>>Video</option>
                        </select>
                    </div>

                    <div class="row image-upload-container">
                        <div class="col-md-6 form-group" style="display: <?php echo ($news->news_type == "image") ? "block" : "none" ?>">
                            <label>Fotoğraf</label>
                            <input type="file" name="file" class="form-control">
                            <?php if(isset($form_error)){ ?>
                                <small class="input-form-error"><?php echo form_error('image_url'); ?></small>
                            <?php } ?>
                        </div>
                        <?php if($news->img_url !== ""){ ?>
                            <div class="col-md-6">
                                <img src="<?php echo base_url("uploads/news/$news->img_url") ?>" width="250" height="250">
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group video-url-container" style="display: <?php echo ($news->news_type == "video") ? "block" : "none" ?>">
                        <label>Video</label>
                        <input type="text" name="video_url" class="form-control" placeholder="Video URL Yapıştır" value="<?php echo $news->video_url ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="input-form-error"><?php echo form_error('video_url'); ?></small>
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

    <script src="<?php echo base_url("public/back") ?>/assets/js/news.js"></script>