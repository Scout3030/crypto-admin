<div>
@foreach($roles as $role)
    <div class="badge badge-success">
        <a class="roleLink" @can('role-edit')href="{{route('roles.edit', $role['id'])}}@endcan">{{$role['name']}}</a>
    </div>
@endforeach
</div>
