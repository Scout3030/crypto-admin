@extends('layouts.main')

@section('content')
    <div class="row">
        <h2>@if($user) Edit @else Create @endif User</h2>
    </div>
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            {!!  implode('', $errors->all('<div>:message</div>'))  !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <form action="{{route('user.store')}}" method="POST">
            @csrf
            @if($user)
                <input type="hidden" value="{{$user->id }}" name="id">
            @endif
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first-name">First Name</label>
                    <input type="text"
                           class="form-control"
                           id="first-name"
                           name="first_name"
                           value="{{old('first_name', $user->first_name ?? '')}}"
                    >
                </div>
                <div class="form-group col-md-6">
                    <label for="last-name">Last Name</label>
                    <input type="text"
                           class="form-control"
                           id="last-name"
                           name="last_name"
                           value="{{old('last_name', $user->last_name ?? '')}}"
                    >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email"
                           class="form-control"
                           id="email"
                           name="email"
                           value="{{old('email', $user->email ?? '')}}"
                    >
                </div>
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Store</button>
        </form>

    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

        })
    </script>
@endpush
