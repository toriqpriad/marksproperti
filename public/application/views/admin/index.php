<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sigrus - LDII Kota Wisata Batu</title>    
    <?php $this->load->view('static/files'); ?>    
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
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="info-box bg-pink hover-expand-effect">
                            <div class="icon">
                                <i class="mdi mdi-domain mdi-36px"></i>
                            </div>
                            <div class="content">
                                <div class="text">TPQ</div>
                                <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="info-box bg-cyan hover-expand-effect">
                            <div class="icon">
                                <i class="mdi mdi-human-greeting mdi-36px"></i>
                            </div>
                            <div class="content">
                                <div class="text">Pengajar</div>
                                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="info-box bg-light-green hover-expand-effect">
                            <div class="icon">
                                <i class="mdi mdi-human-male-female mdi-36px"></i>
                            </div>
                            <div class="content">
                                <div class="text">Siswa</div>
                                <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
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