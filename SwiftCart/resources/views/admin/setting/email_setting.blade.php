<form action="{{ route('admin.email_setting.update') }}" method="post" class="col-12 col-lg-8">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Host</label>
        <input type="text" class="form-control shadow-none" name="host" value="{{ @$email_setting->host }}" placeholder="Host" id="">
        @error('host')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label>Port</label>
        <input type="number" class="form-control shadow-none" name="port" value="{{ @$email_setting->port }}" placeholder="Port" id="">
        @error('port')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label>Encryption</label>
        <input type="text" class="form-control shadow-none" name="encryption" value="{{ @$email_setting->encryption }}" placeholder="Encryption" id="">
        @error('encryption')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label>Username</label>
        <input type="text" class="form-control shadow-none" name="username" value="{{ @$email_setting->username }}" placeholder="Username" id="">
        @error('username')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="text" class="form-control shadow-none" name="password" placeholder="Password" id="">
        @error('password')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label>From Address</label>
        <input type="email" class="form-control shadow-none" name="from_address" value="{{ @$email_setting->from_address }}" placeholder="From Address" id="">
        @error('from_address')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label>Name</label>
        <input type="text" class="form-control shadow-none" name="name" value="{{ @$email_setting->name }}" placeholder="Name" id="">
        @error('name')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <button class="btn btn-primary" type="submit">Save</button>
</form>
