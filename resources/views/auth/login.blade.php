
<style>
    .form_div {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    form {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    a {
        text-decoration: none;
        color: #5b4caf;
    }

    a:hover {
        color: #010105;
    }

    .labelChechkbox{
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-content: center;
    }
    .ml-4{
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #5b4caf;
        color: white;
        cursor: pointer;
    }

    .ml-4:hover{
        background-color: #010105;
        transition: all 0.5s;
        color: white;
    }
</style>

<x-guest-layout>
    <x-jet-authentication-card>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif


  <div class="form_div">

      <form  method="POST" action="{{ route('login') }}">
          @csrf

          <div>
              <x-jet-label for="email" value="{{ __('Email') }}" />
              <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                  required autofocus />
          </div>

          <div class="mt-4 ">
              <x-jet-label for="password" value="{{ __('Password') }}" />
              <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                  autocomplete="current-password" />
          </div>

          <div >
              <label class="block labelChechkbox" for="remember_me" >
                <span class="ml-5 text-sm text-gray-600">{{ __('Remember me') }}</span>
                  <x-jet-checkbox id="remember_me" name="remember" />

              </label>
          </div>

          <div class="block mt-4 labelChechkbox">
            <span>
                New User?
            </span>
              <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                  {{ __('Register Now') }}
              </a>
          </div>

          <div class="flex items-center justify-end mt-4">
              @if (Route::has('password.request'))
                  <a class="underline text-sm text-gray-600 hover:text-gray-900"
                      href="{{ route('password.request') }}">
                      {{ __('Forgot your password?') }}
                  </a>
              @endif




              <x-jet-button class="ml-4">
                  {{ __('Log in') }}
              </x-jet-button>
          </div>
      </form>
  </div>

    </x-jet-authentication-card>
</x-guest-layout>
