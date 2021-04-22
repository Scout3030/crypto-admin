@extends('layouts.main')

@section('content')
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-12">
            <div class="contLogin w-100">
                <h2>Edit User</h2>
                <livewire:profile-edit />
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $('#timezone').select2();
            $('#timezone').on('change', function (e) {
                var data = $('#timezone').select2('val');
                Livewire.emit('setTimezone', data);
            });


        });
    </script>

@endpush
