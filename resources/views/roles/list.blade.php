@extends('layouts.main')

@section('content')
    <div class="row">
        <h2>Roles list</h2>
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
            @can('role-create')
                <div>
                    <a href="{{route('roles.create')}}" class="btn btn-info">Add Role</a>
                </div>
            @endcan
        </div>
        <div class="table-responsive">
            <table id="user" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Role Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>
                            {{$role->id}}
                        </td>
                        <td>
                            {{$role->name}}
                        </td>
                        <td>
                            @if($role->name !== 'Root')
                                <a href="{{route('roles.view', $role->id)}}" class="btn btn-outline-primary">VIEW</a>
                                @can('role-edit')
                                    <a href="{{route('roles.edit', $role->id)}}"
                                       class="btn btn-outline-primary">EDIT</a>
                                @endcan
                                @can('role-delete')
                                    <button type="button" class="btn btn-outline-danger delete"
                                            data-name="{{$role->name}}"
                                            data-url="{{route('ajax.roles.delete', $role->id)}}"
                                    >
                                        DELETE
                                    </button>
                                @endcan
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                </div>
                <div class="modal-body">
                    Aru you sure want to delete <span class="user-name"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" onclick="closeModal()">Close</button>
                    <button type="button" class="btn btn-outline-danger confirm-delete">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        let userName;
        let deleteUrl;

        function deleteUser() {
            $.ajax({
                url: deleteUrl,
                method: 'delete',
                success: function (res) {
                    window.location.reload(true);
                }
            })
        }

        function changeOTPStatus(id, status) {
            $.ajax({
                url: '{{route('ajax.users.otp.status')}}',
                data: {
                    id,
                    status,
                },
                method: 'post',
                error: function (err) {
                    console.log(err);
                }
            })
        }

        function closeModal() {
            $('#deleteModal').modal('hide');
        }

        $(document).ready(function () {
            $('.otp-required').on('click', (function () {
                let id = $(this).attr('data-id');
                let status = $(this).prop('checked');
                changeOTPStatus(id, status);
            }));

            $('.delete').on('click', function () {
                userName = $(this).attr('data-name');
                deleteUrl = $(this).attr('data-url');
                $('.user-name').html(userName)

                $('#deleteModal').modal('show');
            })

            $('.confirm-delete').on('click', function () {
                deleteUser();
            })
        })
    </script>
@endpush
