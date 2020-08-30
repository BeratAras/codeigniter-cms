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
                <h4 class="widget-title"><?php echo $portfolio->title ?> Adlı Portfolyoyu Düzenle</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?php echo base_url("portfolio/update/$portfolio->id"); ?>" method="post">

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label>Başlık</label>
                            <input class="form-control" placeholder="İşi anlatan başlık bilgisi" name="title" value="<?php echo $portfolio->title ?>">
                            <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                            <?php } ?>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Kategori</label>
                            <select name="category" class="form-control">
                                <?php foreach($portfolio_categories as $pc){ ?>
                                    <option value="<?php echo $pc->id ?>" <?php echo ($pc->id === $portfolio->category_id) ? "selected" : "" ?>><?php echo $pc->title ?></option>
                                <?php } ?>
                            </select>
                            <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("client"); ?></small>
                            <?php } ?>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-4">
                            <label for="datetimepicker1">Bitirme Tarihi</label>
                            <input 
                            type="hidden" 
                            name="finishedAt" 
                            id="datetimepicker1" 
                            data-plugin="datetimepicker"
                            data-options="{inline: true, viewMode: 'days', format : 'YYYY-MM-DD HH:mm:ss'}" 
                            value="<?php echo $portfolio->finishedAt ?>"
                            />
                        </div>

                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Müşteri</label>
                                        <input class="form-control" placeholder="İşi yaptığınız müşteri" name="client" value="<?php echo $portfolio->client ?>">
                                        <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error">
                                            <?php echo form_error("client"); ?></small>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Yer/Mekan</label>
                                        <input class="form-control" placeholder="İşi yaptığınız yer, mekan bilgisi" name="place" value="<?php echo $portfolio->place ?>">
                                        <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error">
                                            <?php echo form_error("place"); ?></small>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Yapılan işin Bağlantısı (URL)</label>
                                        <input 
                                        class="form-control"
                                        placeholder="Yapılan işin internet üzerindeki bağlantısı"
                                        name="portfolio_url"
                                        value="<?php echo $portfolio->portfolio_url ?>"
                                        >
                                        <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error">
                                            <?php echo form_error("portfolio_url"); ?></small>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"><?php echo $portfolio->description ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md">Kaydet</button>
                    <a href="<?php echo base_url("portfolio"); ?>" class="btn btn-md btn-danger">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
        <?php $this->load->view('back/includes/footer') ?>
    </main>

    <?php $this->load->view('back/includes/footer_script') ?>