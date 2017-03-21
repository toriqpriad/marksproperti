<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title><?= $title_page ?></title>         
        <?php
        $this->load->view('static/files');
        ?>    
        <link href="<?= BACKEND_STATIC_FILES ?>plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
        <script src="<?= BACKEND_STATIC_FILES ?>plugins/bootstrap-select/js/bootstrap-select.js"></script>
        <script src="<?= BACKEND_STATIC_FILES ?>js/pages/forms/basic-form-elements.js"></script>
    </head>

    <?php
    $this->load->view('admin/include/function');
    $this->load->view('admin/kategori_properti/function');
    $this->load->view('admin/include/modal');
    $this->load->view('admin/include/top_menu');
    $this->load->view('admin/include/sidebar_menu');
    ?>


    <section class="content">
        <div class="container-fluid">            
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?= $title_page ?>
                            </h2>                 
                            <p><small>Isi form di bawah ini untuk menambahkan data kategori properti terbaru : </small></p>
                        </div>
                        <div class="body">

                            <div class="row clearfix">                                        
                                <div class="col-sm-12">
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Nama</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="nama">
                                        </div>
                                    </div>                                                  
                                </div>
                            </div>
                            <div class="text-right"><button type="button " class="btn bg-teal btn-lg waves-effect" onclick="Add()">Simpan</button></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
        <!-- Exportable Table -->
    </section>     
    <?php $this->load->view('admin/include/footer_menu'); ?>

</html>