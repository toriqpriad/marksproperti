<script>
    var url = '<?php echo ADMIN_WEBAPP_URL; ?>';
    function setpassword() {
        var pass = $('#password').val();
        $('#new_password').val(pass);
    }

    function Add() {

        var nama = $('#nama').val();
        var pc = $('#pc').val();
        var kontak = $('#kontak').val();
        var alamat = $('#alamat').val();
        var wilayah = $('#wilayah').val();
        var email = $('#email').val();
        var password = $.md5($('#password').val());
        var pgrs = [];
        $(".nama_pgrs").each(function (index, item) {
            var id_kategori_pgrs = $(item).attr('param');
            var nama_pgrs = $(item).val();
            if (nama_pgrs == undefined) {
                nama_pgrs = '';
            }
            var data_pgrs = {"id": id_kategori_pgrs, "nama": nama_pgrs}
            pgrs.push(data_pgrs)
        })
        var logo = $('#logo').prop('files')[0];
        var cover = $('#cover').prop('files')[0];

        var input = new FormData();
        input.append('nama', nama);
        input.append('pc', pc);
        input.append('kontak', kontak);
        input.append('email', email);
        input.append('password', password);
        input.append('alamat', alamat);
        input.append('wilayah', wilayah);
        input.append('pengurus', JSON.stringify(pgrs));
        input.append('logo', logo);
        input.append('cover', cover);

        console.log(input);

        $.ajax({
            url: url + 'tpq/add_submit',
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
//                        location.reload();
//                    console.log(JSON.stringify(response));
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
        var id = $('#tpq_id').val();
        var nama = $('#nama').val();
        var pc = $('#pc').val();
        var kontak = $('#kontak').val();
        var alamat = $('#alamat').val();
        var wilayah = $('#wilayah').val();
        var email = $('#email').val();
        if ($('#new_password').val() == '') {
            var password = '';
        } else {
            var password = $.md5($('#new_password').val());
        }
        var pgrs = [];
        $(".nama_pgrs").each(function (index, item) {
            var id_kategori_pgrs = $(item).attr('param');
            var nama_pgrs = $(item).val();
            if (nama_pgrs == undefined) {
                nama_pgrs = '';
            }
            var data_pgrs = {"id": id_kategori_pgrs, "nama": nama_pgrs}
            pgrs.push(data_pgrs)
        })
        var old_logo = $('#logo_old').val();
        var new_logo = $('#logo_new').val();

        var new_cover = $('#cover_new').val();
        var old_cover = $('#cover_old').val();

        if (new_logo != undefined) {
            var logo = $('#logo').prop('files')[0];
        } else {
            var logo = 'old';
        }

        if (new_cover != undefined) {
            var cover = $('#cover').prop('files')[0];
        } else {
            var cover = 'old';
        }

        var input = new FormData();
        input.append('id', id);
        input.append('nama', nama);
        input.append('pc', pc);
        input.append('kontak', kontak);
        input.append('email', email);
        input.append('password', password);
        input.append('alamat', alamat);
        input.append('wilayah', wilayah);
        input.append('pengurus', JSON.stringify(pgrs));
        input.append('old_logo', old_logo);
        input.append('old_cover', old_cover);
        input.append('logo', logo);
        input.append('cover', cover);

//        console.log(input);

        $.ajax({
            url: url + 'tpq/update_submit',
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
        $('#deleteTpqModal').modal('show');
        $('#id').val(id);
        

    }

    function DeleteTpqProcess() {
        var id = $('#id').val();        
        $.ajax({
            url: url + 'tpq/delete/' + id,
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