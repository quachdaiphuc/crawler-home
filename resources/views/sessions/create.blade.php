<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login form</title>

    <!-- Bootstrap core CSS -->

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/fonts/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icheck/flat/green.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/pace/pace.css') }}" rel="stylesheet" />

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <!--[if lt IE 9]>
        <script src="{{ asset('assets/../assets/js/ie8-responsive-file-warning.js') }}"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">

    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    {!! Form::open(['route' => 'sessions.store']) !!}
                        <h1>Login Form</h1>
                        @if (session()->has('flash_message'))
                            <div class="alert alert-success">
                                {{ session()->get('flash_message') }}
                            </div>
                        @endif

                        @if (session()->has('error_message'))
                            <div class="alert alert-danger">
                                {{ session()->get('error_message') }}
                            </div>
                        @endif
                        <div>
                            {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'required' => 'required'])!!}
                            {!! errors_for('email', $errors) !!}
                        </div>
                        <div>
                            {!! Form::password('password', ['placeholder' => 'Password','class' => 'form-control', 'required' => 'required'])!!}
                            {!! errors_for('password', $errors) !!}
                        </div>
                        <div>
                            {!! Form::submit('login', ['class' => 'btn btn-default submit', 'value' => 'Log in']) !!}
                            <a class="reset_pass" href="#">Lost your password?</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                        {!! Form::close() !!}
                            <p class="change_link">New to site?
                                <a href="{{url('register')}}" class="to_register"> Create Account </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                                <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            <div id="register" class="animate form">
                <section class="login_content">
                    {!! Form::open(['route' => 'registration.store']) !!}
                        <h1>Create Account</h1>
                        @if (session()->has('flash_message'))
                            <div class="form-group">
                                <p>{{ session()->get('flash_message') }}</p>
                            </div>
                        @endif

                        <!-- Email field -->
                        <div class="form-group">
                            {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'required' => 'required'])!!}
                            {!! errors_for('email', $errors) !!}
                        </div>

                        <!-- Password field -->
                        <div class="form-group">
                            {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control', 'required' => 'required'])!!}
                            {!! errors_for('password', $errors) !!}
                        </div>

                        <!-- Password Confirmation field -->
                        <div class="form-group">
                            {!! Form::password('password_confirmation', ['placeholder' => 'Password Confirm', 'class' => 'form-control', 'required' => 'required'])!!}

                        </div>

                        <!-- First name field -->
                        <div class="form-group">
                            {!! Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control', 'required' => 'required'])!!}
                            {!! errors_for('first_name', $errors) !!}
                        </div>

                        <!-- Last name field -->
                        <div class="form-group">
                            {!! Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control', 'required' => 'required'])!!}
                            {!! errors_for('last_name', $errors) !!}
                        </div>

                        <!-- Submit field -->
                            <div class="form-group">
                                {!! Form::submit('Register', ['class' => 'btn btn-default submit']) !!}
                            </div>

                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">Already a member ?
                                <a href="#tologin" class="to_register"> Log in </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                                <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>
    {{--pace style--}}
    <script src="{{ asset('assets/js/pace/pace.js')}}"></script>
    <script>
    paceOptions = {
          // Configuration goes here. Example:
          elements: false,
          restartOnPushState: false,
          restartOnRequestAfter: false
    }
    </script>
</body>
</html>