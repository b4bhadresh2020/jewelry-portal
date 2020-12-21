<form action="{{ url('user/register') }}" method="post" enctype='multipart/form-data'>
    @csrf
    <div class="row">
        <div class="input-field col m6 s12">
            <input name="first_name" id="first_name" type="text" value="{{ old('first_name') }}" class="validate" data-error=".errorTxt6">
            <label for="first_name">First Name</label>
            <small class="errorTxt2">
                @error('first_name')
                    <div class="error">{{$message}}</div>
                @enderror
            </small>
        </div>
        <div class="input-field col m6 s12">
            <input name="last_name" id="last_name" type="text" value="{{ old('last_name') }}" class="validate" data-error=".errorTxt6">
            <label for="last_name">Last Name</label>
            <small class="errorTxt2">
                @error('last_name')
                    <div class="error">{{$message}}</div>
                @enderror
            </small>
        </div>
    </div>

    <div class="row">
        <div class="input-field col m6 s12">
            <input name="email" id="email" type="email" value="{{ old('email') }}" class="validate" data-error=".errorTxt6">
            <label for="email">Email</label>
            <small class="errorTxt2">
                @error('email')
                    <div class="error">{{$message}}</div>
                @enderror
            </small>
        </div>

        <div class="input-field col m6 s12">
            <input name="phone" id="phone" type="text" value="{{ old('phone') }}" class="validate" data-error=".errorTxt6">
            <label for="phone">Phone</label>
            <small class="errorTxt2">
                @error('phone')
                    <div class="error">{{$message}}</div>
                @enderror
            </small>
        </div>
    </div>

    <div class="row">
        <div class="input-field col m6 s12">
            <input name="password" id="password" type="password" value="{{ old('password') }}" class="validate" data-error=".errorTxt6">
            <label for="password">Password</label>
            <small class="errorTxt2">
                @error('password')
                    <div class="error">{{$message}}</div>
                @enderror
            </small>
        </div>
        <div class="input-field col m6 s12">
            <input name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}"  type="password" class="validate" data-error=".errorTxt6">
            <label for="password_confirmation">Confirm Password</label>
        </div>
    </div>

    <div class="row">
        <div class="input-field col s12">
            <button class="btn cyan waves-effect waves-light" type="submit" name="action">Submit
                <i class="material-icons right">send</i>
            </button>
        </div>
    </div>
</form>
