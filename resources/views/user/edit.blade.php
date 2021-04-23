@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="titleMain">
        <h1>Admin Users</h1>
    </div>
    <div class="content card">
        <div class="card-body">
            <div class="row">

                @livewire('user-create', ['id' => $id])
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            $('#roles').on('change', function (e) {
                var data = $('#roles').val();
                Livewire.emit('setRole', data);
            });

            $('#roles').on('change', function (e) {
                var data = $('#roles').val();
                Livewire.emit('setRole', data);
            });

            $("input[name=status]").change(function () {
			    var data = $(this).val();
                Livewire.emit('setStatus', data);
			});
        })
    </script>
@endpush
