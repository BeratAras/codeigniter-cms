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
                                <a href="<?php echo base_url("products/add_page") ?>" class="btn btn-primary btn-outline rounded pull-right">
                                    <i class="fa fa-plus"></i> Ürün Ekle
                                </a>
                                <h4 class="widget-title pull-left">Ürün Listesi</h4>
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body">
                                <div class="table-responsive">
                                    <?php if(empty($products)){ ?>
                                        <div class="alert alert-info text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4>Herhangi Bir Kayıt Bulunamadı.</h4>
                                            <p>Eklemek için <a href="<?php echo base_url("products/add_page") ?>">tıklayınız.</a></p>
                                        </div>
                                    <?php } ?>
                                    <table id="default-datatable" data-plugin="DataTable" class="table table-striped"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Url</th>
                                                <th>Başlık</th>
                                                <th>Açıklama</th>
                                                <th>Durumu</th>
                                                <th>İşlem</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($products as $product){ ?>
                                                <tr>
                                                    <td><?php echo $product->id ?></td>
                                                    <td><?php echo $product->url ?></td>
                                                    <td><?php echo $product->title ?></td>
                                                    <td><?php echo $product->description ?></td>
                                                    <td>
                                                        <input id="switch-2-2" type="checkbox" data-switchery data-color="#10c469" <?php if($product->isActive == 1){ ?> checked <?php } ?> />
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Düzenle</a>
                                                        <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Sil</a>
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