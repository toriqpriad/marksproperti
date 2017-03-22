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
    $this->load->view('admin/properti/function');
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
                            <p><small>Isi form di bawah ini untuk menambahkan data properti terbaru : </small></p>
                        </div>
                        <div class="body">

                            <div class="row clearfix">                                        
                                <div class="col-sm-12">
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Judul</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="judul">
                                        </div>
                                    </div>                                                  
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Deskripsi</label>
                                        <div class="form-line">
                                            <textarea id="deskripsi" class="form-control"></textarea>
                                        </div>
                                    </div>                                                  
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Alamat</label>
                                        <div class="form-line">
                                            <textarea id="alamat" class="form-control"></textarea>
                                        </div>
                                    </div>                                                  
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Kategori</label>
                                        <div class="form-line">
                                            <select id="kat_properti" class="form-control" >                                                                      
                                                <?php
                                                if (isset($kat_properti)) {
                                                    if ($kat_properti != "") {
                                                        foreach ($kat_properti as $each) {
                                                            ?>
                                                            <option value="<?= $each->id ?>"><?= $each->nama ?></option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>                                                  
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Jenis</label>
                                        <div class="form-line">
                                            <select id="kat_properti" class="form-control">                                                
                                                <option value='0'>Dijual</option>
                                                <option value='1'>Disewakan</option>                                                
                                            </select>
                                        </div>
                                    </div>  
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Sertifikat</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="sertifikat">
                                        </div>
                                    </div>                                                  
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Luas Tanah</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="luas_tanah">
                                        </div>
                                    </div>                                                  
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Luas Bangunan</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="luas_bangunan">
                                        </div>
                                    </div>                                                  
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Kamar Tidur</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="kamar_tidur">
                                        </div>
                                    </div>                                                  
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Kamar Mandi</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="kamar_mandi">
                                        </div>
                                    </div>                                                  
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Harga</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="harga">
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