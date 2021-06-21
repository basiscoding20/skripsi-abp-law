$(document).ready(function () {
    if($('.delete-data').length > 0){
        $('.delete-data').click(function(e){
            e.preventDefault();

            var id = $(this).data('id');
            var url = $(this).attr('href');
            var token = $("meta[name='csrf-token']").attr("content");
            swal({
                title: 'Apakah anda yakin ?',
                text: 'Ingin menghapus data ini!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Ya, Hapus!',
                closeOnConfirm: false,
            },function() {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        '_token': token, 'id': id
                    },
                    success: function (response) {
                        if (response.status == 'success') {
                            swal('Deleted!', response.message, 'success')
                        } else {
                            swal('Gagal!', response.message, 'error')
                        }
                    }
                });
                setTimeout((function() {
                    window.location.reload();
                }), 1500);
            });
        })
    }
});