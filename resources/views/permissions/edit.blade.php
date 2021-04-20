@extends('layouts.main')

@section('content')
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-12">
            <div class="contLogin w-100">
                <h2>@if($permission->name ?? '') Edit @else Create @endif Permission</h2>
                @if ($permission)
                    <livewire:permission-edit :permission="$permission"/>
                @else
                    <livewire:permission-edit/>
                @endif
            </div>

        </div>
    </div>
@endsection


@push('css')
    @livewireStyles
@endpush
@push('scripts')
    @livewireScripts
@endpush

