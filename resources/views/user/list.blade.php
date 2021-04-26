@extends('layouts.main')

@section('content')
    <div class="titleMain">
        <h1>Admin Users</h1>
        <p>User Management / Admin Users</p>
    </div>
    <div class="content card">
        <div class="card-header">
            <h4 class="card-title">Users list
                <a href="{{route('user.create')}}" class="btn btn-primary float-right"><i class="fa fa-user-plus" aria-hidden="true"></i> Add New</a>
            </h4>
        </div>
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        More filters
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form method="POST" id="search-form" class="formLogin" role="form" >
                            <div class="form-group">
                                <label for="otp_required">Required OTP</label>
                                <select name="otp_required" id="otp_required" class="form-control">
                                    <option value="" selected>Select</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="blocked">Blocked</label>
                                <select name="blocked" id="blocked" class="form-control">
                                    <option value="" selected>Select</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn-outline-primary btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
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

    <script type="text/javascript">
        $(function () {
            let table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('ajax.user.datatable') }}",
                    data: function (d) {
                        d.otp_required = $('select[name=otp_required]').val();
                        d.blocked = $('select[name=blocked]').val();
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'first_name', name: 'name'},
                    {data: 'last_name', name: 'last name'},
                    {data: 'email', name: 'email'},
                    {data: 'actions', name: 'actions'},
                ]
            });
            $('#search-form').on('submit', function(e) {
                table.draw();
                e.preventDefault();
            });
        });
    </script>

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
