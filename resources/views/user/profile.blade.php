@extends('layouts.main')

@section('content')
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-12">
            <div class="contLogin w-100">

                <div class="titleMain">
                    <h1>Profile</h1>
                    <p>Edit information</p>
                </div>
                <div class="content card">
                    <div class="card-body">
                        <livewire:profile-edit />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $('#timezone').select2({
                theme: 'flat'
            });
            $('#timezone').on('change', function (e) {
                var data = $('#timezone').select2('val');
                Livewire.emit('setTimezone', data);
            });

            $('#date_format').select2({
                theme: 'flat'
            });
            $('#date_format').on('change', function (e) {
                var data = $('#date_format').select2('val');
                Livewire.emit('setDateFormat', data);
            });

        });
    </script>

@endpush
