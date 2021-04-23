<form wire:submit.prevent="update" class="row">

    @if ( Session::has('success') )
    <div class="col-12">
        <div class="alert alert-success mb-4" role="alert">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <polyline points="9 11 12 14 22 4"></polyline>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg> <strong>Sucess!</strong> Profile edited successfully!
        </div>
    </div>
    @endif

    @csrf

    <input type="hidden" wire:model="user_id">

    <div class="col-md-6 mb-3">
        <label class="form-label" for="form-label">First Name</label>
        <input id="first_name"
            type="text"
            wire:model="first_name"
            class="form-control @error('first_name') validation @enderror"
            >

        @error('first_name')
            <div class="form-text validation pb-3">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="form-label">Last Name</label>
        <input id="last_name"
            type="text"
            wire:model="last_name"
            class="form-control @error('last_name') validation @enderror"
            >
        @error('last_name')
            <div class="form-text validation pb-3">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="form-label">Email</label>
        <input type="text"
            wire:model="email"
            class="form-control @error('email') validation @enderror"
            >
        @error('email')
            <div class="form-text validation pb-3">{{ $message }}</div>
        @enderror
    </div>

    <div wire:ignore class="col-md-6 mb-3">
        <label class="form-label" for="form-label">Timezone</label>
        <select id="timezone"
            wire:model="timezone"
            class="form-select @error('timezone') validation @enderror">
            <option value=""></option>
            @foreach ($timezones as $item)
                <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
        @error('timezone')
            <div class="form-text validation pb-3">{{ $message }}</div>
        @enderror
    </div>

    <div wire:ignore  class="col-md-6 mb-3">
        <label class="form-label" for="form-label">Date Format</label>
        <select id="date_format"
            wire:model="date_format"
            class="form-control @error('date_format') validation @enderror">
            <option value=""></option>
            @foreach ($dates as $item)
                <option value="{{ $item['id'] }}">{{ $item['text'] }}</option>
            @endforeach
        </select>
        @error('date_format')
            <div class="form-text validation pb-3">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12 d-flex flex-row-reverse">
        <button type="submit" class="btn-outline-primary mt-3">Update</button>
    </div>

</form>
