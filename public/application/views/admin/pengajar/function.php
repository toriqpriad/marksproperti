<script>
    var url = '<?php echo ADMIN_WEBAPP_URL; ?>';
    function setpassword() {
        var pass = $('#password').val();
        $('#new_password').val(pass);
    }

    function Add() {
        var nama = $('#nama').val();
        var kelamin = $('input[name="jnsklmn"]:checked').val();
        var tmp_lahir = $('#tmp_lahir').val();
        var tgl_lahir = $('#tgl_lahir').val();
        var pkwn = $('input[name="pkwn"]:checked').val();
        var sts = $('#sts').val();
        var tpq = $('#tpq').val();
        var kontak = $('#kontak').val();
        var alamat = $('#alamat').val();
        var email = $('#email').val();
        var password = $.md5($('#password').val());
        var foto = $('#foto').prop('files')[0];
        var pdkn = $('#pdkn').val();
        var pdkn_ket = $('#pdkn_ket').val();
        var input = new FormData();
        input.append('nama', nama);
        input.append('kelamin', kelamin);
        input.append('tmp_lahir', tmp_lahir);
        input.append('tgl_lahir', tgl_lahir);
        input.append('pkwn', pkwn);
        input.append('sts', sts);
        input.append('tpq', tpq);
        input.append('kontak', kontak);
        input.append('email', email);
        input.append('password', password);
        input.append('alamat', alamat);
        input.append('foto', foto);
        input.append('pdkn', pdkn);
        input.append('pdkn_ket', pdkn_ket);

//        console.log(input);

        $.ajax({
            url: url + 'pengajar/add_submit',
            method: 'POST',
            data: input,
            dataType: 'json',
            contentType: 'application/json',
            cache: false,
            contentType: false,
                    processData: false,
            success: function (response) {
                if (response.response == 'OK') {
                    $.notify({
                        message: '<i class="mdi mdi-check-all"></i> ' + response.message,
                    }, {type: 'success'})
                    setTimeout(function ()
                    {
                        window.location.href = response.data.link;
                        location.reload();
                        console.log(JSON.stringify(response));
                    }, 1000);
                } else {
                    $.notify({
                        message: '<i class="mdi mdi-close"></i> ' + response.message,
                    }, {type: 'danger'})
                }
            }
        });
    }


    function Put() {
        var id = $('#pengajar_id').val();
        var nama = $('#nama').val();
        var kelamin = $('input[name="jnsklmn"]:checked').val();
        var tmp_lahir = $('#tmp_lahir').val();
        var tgl_lahir = $('#tgl_lahir').val();
        var pkwn = $('input[name="pkwn"]:checked').val();
        var sts = $('#sts').val();
        var tpq = $('#tpq').val();
        var old_tpq = $('#old_tpq').val();
        var kontak = $('#kontak').val();
        var alamat = $('#alamat').val();
        var email = $('#email').val();
        var foto = $('#foto').prop('files')[0];
        var pdkn = $('#pdkn').val();
        var pdkn_ket = $('#pdkn_ket').val();
        if ($('#new_password').val() == '') {
            var password = '';
        } else {
            var password = $.md5($('#new_password').val());
        }
        var old_foto = $('#foto_old').val();
        var new_foto = $('#foto_new').val();

        if (new_foto != undefined) {
            var foto = $('#foto').prop('files')[0];
        } else {
            var foto = '';
        }


        var input = new FormData();
        input.append('id', id);
        input.append('nama', nama);
        input.append('kelamin', kelamin);
        input.append('tmp_lahir', tmp_lahir);
        input.append('tgl_lahir', tgl_lahir);
        input.append('pkwn', pkwn);
        input.append('sts', sts);
        input.append('tpq', tpq);
        input.append('old_tpq', old_tpq);
        input.append('kontak', kontak);
        input.append('email', email);
        input.append('password', password);
        input.append('alamat', alamat);
        input.append('foto', foto);
        input.append('old_foto', old_foto);
        input.append('pdkn', pdkn);
        input.append('pdkn_ket', pdkn_ket);

//        console.log(input);

        $.ajax({
            url: url + 'pengajar/update_submit',
            method: 'POST',
            data: input,
            dataType: 'json',
//            contentType: 'application/json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.response == 'OK') {
                    $.notify({
                        message: '<i class="mdi mdi-check-all"></i> ' + response.message,
                    }, {type: 'success'})
                    setTimeout(function ()
                    {
                        window.location.href = response.data.link;  
                    }, 1000);
                } else {
                    $.notify({
                        message: '<i class="mdi mdi-close"></i> ' + response.message,
                    }, {type: 'danger'})
                }
            }
        });
    }

    function Delete(id) {        
        $('#deleteModal').modal('show');
        $('#id').val(id);
    }

    function DeleteProcess() {
        var id = $('#id').val();
        $.ajax({
            url: url + 'pengajar/delete/' + id,
            method: 'GET',
            dataType: 'json',
//            contentType: 'application/json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.response == 'OK') {
                    $.notify({
                        message: '<i class="mdi mdi-check-all"></i> ' + response.message,
                    }, {type: 'success'})
                    setTimeout(function ()
                    {
                        location.reload();
                    }, 1000);
                } else {
                    $.notify({
                        message: '<i class="mdi mdi-close"></i> ' + response.message,
                    }, {type: 'danger'})
                }
            }
        });
    }
</script>