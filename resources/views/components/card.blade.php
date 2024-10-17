@props([
    'title' => '',
    'icon' => ''
])
<div class="card">
    <div class="card-header"><i class="fa fa-{{ $icon }}"> {{ $title }} </i></div>

    <div class="card-body">
        {{ $slot }}
    </div>
</div>