@extends('layouts.main')

@section('content')
    {!! $dataTable->table() !!}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                </div>
                <div class="modal-body">
                    Aru you sure want to delete <span class="item-name"></span>?
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
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {{$dataTable->scripts()}}

    <script>
        let id;
        let itemName;

        function closeModal() {
            $('#deleteModal').modal('hide');
        }

        function deletePermission() {
            $.ajax({
                url: '{{route('ajax.permission.delete')}}',
                data: {
                    id: id
                },
                method: 'post',
                success: function (res) {
                    window.location.reload(true);
                }
            })
        }

        $('.confirm-delete').on('click', function () {
            deletePermission();
        })
        $(document).on('click', '.delete-permission', function (e) {
            id = $(this).attr('data-id');
            itemName = $(this).attr('data-name');
            $('.item-name').html(itemName)
            $('#deleteModal').modal('show');
        })
    </script>
@endpush
