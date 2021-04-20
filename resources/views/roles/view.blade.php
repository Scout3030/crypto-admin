@extends('layouts.main')

@section('content')
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-12">
            <div class="contLogin w-100">
                <h2>View Role {{$role->name}}</h2>
                <div class="mb-3">
                    <div>
                        <h3>Permissions</h3>
                    </div>
                    <div class="row">
                        @foreach($role->permissions as $permission)
                            <div class="mb-1 mr-2">
                                <span class="badge badge-success"
                                      style="background-color: #4a5568; ">{{$permission->name}}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <a href="{{route('roles.list')}}" class="btn btn-outline-info">Back</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

        })
    </script>
@endpush
