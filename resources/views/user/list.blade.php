@extends('layouts.main')

@section('content')
    <div class="row">
        <h2>Users list</h2>
    </div>
    <div class="row">
        <div class="">
            <div>
                <form>
                    <div class="form-row">
                        <div class="col-auto">
                            <input class="form-control mb-2" type="text" placeholder="Search" name="search">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-info mb-2" type="submit">Find</button>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <a href="{{route('user.create')}}" class="btn btn-info">Create</a>
            </div>
        </div>
        <div class="table-responsive">
            <table id="user" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            {{$user->first_name}}
                        </td>
                        <td>
                            {{$user->last_name}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            {{$user->roles}}
                        </td>
                        <td>
                            <button class="btn btn-outline-primary">EDIT</button>
                            <button class="btn btn-outline-danger"
                                    onclick="deleteUser({{$user->id}}, '{{route('user.delete', $user->id)}}')">DELETE
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <div class="row">
        {{$users->links()}}
    </div>


@endsection

@push('scripts')
    <script>
        function deleteUser(id, url) {
            $.ajax({
                url: url,
                method: 'delete',
                success: function (res) {
                    window.location.reload(true);
                    //window.location.href = window.location.href
                }
            })
        }

        $(document).ready(function () {

        })
    </script>
@endpush
