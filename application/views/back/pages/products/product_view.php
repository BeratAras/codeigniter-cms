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
                                <h4 class="widget-title">Default DataTable</h4>
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body">
                                <div class="table-responsive">
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
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>0/1</td>
                                                <td>
                                                    <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Düzenle</a>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Sil</a>
                                                </td>
                                            </tr>
                                           
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