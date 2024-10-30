@extends('layouts.app')

@push('js')
    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}
@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <x-card icon="Dashboard" title="Dashboard">
                {!! $chart->container() !!}
            </x-card>
        </div>
    </div>
</div>

@endsection