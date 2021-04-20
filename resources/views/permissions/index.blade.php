@extends('layouts.main')

@section('content')
    {!! $dataTable->table() !!}
@endsection

@push('scripts')
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {{$dataTable->scripts()}}
@endpush
