<?php $this->load->view('back/includes/head') ?>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
    <!--============= start main area -->

    <?php $this->load->view('back/includes/navbar') ?>

    <?php $this->load->view('back/includes/sidebar') ?>

    <?php $this->load->view('back/includes/navbar_search') ?>

    <!-- APP MAIN ==========-->
    <main id="app-main" class="app-main">
        <div class="wrap">
            <section class="app-content">
                <div class="row">
                    <!-- DOM dataTable -->
                    <div class="col-md-12">
                        <div class="widget">
                            <header class="widget-header">
                                <a href="<?php echo base_url("portfolio/add_page") ?>"
                                    class="btn btn-primary btn-outline rounded pull-right">
                                    <i class="fa fa-plus"></i> Portfolyo Ekle
                                </a>
                                <h4 class="widget-title pull-left">Portfolyo Listesi</h4>
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body">
                                <div class="table-responsive">
                                    <?php if(empty($portfolio)){ ?>
                                    <div class="alert alert-info text-center">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4>Herhangi Bir Kayıt Bulunamadı.</h4>
                                        <p>Eklemek için <a
                                                href="<?php echo base_url("portfolio/add_page") ?>">tıklayınız.</a></p>
                                    </div>
                                    <?php } ?>
                                    <table class="table table-hover table-striped table-bordered content-container">
                                        <thead>
                                            <th class="order"><i class="fa fa-reorder"></i></th>
                                            <th class="w50">#id</th>
                                            <th>Başlık</th>
                                            <th>url</th>
                                            <th>Kategori</th>
                                            <th>Müşteri</th>
                                            <th>Bitiş Tarihi</th>
                                            <th>Durumu</th>
                                            <th>İşlem</th>
                                        </thead>
                                        <tbody class="sortable"
                                            data-url="<?php echo base_url("portfolio/rankSetter"); ?>">
                                           
                                            <?php foreach($portfolio as $portfolio) { ?>
                                            <tr id="ord-<?php echo $portfolio->id; ?>">
                                                <td class="order"><i class="fa fa-reorder"></i></td>
                                                <td class="w50 text-center">#<?php echo $portfolio->id; ?></td>
                                                <td class="text-center"><?php echo $portfolio->title; ?></td>
                                                <td class="text-center"><?php echo $portfolio->url; ?></td>
                                                <td class="text-center"><?php echo $portfolio->category_id; ?></td>
                                                <td class="text-center"><?php echo $portfolio->client; ?></td>
                                                <td class="text-center"><?php echo $portfolio->finishedAt; ?></td>
                                                <?php $table = "portfolios" ?>
                                                <td class="text-center">
                                                    <input
                                                        data-url="<?php echo base_url("portfolio/isActiveSetter/$portfolio->id/$table") ?>"
                                                        class="is-active" id="switch-2-2" type="checkbox" data-switchery
                                                        data-color="#10c469" <?php if($portfolio->isActive == 1){ ?>
                                                        checked <?php } ?> />
                                                </td>
                                                <td class="text-center w250">
                                                    <a href="<?php echo base_url("portfolio/update_page/$portfolio->id"); ?>"
                                                        class="btn btn-sm btn-info"><i
                                                            class="fa fa-pencil-square-o"></i> Düzenle</a>
                                                    <a href="<?php echo base_url("portfolio/image_page/$portfolio->id"); ?>"
                                                        class="btn btn-sm btn-dark"><i
                                                            class="fa fa-image"></i> Resimler</a>
                                                    <button
                                                        data-url="<?php echo base_url("portfolio/delete/$portfolio->id/$table"); ?>"
                                                        class="btn btn-sm btn-danger remove-btn">
                                                        <i class="fa fa-trash"></i> Sil
                                                    </button>
                                                </td>
                                            </tr>

                                            <?php } ?>

                                        </tbody>

                                    </table>
                                </div>
                            </div><!-- .widget-body -->
                        </div><!-- .widget -->
                    </div><!-- END column -->
                </div>
            </section>
        </div>
        <?php $this->load->view('back/includes/footer') ?>
    </main>

    <?php $this->load->view('back/includes/footer_script') ?>