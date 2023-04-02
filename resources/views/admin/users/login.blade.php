<html>

<head>
    <title>{{ $title }}</title>
    <link href="{{ asset('template/admin/publics/login.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="wp-form-login">
        <h1>Login</h1>
        @include('admin.alert')
        <form id="form-login" action="{{ asset('admin/users/login/store') }}" method="post">
            {{ csrf_field() }}
            <input type="email" id="email" name="email" value="{{--set_value('username')--}}" placeholder="Email" />
            <input type="password" id="password" name="password" value="" placeholder="Password" autocomplete="family-name" />
            <div>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">
                    Remember Me
                </label>
            </div>
            <input type="submit" id="btn-login" name="btn-login" value="Login" />
        </form>
        <a href="{{-- base_url('?mod=users&action=reg') --}}" id="forgot-pass">Register</a> |
        <a href="{{-- base_url('?mod=users&action=reset') --}}" id="forgot-pass">Forgot Password?</a>
    </div>
</body>

</html>