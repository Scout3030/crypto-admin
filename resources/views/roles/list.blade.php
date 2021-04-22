@extends('layouts.main')

@section('content')
    <div class="titleMain">
        <h1>Admin Users</h1>
        <p>Roles Management / Roles List</p>
    </div>
    <div class="content card">
        <div class="card-header">
            <h4 class="card-title">Roles list
                @can('role-create')
                    <a href="{{route('roles.create')}}" class="btn btn-primary float-right"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Role</a>
                @endcan
            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="dataTablesInfo">
                    <div class="showSelect">
                        Show 
                            <select class="form-control">
                                <option>10</option>
                                <option>20</option>
                                <option>30</option>
                            </select>
                        entries
                    </div>
                    <form class="dataTables_filter">
                        <label>Search: <input type="text" placeholder="Search" name="search"></label>
                        <!-- <button class="btn btn-info mb-2" type="submit">Find</button> -->
                    </form>
                </div>

                <table id="user" class="table table-responsive-md">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role Name</th>
                            <th style="width: 150px;">Actions</th>
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
                                <div class="d-flex">
                                @if($role->name !== 'Root')
                                    <a href="{{route('roles.view', $role->id)}}" class="btn btn-success shadow btn-xs sharp">
                                        <i class="fa fa-eye" aria-hidden="true"></i></a>
                                    @can('role-edit')
                                        <a href="{{route('roles.edit', $role->id)}}"
                                           class="btn btn-primary shadow btn-xs sharp">
                                            <i class="fa fa-pencil"></i></a>
                                    @endcan
                                    @can('role-delete')
                                        <button type="button" class="btn btn-danger shadow btn-xs sharp delete"
                                                data-name="{{$role->name}}"
                                                data-url="{{route('ajax.roles.delete', $role->id)}}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    @endcan
                                @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="dataTablesInfo">
                    <div class="showEntries">
                        Showing 1 to 10 of 57 entries
                    </div>
                    <div class="dataTables_paginate paging_simple_numbers">
                        <a class="paginate_button previous disabled">Previous</a>
                        <a class="paginate_button current" >1</a>
                        <a class="paginate_button" >2</a>
                        <a class="paginate_button" >3</a>
                        <a class="paginate_button" >4</a>
                        <a class="paginate_button next">Next</a>
                    </div>
                </div>
            </div>
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
