<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link href='{!! asset('assets/css/style.css') !!}' rel='stylesheet' type='text/css'>
    <title>Login | Funanga Dev Test</title>
</head>

<body>
<form method="post">
    <div class="box" id="login-box">
        <h1>Login</h1>

        <input type="email" name="email" placeholder="Email" id="email" class="input-text"/>
        <input type="password" name="password" placeholder="Password" id="password" class="input-text"/>

        <div style="margin-left: 10px">
            <table>
                <tr>
                    <td><input type="checkbox" id="remember" name="remember"></td>
                    <td><p style="color: black">Remember me</p></td>
                </tr>
            </table>
            <div id="message"></div>
        </div>

        <a href="#" id="login">
            <div class="btn">Login</div>
        </a> <!-- End Login Btn -->

        <a href="#" id="register">
            <div id="btn2">Register</div>
        </a> <!-- End Register Btn -->

    </div> <!-- End Box -->

</form>
<div class="box" id="logged-box" style="display: none">
    <div style="margin: 10px 10px 10px 10px">
        <h3 id="welcome-note"></h3>
        <a href="#" id="login">
            <div class="btn" id="logout">Logout</div>
        </a> <!-- End Login Btn -->
    </div>
</div>
</body>


<script src="{!! asset('assets/js/jquery.min.js') !!}" type="text/javascript"></script>

<script>
    $(document).ready(function () {
        let session = "{{ \Illuminate\Support\Facades\Auth::user()?->email ?? '' }}"

        if (session !== '') {
            $("#login-box").hide();
            $("#welcome-note").html("Hello User, you are logged in as " + session);
            $("#logged-box").show();
        }
    })

    $("#login").click(function () {
        let email = $('#email').val();
        let password = $('#password').val();
        let remember = $('#remember').prop('checked');


        if (email !== '' && password !== '') {
            $.post('api/login',
                {
                    email: email,
                    password: password,
                    remember: remember,
                    _token: "{{ csrf_token() }}"
                },
                function (data, status) {
                    if (data.status === 'ok') {
                        $("#login-box").hide();
                        $("#welcome-note").html(data.message);
                        $("#logged-box").show();
                    } else {
                        $("#message").html("<p style='color: red'>" + data.message + "</p>");
                    }

                }
            );
        }
    });

    $("#register").click(function () {
        let email = $('#email').val();
        let password = $('#password').val();

        if (email !== '' && password !== '') {
            $.post('api/register',
                {
                    email: email,
                    password: password,
                    _token: "{{ csrf_token() }}"
                },
                function (data, status) {
                    if (data.status === 'ok') {
                        alert(data.message);
                    }

                }
            );
        }
    });

    $("#logout").click(function () {
            $.post('api/logout',
                {
                },
                function (data, status) {
                    if (data.status === 'ok') {
                        location.reload();
                    }
                }
            );

    });
</script>


</html>
