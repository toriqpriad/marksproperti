<script>
    var url = '<?= ADMIN_WEBAPP_URL; ?>admin/';

    function logoutModal() {
        $('#logoutModal').modal('show');
    }

    function logoutProcess() {
        $.ajax({
            url: url + 'logout',
            method: 'GET',
            success: function (response) {
                setTimeout(function ()
                {
                    window.location.href = "<?= site_url(); ?>login";
                }, 1000);
            }
        });
    }   

    function saveguidestatus(seq) {
        var status = $("#status_option option:selected").val();
        var seq = seq;
        var input = {seq: seq, status: status};

        $.ajax({
            url: url + 'admin/guide/change_status',
            method: 'POST',
            data: JSON.stringify(input),
            dataType: 'json',
            contentType: 'application/json',
            success: function (response) {
                $('#changestatusguide').modal('hide');
                if (response.response == 'OK') {
                    toastr.success(response.message);
                    setTimeout(function ()
                    {
                        location.reload();
                    }, 1000);

                } else {
                    toastr.warning(response.message)
                }
            }
        });
    }
</script>

