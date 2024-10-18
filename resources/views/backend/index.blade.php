@extends('layouts.app')

@section('title', 'Categories')

@push('css')
    <!-- datatables -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">
@endpush

@push('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('serverside') }}", // URL untuk mengambil data
                    type: 'GET',
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'slug', name: 'slug' },
                    { data: 'action', name: 'action', orderable: true, searchable: true },
                ],
            });
        });

        const destroyCategory = (e) => {
            let id = e.getAttribute('data-id');

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
                showCloseButton: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: "/admin/category/" + id,
                        dataType: "json",
                        success: function (response) {
                            alert('ok');
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
                }
            })
        }
    </script>

@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <x-card icon="list" title="Categories">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</div>

@endsection