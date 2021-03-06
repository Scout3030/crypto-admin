<div>
    <h2 class="titleBody">{{ $title }} User</h2>

    <form  wire:submit.prevent="{{ $action }}" class="formLogin">

        <input type="hidden" wire:model="user_id">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="first-name">First Name</label>
                <input type="text"
                        class="form-control @error('first_name') validation @enderror"
                        id="first-name"
                        wire:model="first_name"
                        autocomplete="off"
                >
                @error('first_name')
                <div class="form-text validation pb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" for="last-name">Last Name</label>
                <input type="text"
                        class="form-control @error('last_name') validation @enderror"
                        id="last-name"
                         wire:model="last_name"
                        autocomplete="off"
                >
                @error('last_name')
                <div class="form-text validation pb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email"
                        class="form-control @error('email') validation @enderror"
                        id="email"
                        wire:model="email"
                        autocomplete="off"
                >
                @error('email')
                <div class="form-text validation pb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" for="password">Password</label>
                <input id="password"
                        type="password"
                        class="form-control @error('password') validation @enderror"
                        wire:model="password"
                >
                @error('password')
                <div class="form-text validation pb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation"
                        type="password"
                        class="form-control @error('password_confirmation') validation @enderror"
                        wire:model="password_confirmation"
                >
                @error('password_confirmation')
                <div class="form-text validation pb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" for="roles">Role</label>
                <select id="roles"
                    class="form-control @error('role_id') validation @enderror"
                    wire:model="role_id"
                    @if(($user_id ?? 0) === auth()->id()) disabled @endif
                    placeholder="Select Option"
                    >

                    @if ($user_id == 0)
                        <option value="" selected disabled>Select Option</option>
                    @endif
                    @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
                @error('role_id')
                <div class="form-text validation pb-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input"
                        type="radio"
                        name="status"
                        value="active"
                        @if(($user_id ?? 0) === auth()->id()) disabled @endif
                        @if($is_active ?? true) checked @endif
                        >
                    <label class="form-label" class="form-check-label" for="status_active">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input"
                        type="radio"
                        name="status"
                        value="disable"
                        @if(($user_id ?? 0) === auth()->id()) disabled @endif
                        @if(!$is_active ?? true) checked @endif
                        >
                    <label class="form-label" class="form-check-label" for="status_disable">Disable</label>
                </div>
            </div>
        </div>
        <div class="col-md-12 d-flex flex-row-reverse">
            <button type="submit" class="btn btn-primary">Store</button>
        </div>
    </form>
</div>

