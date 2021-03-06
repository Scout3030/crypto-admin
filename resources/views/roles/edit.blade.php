@extends('layouts.main')

@section('content')
        <div class="titleMain">
            <h1>Roles</h1>
        </div>
        <div class="content card">
            <div class="card-body">

                @livewire('role-create', ['id' => $id])
                {{-- <h2 class="titleBody">@if($role->name) Edit @else Create @endif Role</h2>
                <form action="{{route('roles.store')}}" method="POST">
                    @csrf
                    @if($role)
                        <input type="hidden" value="{{$role->id }}" name="id">
                    @endif
                    <div class="mb-3">
                        <label for="first-name">Role Name</label>
                        <input type="text"
                               class="form-control @error('name') validation @enderror"
                               id="name"
                               name="name"
                               value="{{old('name', $role->name ?? '')}}"
                               autocomplete="off"
                        >
                    </div>
                    @error('name')
                    <div class="form-text validation pb-1">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <div><h3 class="titleBody">Permissions</h3></div>
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-md-6">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                               class="form-check-input"
                                               id="permission-{{$permission->id}}"
                                               value="{{$permission->id}}"
                                               @if($role && Permissions::roleHasPermission($role, $permission->name)) checked @endif
                                               name="permissions[]">
                                        <label class="form-check-label" for="permission-{{$permission->id}}">{{$permission->name}}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-12 d-flex flex-row-reverse">
                        <a href="{{route('roles.list')}}" class="btn btn-outline-info">Cancel</a>
                        <button type="submit" class="btn btn-primary">@if($role->name) Update @else Submit @endif</button>
                    </div>
                </form> --}}
            </div>
        </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $(".form-check-input").change(function () {
			    var data = $(this).val();
                Livewire.emit('setPermission', data);
			});
        })
    </script>
@endpush
