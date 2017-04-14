<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title><?= $title_page ?></title>       
        <?php
        $this->load->view('admin/static/files');
        $this->load->view('admin/static/table');
        ?>    
    </head>
    <?php
    $this->load->view('admin/include/function');
    $this->load->view('admin/artikel/function');
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
                        </div>
                        <div class="body">
                            <small>
                                <table class="table table-bordered table-striped table-hover dataTable table1">
                                    <thead>
                                        <tr>
                                            <th>#</th>                                        
                                            <th>Judul</th>                                            
                                            <th>Konten</th>
                                            <th>Tanggal Post</th>                                            
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>                               
                                    <tbody> 
                                        <?php
                                        $no = 1;
                                        if ($record != "") {
                                            foreach ($record as $item) {
                                                echo "<tr>";
                                                echo "<td>$no</td>";
                                                echo "<td>" . strip_tags(mb_strimwidth($item->judul, 0, 20, "...")) . "</td>";
                                                echo "<td>" . strip_tags(mb_strimwidth($item->content, 0, 30, "...")) . "</td>";
                                                echo "<td>" . $item->tgl_post . "</td>";
                                                echo "<td><a href='" . base_url() . 'admin/artikel/detail/' . $item->id . "' class='btn btn-success'>Detail</a>"
                                                . "&nbsp;<button class='btn btn-danger ' onclick='Delete(" . $item->id . ")'>Hapus</button></td>";
                                                echo "</tr>";
                                                $no++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </small>
                        </div>
                        <!-- #END# Widgets -->
                        <!-- CPU Usage -->

                    </div>

                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
        <!-- Exportable Table -->
    </section>

    <script>
        $('.table1').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        });
    </script>
    <?php $this->load->view('admin/artikel/modal'); ?>
    <?php $this->load->view('admin/include/footer_menu'); ?>

</html>