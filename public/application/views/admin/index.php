<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title><?= $title_page ?></title>    
        <?php $this->load->view('admin/static/files'); ?>    
        <script src="<?= BACKEND_STATIC_FILES ?>plugins/jquery-countto/jquery.countTo.js"></script>
    </head>

    <?php
    $this->load->view('admin/include/function');
    $this->load->view('admin/include/modal');
    $this->load->view('admin/include/top_menu');
    $this->load->view('admin/include/sidebar_menu');
    ?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-blue-grey hover-expand-effect">
                        <div class="icon">
                            <i class="mdi mdi-flag-variant   mdi-36px"></i>
                        </div>
                        <div class="content">
                            <div class="text">Kategori Properti</div>
                            <div class="number count-to" data-from="0" data-to="<?=$total_data['kategori_properti']?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="mdi mdi-home mdi-36px"></i>
                        </div>
                        <div class="content">
                            <div class="text">Properti</div>
                            <div class="number count-to" data-from="0" data-to="<?=$total_data['properti']?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="mdi mdi-file-document mdi-36px"></i>
                        </div>
                        <div class="content">
                            <div class="text">Artikel</div>
                            <div class="number count-to" data-from="0" data-to="<?=$total_data['artikel']?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="mdi mdi-tag-multiple mdi-36px"></i>
                        </div>
                        <div class="content">
                            <div class="text">Iklan</div>
                            <div class="number count-to" data-from="0" data-to="<?=$total_data['iklan']?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="mdi mdi-book-open-page-variant mdi-36px"></i>
                        </div>
                        <div class="content">
                            <div class="text">Portfolio</div>
                            <div class="number count-to" data-from="0" data-to="<?=$total_data['portfolio']?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-deep-purple hover-expand-effect">
                        <div class="icon">
                            <i class="mdi mdi-incognito mdi-36px"></i>
                        </div>
                        <div class="content">
                            <div class="text">Developer</div>
                            <div class="number count-to" data-from="0" data-to="<?=$total_data['developer']?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->

        </div>
    </section>
    <!-- Jquery Core Js -->

    <?php $this->load->view('admin/include/footer_menu'); ?>

</html>