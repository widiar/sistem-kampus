$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(".verif, .notverif").submit(function(e){
        e.preventDefault();
        var name = $(this).attr('class');
        if (name == 'verif'){
            var text = 'Anda akan memverifikasi mahasiswa ini.';
            var berhasil = 'Berhasil memverfikasi mahasiswa';
            var gagal = 'Gagal memverifikasi mahasiswa';
        }else{
            text = 'Anda tidak jadi memverifikasi mahasiswa ini.'
            berhasil = 'Berhasil tidak jadi memverfikasi mahasiswa';
            gagal = 'Gagal tidak jadi memverifikasi mahasiswa';
        }
        Swal.fire({
            title: "Anda Yakin?",
            text: text,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yap!",
        }).then((result) => {
            if (result.isConfirmed){
                $.ajax({
                    type: "PATCH",
                    url: $(this).attr("action"),
                    success: function (msg) {
                        if (msg == "Sukses") {
                            Swal.fire(
                                "Berhasil!",
                                berhasil,
                                "success"
                            ).then((result) => {
                                if (result.value) {
                                    window.location.href = $(location).attr(
                                        "href"
                                    );
                                }
                            });
                        } else {
                            Swal.fire(
                                "Gagal",
                                gagal,
                                "error"
                            );
                        }
                    },
                });
            }
        });
    });
});