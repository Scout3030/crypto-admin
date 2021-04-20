<div>
@foreach($roles as $role)
    <div class="badge badge-success">
        <a class="text-white p-2 d-block" href="{{route('roles.edit', $role['id'])}}">{{$role['name']}}</a>
    </div>
@endforeach
</div>
