<?php $this->load->view('back/includes/head') ?>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
    <!--============= start main area -->

    <?php $this->load->view('back/includes/navbar') ?>

    <?php $this->load->view('back/includes/sidebar') ?>

    <?php $this->load->view('back/includes/navbar_search') ?>

    <main id="app-main" class="app-main" style="padding: 40px;">

        <form action="<?php echo base_url("settings/update"); ?>" method="POST" enctype="multipart/form-data">
            <div class="widget">
                <div class="m-b-lg nav-tabs-horizontal">
                    <!-- tabs list -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab-1" aria-controls="tab-3" role="tab"
                                data-toggle="tab">Site Bilgileri</a></li>
                        <li role="presentation"><a href="#tab-6" aria-controls="tab-6" role="tab"
                                data-toggle="tab">Adres Bilgisi</a></li>
                        <li role="presentation"><a href="#tab-2" aria-controls="tab-1" role="tab"
                                data-toggle="tab">Hakkımızda</a></li>
                        <li role="presentation"><a href="#tab-3" aria-controls="tab-2" role="tab"
                                data-toggle="tab">Misyon</a></li>
                        <li role="presentation"><a href="#tab-4" aria-controls="tab-3" role="tab"
                                data-toggle="tab">Vizyon</a></li>
                        <li role="presentation"><a href="#tab-5" aria-controls="tab-4" role="tab"
                                data-toggle="tab">Sosyal Medya</a></li>
                        <li role="presentation"><a href="#tab-7" aria-controls="tab-7" role="tab"
                                data-toggle="tab">Logo</a></li>
                    </ul><!-- .nav-tabs -->
                    <!-- Tab panes -->

                    <div class="tab-content p-md">
                        <div role="tabpanel" class="tab-pane in active fade" id="tab-1">

                            <div class="row">

                                <div class="form-group col-md-8">
                                    <label>Şirket Adı</label>
                                    <input class="form-control" placeholder="Şirketin ya da Sitenizin adı"
                                        name="company_name"
                                        value="<?php echo $settings->company_name ?>">
                                    <?php if (isset($form_error)) { ?>
                                    <small class="pull-right input-form-error">
                                        <?php echo form_error("company_name"); ?></small>
                                    <?php } ?>
                                </div>


                            </div>

                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label>Telefon 1</label>
                                    <input class="form-control" placeholder="Telefon numaranız" name="phone_1"
                                        value="<?php echo $settings->phone_1 ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Telefon 2</label>
                                    <input class="form-control" placeholder="Diğer telefon numaranız (opsiyonel)"
                                        name="phone_2"
                                        value="<?php echo $settings->phone_2 ?>">
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Fax 1</label>
                                    <input class="form-control" placeholder="Fax numaranız" name="fax_1"
                                        value="<?php echo $settings->fax_1 ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Fax 2</label>
                                    <input class="form-control" placeholder="Diğer fax numaranız (opsiyonel)"
                                        name="fax_2"
                                        value="<?php echo $settings->fax_2 ?>">
                                </div>
                            </div>



                        </div><!-- .tab-pane  -->


                        <div role="tabpanel" class="tab-pane fade" id="tab-6">

                            <div class="row">

                                <div class="form-group col-md-12">
                                    <label>Adres Bilgisi</label>
                                    <textarea name="address" class="m-0" data-plugin="summernote" data-options="{height: 250}"><?php echo $settings->address ?></textarea>
                                </div>

                            </div>

                        </div><!-- .tab-pane  -->

                        <div role="tabpanel" class="tab-pane fade" id="tab-2">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Hakkımızda</label>
                                    <textarea name="about_us" class="m-0" data-plugin="summernote" data-options="{height: 250}"><?php echo $settings->about_us ?></textarea>
                                </div>
                            </div>
                        </div><!-- .tab-pane  -->

                        <div role="tabpanel" class="tab-pane fade" id="tab-3">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Misyonumuz</label>
                                    <textarea name="mission" class="m-0" data-plugin="summernote" data-options="{height: 250}"><?php echo $settings->mission ?></textarea>
                                </div>
                            </div>
                        </div><!-- .tab-pane  -->

                        <div role="tabpanel" class="tab-pane fade" id="tab-4">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Vizyonumuz</label>
                                    <textarea name="vision" class="m-0" data-plugin="summernote" data-options="{height: 250}"><?php echo $settings->vision ?></textarea>
                                </div>
                            </div>
                        </div><!-- .tab-pane  -->

                        <div role="tabpanel" class="tab-pane fade" id="tab-5">
                            <div class="row">

                                <div class="form-group col-md-8">
                                    <label>E-posta Adresiniz</label>
                                    <input class="form-control" placeholder="Şirketinize ait e-posta adresi"
                                        name="email"
                                        value="<?php echo $settings->email ?>">
                                </div>

                            </div>

                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label>Facebook</label>
                                    <input class="form-control" placeholder="Facebook Adresiniz" name="facebook"
                                        value="<?php echo $settings->facebook ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Twitter</label>
                                    <input class="form-control" placeholder="Twitter Adresiniz" name="twitter"
                                        value="<?php echo $settings->twitter ?>">
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Instagram</label>
                                    <input class="form-control" placeholder="Instagram Adresiniz" name="instagram"
                                        value="<?php echo $settings->instagram ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Linkedin</label>
                                    <input class="form-control" placeholder="Linkedin Adresiniz" name="linkedin"
                                        value="<?php echo $settings->linkedin ?>">
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab-7">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Görsel Seçiniz</label>
                                    <input type="file" name="logo" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <img src="<?php echo base_url("uploads/logo/$settings->logo") ?>" width="100" height="100">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-md">Güncelle</button>
        </form>
    </main>

    <?php $this->load->view('back/includes/footer_script') ?>