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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="<?= BACKEND_STATIC_FILES ?>plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
        <script src="<?= BACKEND_STATIC_FILES ?>plugins/bootstrap-select/js/bootstrap-select.js"></script>        
        <script src="<?= BACKEND_STATIC_FILES ?>plugins/momentjs/moment.js"></script>        
        <link href="<?= BACKEND_STATIC_FILES ?>plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
        <script src="<?= BACKEND_STATIC_FILES ?>plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>        
    </head>

    <?php
    $this->load->view('admin/include/function');
    $this->load->view('admin/include/modal');
    $this->load->view('admin/include/top_menu');
    $this->load->view('admin/include/sidebar_menu');
    $this->load->view('admin/pengajar/function');
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
                            <p><small>Isi form di bawah ini untuk menambahkan data pengajar terbaru : </small></p>
                        </div>
                        <div class="body">
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">                                
                                <li role="presentation" class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Profil</a></li>                                
                                <li role="presentation" class=""><a href="#pendidikan" data-toggle="tab" aria-expanded="false">Pendidikan</a></li>                                                                
                                <li role="presentation" class=""><a href="#akses" data-toggle="tab" aria-expanded="false">Akses</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="profile">                                                                        
                                    <div class="row clearfix">                                        
                                        <div class="col-sm-7">
                                            <div class="form-group form-float form-group-md">
                                                <label class="form-label">Nama</label>
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="nama">
                                                </div>
                                            </div>              
                                            <div class="form-group form-float form-group-md">
                                                <label class="form-label">Jenis Kelamin</label>

                                                <div class="demo-radio-button">                                                        
                                                    <input type="radio" id="radio_pria" name="jnsklmn" value="L">
                                                    <label for="radio_pria">Laki - Laki</label>
                                                    <input  type="radio" id="radio_wanita" name="jnsklmn" value="P">
                                                    <label for="radio_wanita">Perempuan</label>
                                                </div>

                                            </div>  

                                            <div class="form-group form-float form-group-md">
                                                <label class="form-label">Tempat Lahir</label>
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="tmp_lahir">
                                                </div>
                                            </div>                                    

                                            <div class="form-group form-float form-group-md">
                                                <label class="form-label">Tanggal Lahir</label>
                                                <div class="form-line">
                                                    <input type="text" class="datepicker form-control" placeholder="Please choose a date..." id="tgl_lahir">
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="col-md-5">
                                            <p><label class="form-label">Foto</label></p>                                            
                                            <input type="hidden" id="max_num_gallery" value=''>                                                                                                                                                

                                            <img id="output_foto" style="width:60%" class="img img-thumbnail" src="http://vignette3.wikia.nocookie.net/lego/images/a/ac/No-Image-Basic.png/revision/latest?cb=20130819001030"/>
                                            <br><br>
                                            <input type="file" accept="image/*" class="" name="foto" onchange="load(event)" id="foto">                                            
                                            <script>
                                                var load = function (event) {
                                                    var output = document.getElementById('output_foto');
                                                    output.src = URL.createObjectURL(event.target.files[0]);
                                                };
                                            </script>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="form-group form-float form-group-md">
                                                <label class="form-label">Status Pernikahan</label>

                                                <div class="demo-radio-button">                                                        
                                                    <input type="radio" id='radio_lajang' name="pkwn" value="L">
                                                    <label for="radio_lajang">Lajang</label>
                                                    <input  type="radio" id='radio_menikah' name="pkwn" value="M">
                                                    <label for="radio_menikah">Menikah</label>
                                                </div>    
                                            </div>

                                            <div class="form-group form-float form-group-md">
                                                <label class="form-label">Status Pengajar</label>
                                                <div class="form-line">
                                                    <select class="form-control" id="sts">
                                                        <option value="MT">Mubalegh/ot Tugasan</option>                                                
                                                        <option value="MS">Mubalegh/ot Setempat</option>                                                
                                                        <option value="PB">Pribumi</option>                                                                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group form-float form-group-md">
                                                <label class="form-label">TPQ</label>                                                    
                                                <div class="form-line">

                                                    <select class="form-control" id="tpq">                                                                                                                
                                                        <?php
                                                        if (isset($tpq)) {
                                                            foreach ($tpq as $opt) {
                                                                echo '<option value="' . $opt->id . '">' . $opt->nama . ' - ' . $opt->wilayah . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group form-float form-group-md">
                                                <label class="form-label">Kontak</label>
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="kontak">

                                                </div>
                                            </div>
                                            <div class="form-group form-float form-group-md">
                                                <label class="form-label">Alamat</label>
                                                <div class="form-line">
                                                    <textarea class="form-control" id="alamat"></textarea>
                                                </div>
                                            </div> 

                                        </div>
                                    </div>

                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="pendidikan">
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Pendidikan Terakhir</label>
                                        <div class="form-line">
                                            <select class="form-control" id="pdkn">
                                                <option value="SD">SD</option>                                                
                                                <option value="SMP">SMP</option>                                                
                                                <option value="SMA">SMA</option>                                                
                                                <option value="DPL">Diploma</option> 
                                                <option value="SRJ">Sarjana</option>                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Keterangan</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="pdkn_ket" placeholder="Nama sekolah / instansi - kelas / jurusan ">
                                        </div>
                                    </div>
                                </div>                                                                
                                <div role="tabpanel" class="tab-pane fade" id="akses">
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Email</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="email">

                                        </div>
                                    </div>                                    
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Password</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="password">

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
    <script>
        $('#tgl_lahir').bootstrapMaterialDatePicker({time: false, format: 'DD-MM-YYYY'});
    </script>
    <?php $this->load->view('admin/include/footer_menu'); ?>

</html>