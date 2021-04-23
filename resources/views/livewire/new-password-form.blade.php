<form wire:submit.prevent="update" class="formLogin">

    @if ( Session::has('success') )
        <div class="alert alert-success" role="alert">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <polyline points="9 11 12 14 22 4"></polyline>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg> <strong>Sucess!</strong> Password changed!
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input id="current_password"
                       type="password"
                       wire:model="current_password"
                       class="form-control @error('current_password') validation @enderror"
                       placeholder="Enter Your Current Password"
                >
                @error('current_password')
                <div class="form-text validation pb-3">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input id="password"
                       type="password"
                       wire:model="password"
                       class="form-control @error('password') validation @enderror"
                       placeholder="Enter Your New Password"
                       autocomplete="off"
                >
                @error('password')
                <div class="form-text validation pb-3">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation"
                       type="password"
                       wire:model="password_confirmation"
                       class="form-control @error('password_confirmation') validation @enderror"
                       placeholder="Enter Your New Password"
                       autocomplete="off"
                >
                @error('password_confirmation')
                <div class="form-text validation pb-3">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <button type="submit" class="btn-outline-primary btn-primary">Update</button>
    </div>
</form>
