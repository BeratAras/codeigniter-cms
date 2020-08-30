<?php $this->load->view('back/includes/head') ?>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
    <!--============= start main area -->

    <?php $this->load->view('back/includes/navbar') ?>

    <?php $this->load->view('back/includes/sidebar') ?>

    <?php $this->load->view('back/includes/navbar_search') ?>

    <!-- APP MAIN ==========-->
    <main id="app-main" class="app-main" style="padding: 40px;">
        <div class="wrap">
            <section class="app-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget">
                            <header class="widget-header">
                                <h4 class="widget-title">Dropzone</h4>
                            </header>
                            <hr class="widget-separator">
                            <div class="widget-body">
                                <form action="<?php echo base_url("portfolio/image_upload/$portfolio->id") ?>" id="dropzone" class="dropzone" data-plugin="dropzone"
                                    data-options="{ url: '<?php echo base_url("portfolio/image_upload/$portfolio->id") ?>'}">
                                    <div class="dz-message">
                                        <h3 class="m-h-lg">Drop files here or click to upload.</h3>
                                        <p class="m-b-lg text-muted">(This is just a demo dropzone. Selected files are
                                            not actually uploaded.)</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="wrap">
            <section class="app-content">
                <div class="row">
                    <!-- DOM dataTable -->
                    <div class="col-md-12">
                        <div class="widget">
                            <header class="widget-header">
                                <h4 class="widget-title pull-left">Portfolyo Fotoğrafları</h4>
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body image-list-container">
                                <div class="table-responsive">
                                    <?php if(empty($portfolio_images)){ ?>
                                        <div class="alert alert-info text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4>Herhangi Bir Kayıt Bulunamadı.</h4>
                                        </div>
                                    <?php } ?>
                                    <table id="default-datatable" data-plugin="DataTable" class="table table-bordered table-striped table-hover"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Fotoğraf Adı</th>
                                                <th>Fotoğraf</th>
                                                <th>Kapak</th>
                                                <th>Durumu</th>
                                                <th>İşlem</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($portfolio_images as $pi){ ?>
                                                <?php if($portfolio->id == $pi->portfolio_id){ ?>
                                                    <tr>
                                                        <td><?php echo $pi->id ?></td>
                                                        <td><?php echo $pi->img_url ?></td>
                                                        <td>
                                                            <img src="<?php echo base_url("uploads/portfolios/$pi->img_url") ?>" alt="<?php echo $pi->img_url ?>" height="100" width="100">
                                                        </td>
                                                        <td>
                                                            <input 
                                                                data-url="<?php echo base_url("portfolio/isCoverSetter/$pi->id/$pi->portfolio_id") ?>"
                                                                class="is-cover"
                                                                id="switch-2-2" 
                                                                type="checkbox" 
                                                                data-switchery data-color="#ff3737" 
                                                                <?php if($pi->isCover == 1){ ?> checked <?php } ?> 
                                                            />
                                                        </td>
                                                        <?php $table = "portfolio_images"; ?>
                                                        <td>
                                                            <input 
                                                                data-url="<?php echo base_url("portfolio/isActiveSetter/$pi->id/$table") ?>"
                                                                class="is-active"
                                                                id="switch-2-2" 
                                                                type="checkbox" 
                                                                data-switchery data-color="#10c469" 
                                                                <?php if($pi->isActive == 1){ ?> checked <?php } ?> 
                                                            />
                                                        </td>
                                                        <td>
                                                            <button 
                                                            data-url="<?php echo base_url("portfolio/delete/$pi->id/$table") ?>" 
                                                            class="btn btn-danger btn-sm remove-btn"><i class="fa fa-trash"></i> Sil
                                                            </button>
                                                        </td>
                                                    </tr>  
                                                <?php } ?>
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