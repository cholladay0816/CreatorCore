<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
    <a class="mt-4 py-2 px-3">
        <script src="https://accounts.google.com/gsi/client" async defer></script>
        <div id="g_id_onload"
             data-client_id="{{ config('services.google.client_id') }}"
             data-login_uri="{{ url('auth/google') }}"
             data-allowed_parent_origin="{{ config('app.url') }}"
             data-auto_prompt="false">
        </div>
        <div id="signinDiv" class="g_id_signin"
             data-type="standard"
             data-size="large"
             data-theme="filled_blue"
             data-text="continue_with"
             data-shape="rectangular"
             data-logo_alignment="left">
        </div>
    </a>
</div>
