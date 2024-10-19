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
    <script src="{{asset('assets/backend/js/helper.js')}}"></script>
    <script src="{{asset('assets/backend/js/category.js')}}"></script>
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\categoryRequest') !!}

@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <x-card icon="list" title="Categories">
                <button class="btn btn-primary" onclick="modalCategory(this)">Create</button>
                <div class="table-responsive-sm">
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

@include('backend.category._modal')

@endsection