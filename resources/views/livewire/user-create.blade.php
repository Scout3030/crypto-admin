<div>
    <h2>{{ $title }} User</h2>

    <form  wire:submit.prevent="{{ $action }}" class="formLogin">

        @csrf

        <input type="hidden" wire:model="user_id">

        <div class="mb-3">
            <label for="first-name">First Name</label>
            <input type="text"
                    class="form-control @error('first_name') validation @enderror"
                    id="first-name"
                    wire:model="first_name"
                    autocomplete="off"
            >
        </div>
        @error('first_name')
        <div class="form-text validation pb-1">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="last-name">Last Name</label>
            <input type="text"
                    class="form-control @error('last_name') validation @enderror"
                    id="last-name"
                     wire:model="last_name"
                    autocomplete="off"
            >
        </div>
        @error('last_name')
        <div class="form-text validation pb-1">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email"
                    class="form-control @error('email') validation @enderror"
                    id="email"
                    wire:model="email"
                    autocomplete="off"
            >
        </div>
        @error('email')
        <div class="form-text validation pb-1">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="password">Password</label>
            <input id="password"
                    type="password"
                    class="form-control @error('password') validation @enderror"
                    wire:model="password"
            >
        </div>
        @error('password')
        <div class="form-text validation pb-1">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation"
                    type="password"
                    class="form-control @error('password_confirmation') validation @enderror"
                    wire:model="password_confirmation"
            >
        </div>

        @error('password_confirmation')
        <div class="form-text validation pb-1">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="roles">Role</label>
            <select id="roles"
                class="form-control"
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
        </div>

        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input"
                    type="radio"
                    name="status"
                    value="active"
                    @if(($user_id ?? 0) === auth()->id()) disabled @endif
                    @if($is_active ?? true) checked @endif
                    >
                <label class="form-check-label" for="status_active">Active</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input"
                    type="radio"
                    name="status"
                    value="disable"
                    @if(($user_id ?? 0) === auth()->id()) disabled @endif
                    @if(!$is_active ?? true) checked @endif
                    >
                <label class="form-check-label" for="status_disable">Disable</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Store</button>
    </form>
</div>

