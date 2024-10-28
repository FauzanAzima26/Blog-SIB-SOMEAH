let submit_method;

$(document).ready(function () {
    writerTable();
});

// datatable serverside
function writerTable() {
    $("#yajra").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        // pageLength: 20, // set default records per page
        ajax: "writer-serverside",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "email",
                name: "email",
            },
            {
                data: "created_at",
                name: "created_at",
            },
            {
                data: "is_verified",
                name: "is_verified",
            },
            {
                data: "action",
                name: "action",
                orderable: true,
                searchable: true,
            },
        ],
    });
}

const editData = (e) => {
    let id = e.getAttribute("data-id");

    Swal.fire({
        title: "Edit Writer",
        text: "Apakah anda yakin ingin memverifikasi writer ini?",
        showCancelButton: true,
        confirmButtonText: "Verify",
        cancelButtonText: "Cancel",
        allowOutsideClick: false,
        showCloseButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            startLoading();

            let isVerified = true;

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "PUT", // Menggunakan metode PUT untuk mengupdate data
                url: "/admin/writer/" + id,
                data: {
                    is_verified: isVerified, // Mengirimkan status verifikasi
                },
                dataType: "json",
                success: function (response) {
                    reloadTable(); // Memuat ulang tabel untuk menampilkan data terbaru
                    toastSuccess(response.message); // Menampilkan pesan sukses
                },
                error: function (response) {
                    // Menampilkan pesan kesalahan jika terjadi error
                    let errorMessage =
                        response.responseJSON.message ||
                        "Terjadi kesalahan saat memperbarui data.";
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: errorMessage,
                    });
                },
                complete: function () {
                    stopLoading(); // Menghentikan loading
                },
            });
        }
    });
};
