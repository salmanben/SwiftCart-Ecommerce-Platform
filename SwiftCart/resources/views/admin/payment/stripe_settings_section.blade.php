<form action="{{ route('admin.stripe_setting') }}" method="post" class="col-lg-8">
    @csrf
    @method('put')

    <div class="mb-3">
        <label class="d-block" for="stripe_client_id">Stripe Client ID</label>
        <input type="text" class="form-control shadow-none" name="stripe_client_id" placeholder="Client ID" id="stripe_client_id"
            value="{{ @$stripe_settings->client_id }}">
        @error('stripe_client_id')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label class="d-block" for="stripe_secret_key">Stripe Secret Key</label>
        <input type="text" class="form-control shadow-none" name="stripe_secret_key" placeholder="Secret Key"
            id="stripe_secret_key" value="{{ @$stripe_settings->secret_key }}">
        @error('stripe_secret_key')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label class="d-block" for="stripe_mode">Mode</label>
        <select class="form-select  form-control shadow-none" name="stripe_mode" aria-label="Default select example">
            <option value="sandbox" @if (@$stripe_settings->mode == 'sandbox') selected @endif>Sandbox</option>
            <option value="live" @if (@$stripe_settings->mode == 'live') selected @endif>Live</option>
        </select>
        @error('stripe_mode')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label class="d-block" for="stripe_country_name">Country Name</label>
        <select name="stripe_country_name" id="stripe_country_name" class="form-control select2 shadow-none"style="width:100%">
            <option value="">Select</option>
            @foreach (config('settings.country_list') as $country)
                <option value="{{ $country }}" @if (@$stripe_settings->country_name == $country) selected @endif>
                    {{ $country }}</option>
            @endforeach
        </select>
        @error('stripe_country_name')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label class="d-block" for="currency_icon">Currency Name</label>

        <select  name="stripe_currency_name" class="form-control shadow-none select2" id="">
            <option value="">Select</option>
            @foreach (config('settings.currency_name') as $key=>$value)
               <option @selected(@$stripe_settings->currency_name  == $key) value="{{$key}}">{{$key}}</option>
            @endforeach
        </select>
        @error('stripe_currency_name')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label class="d-block" for="stripe_currency_icon">Currency Icon</label>
        <input type="text" name="stripe_currency_icon" class="form-control shadow-none"  value="{{ @$stripe_settings->currency_icon }}" placeholder="currency icon" id="">
        @error('stripe_currency_icon')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label class="d-block" for="stripe_currency_rate">Currency Rate({{$currency_icon}})</label>
        <input type="text" class="form-control shadow-none" name="stripe_currency_rate" placeholder="Currency Rate"
            id="stripe_currency_rate" value="{{ @$stripe_settings->currency_rate }}">
        @error('stripe_currency_rate')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label class="d-block" for="stripe_status">Status</label>
        <select class="form-select form-control shadow-none" name="stripe_status" aria-label="Default select example">
            <option value="1" @if (@$stripe_settings->status == '') selected @endif>Enabled</option>
            <option value="0" @if (@$stripe_settings->status == '0') selected @endif>Disabled</option>
        </select>
        @error('stripe_status')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <button class="btn btn-primary" type="submit">Save Settings</button>
</form>

