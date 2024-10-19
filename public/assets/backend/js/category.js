let submitMethod;

$(document).ready(function () {
    $("#example").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: '/admin/serverside', // URL untuk mengambil data
            type: "GET",
        },
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "name", name: "name" },
            { data: "slug", name: "slug" },
            {
                data: "action",
                name: "action",
                orderable: true,
                searchable: true,
            },
        ],
    });
});

const destroyCategory = (e) => {
    let id = e.getAttribute("data-id");

    Swal.fire({
        title: "Are you sure?",
        text: "Do you want delete this category?",
        icon: "question",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        confirmButtonColor: "#d33",
        cancelButtonColor: "#007bff",
        allowOutsideClick: false,
        showCancelButton: true,
        showCloseButton: true,
    }).then((result) => {
        startLoading();

        if (result.value) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "DELETE",
                url: "/admin/category/" + id,
                dataType: "json",
                success: function (response) {
                    reloadTable();
                    toastSuccess(response.message);
                },
                error: function (response) {
                    console.log(response);
                },
            });
        }
    });
};

// Form Create
const modalCategory = (e) => {
    resetForm("#formCategory");
    $("#modalCategory").modal("show");
    $(".modalTitle").html('<i class="fa fa-plus"></i> Create');
    $(".btnSubmit").html('<i class="fa fa-save"></i> Save');
    resetValidation();
};

// create/save data
$("#formCategory").on("submit", function (e) {
    e.preventDefault();
    startLoading();

    let url, method;
    url = "/admin/category";
    method = "POST";

    const dataInput = new FormData(this);

    if (submitMethod == "edit") {
        url = "/admin/category/" + $("#id").val();
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
            $("#modalCategory").modal("hide");
            reloadTable();
            toastSuccess(response.message);
            resetValidation();
        },
        error: function (jqXHR, response) {
            console.log(response.message);
            toastError(jqXHR.responseText);
        },
    });
})

const editCategory = (e) => {
    let id = e.getAttribute("data-id");
    
    startLoading();
    resetForm("#formCategory");
    resetValidation();

    $.ajax({
        type: "GET",
        url: "/admin/category/" + id, 
        success: function (response) {
            let parsedData = response.data;

            $('#id').val(parsedData.uuid);
            $('#name').val(parsedData.name);
            $('#modalCategory').modal('show');
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
}
