<?php //$this->load->view('admin/pages/include/main');      ?>
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ganti Password</h4>
            </div>
            <div class="modal-body">                
                <div class="form-group form-float form-group-md">
                    <label class="form-label">Masukkan Password Lama</label>
                    <div class="form-line">
                        <input type="password" class="form-control" id="last_password" value="">
                    </div>
                </div>  
                <div class="form-group form-float form-group-md">
                    <label class="form-label">Masukkan Password Baru</label>
                    <div class="form-line">
                        <input type="password" class="form-control" id="new_password" value="">
                    </div>
                </div>                  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" onclick="ChangePasswordProcess()">Ya</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>

