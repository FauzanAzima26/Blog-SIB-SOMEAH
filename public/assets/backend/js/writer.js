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

    startLoading();
    resetForm("#formWriter");
    resetValidation();

    $.ajax({
        type: "GET",
        url: "/admin/writer/" + id,
        success: function (response) {
            let parsedData = response.data;

            $("#id").val(parsedData.id);
            $("#is_verified").val(parsedData.is_verified);
            $("#modalWriter").modal("show");
            $(".modalTitle").html('<i class="fa fa-edit"></i> Edit');
            $(".btnSubmit").html('<i class="fa fa-save"></i> Update');

            submitMethod = "edit";

            stopLoading();
        },
        error: function (jqXHR, response) {
            console.log(jqXHR.responseText);
            toastError(jqXHR.responseText);
        },
    });
};

// saveCreate
$("#formWriter").on("submit", function (e) {
    e.preventDefault();
    startLoading();

    let url, method;
    url = "/admin/writer";
    method = "POST";

    const dataInput = new FormData(this);

    if (submitMethod == "edit") {
        url = "/admin/writer/" + $("#id").val();
        dataInput.append("_method", "PUT");
    }

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: method,
        url: url,
        data: dataInput,
        contentType: false,
        processData: false,
        success: function (response) {
            $("#modalWriter").modal("hide");
            reloadTable();
            toastSuccess(response.message);
            resetValidation();
        },
        error: function (jqXHR, response) {
            console.log(response.message);
            toastError(jqXHR.responseText);
        },
    });
});