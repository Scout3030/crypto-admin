@extends('layouts.main')

@section('content')
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-12">
            <div class="contLogin w-100">

                @livewire('user-create', ['id' => $id])

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
