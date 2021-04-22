<div class="d-flex">
    @if($name !== 'Root')
{{--        <a href="{{route('roles.view', $id)}}" class="btn btn-success shadow btn-xs sharp">--}}
{{--            <i class="fa fa-eye" aria-hidden="true"></i></a>--}}
        @can('role-edit')
            <a href="{{route('roles.edit', $id)}}"
               class="btn btn-primary shadow btn-xs sharp">
                <i class="fa fa-pencil"></i></a>
        @endcan
        @can('role-delete')
            <button type="button" class="btn btn-danger shadow btn-xs sharp delete-role"
                    data-name="{{$name}}"
                    data-id="{{$id}}"
                    data-url="{{route('ajax.roles.delete', $id)}}">
                <i class="fa fa-trash"></i>
            </button>
        @endcan
    @endif
</div>
