<form action="{{ route('admin.paypal_setting') }}" method="post" class="col-lg-8">
    @csrf
    @method('put')

    <div class="mb-3">
        <label class="d-block" for="client_id">PayPal Client ID</label>
        <input type="text" class="form-control shadow-none" name="client_id" placeholder="Client ID" id="client_id"
            value="{{ @$paypal_settings->client_id }}">
        @error('client_id')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label class="d-block" for="secret_key">PayPal Secret Key</label>
        <input type="text" class="form-control shadow-none" name="secret_key" placeholder="Secret Key"
            id="secret_key" value="{{ @$paypal_settings->secret_key }}">
        @error('secret_key')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label class="d-block" for="mode">Mode</label>
        <select class="form-select  form-control shadow-none" name="mode" aria-label="Default select example">
            <option value="sandbox" @if (@$paypal_settings->mode == 'sandbox') selected @endif>Sandbox</option>
            <option value="live" @if (@$paypal_settings->mode == 'live') selected @endif>Live</option>
        </select>
        @error('mode')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label class="d-block" for="country_name">Country Name</label>
        <select name="country_name" id="country_name" class="form-control select2 shadow-none" style="width:100%">
            <option value="">Select</option>
            @foreach (config('settings.country_list') as $country)
                <option value="{{ $country }}" @if (@$paypal_settings->country_name == $country) selected @endif>
                    {{ $country }}</option>
            @endforeach
        </select>
        @error('country_name')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label class="d-block" for="currency_icon">Currency Name</label>

        <select  name="currency_name" class="form-control shadow-none select2" id="">
            <option value="">Select</option>
            @foreach (config('settings.currency_name') as $key=>$value)
                  <option @selected(@$paypal_settings->currency_name  == $key) value="{{$key}}">{{$key}}</option>
            @endforeach
        </select>
        @error('currency_name')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label class="d-block" for="currency_icon">Currency Icon</label>
        <input type="text" name="currency_icon" class="form-control shadow-none" value="{{ @$paypal_settings->currency_icon }}"  placeholder="currency icon" id="">
        @error('currency_icon')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>


    <div class="mb-3">
        <label class="d-block" for="currency_rate">Currency Rate({{$currency_icon}})</label>
        <input type="text" class="form-control shadow-none" name="currency_rate" placeholder="Currency Rate"
            id="currency_rate" value="{{ @$paypal_settings->currency_rate }}">
        @error('currency_rate')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label class="d-block" for="status">Status</label>
        <select class="form-select form-control shadow-none" name="status" aria-label="Default select example">
            <option value="1" @if (@$paypal_settings->status == '') selected @endif>Enabled</option>
            <option value="0" @if (@$paypal_settings->status == '0') selected @endif>Disabled</option>
        </select>
        @error('status')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <button class="btn btn-primary" type="submit">Save Settings</button>
</form>

