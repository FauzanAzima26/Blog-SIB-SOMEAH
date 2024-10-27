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
    let id = e.getAttribute('data-id');

    startLoading();
    resetValidation();

    $.ajax({
        type: "GET",
        url: "/admin/writer/" + id,
        success: function (response) {
            let parsedData = response.data;

            $('#id').val(parsedData.uuid);
            $('#name').val(parsedData.name);
            $('#modalWriter').modal('show');
            $('.modal-title').html('<i class="fa fa-edit"></i> Edit Writer');
            $('.btnSubmit').html('<i class="fa fa-save"></i> Save');

            submit_method = 'edit';

            stopLoading();
        },
        error: function (jqXHR, response) {
            console.log(jqXHR.responseText);
            toastError(jqXHR.responseText);
        }
    });
}
