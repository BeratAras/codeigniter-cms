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
                                <a href="<?php echo base_url("Email/add_page") ?>" class="btn btn-primary btn-outline rounded pull-right">
                                    <i class="fa fa-plus"></i> E-Posta Ekle
                                </a>
                                <h4 class="widget-title pull-left">E-Posta Listesi</h4>
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body">
                                <div class="table-responsive">
                                    <?php if(empty($email_settings)){ ?>
                                        <div class="alert alert-info text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4>Herhangi Bir Kayıt Bulunamadı.</h4>
                                            <p>Eklemek için <a href="<?php echo base_url("email_settings/add_page") ?>">tıklayınız.</a></p>
                                        </div>
                                    <?php } ?>
                                    <table id="default-datatable" data-plugin="DataTable" class="table table-bordered table-striped table-hover"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Protokol</th>
                                                <th>Host</th>
                                                <th>Port</th>
                                                <th>Gönderen</th>
                                                <th>Kimden</th>
                                                <th>Kime</th>
                                                <th>Gönderim Adı</th>
                                                <th>Durum</th>
                                                <th>İşlem</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($email_settings as $email_settings){ ?>
                                                <tr>
                                                    <td><?php echo $email_settings->id ?></td>
                                                    <td><?php echo $email_settings->protocol ?></td>
                                                    <td><?php echo $email_settings->host ?></td>
                                                    <td><?php echo $email_settings->port ?></td>
                                                    <td><?php echo $email_settings->user ?></td>
                                                    <td><?php echo $email_settings->from ?></td>
                                                    <td><?php echo $email_settings->to ?></td>
                                                    <td><?php echo $email_settings->user_name ?></td>
                                                    <?php $table = "email_settings" ?>
                                                    <td>
                                                        <input 
                                                            data-url="<?php echo base_url("email/isActiveSetter/$email_settings->id/$table") ?>"
                                                            class="is-active"
                                                            id="switch-2-2" 
                                                            type="checkbox" 
                                                            data-switchery data-color="#10c469" 
                                                            <?php if($email_settings->isActive == 1){ ?> checked <?php } ?> 
                                                        />
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url("email/update_page/$email_settings->id")  ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Düzenle</a>
                                                        <button 
                                                        data-url="<?php echo base_url("email/delete/$email_settings->id/$table") ?>" 
                                                        class="btn btn-danger btn-sm remove-btn"><i class="fa fa-trash"></i> Sil
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