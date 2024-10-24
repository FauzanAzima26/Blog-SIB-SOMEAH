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
