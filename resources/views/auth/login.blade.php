<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<style>
    body {
    padding-top: 90px;
        }
        .panel-login {
            border-color: #ccc;
            -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
            -moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
            box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
        }
        .panel-login>.panel-heading {
            color: #00415d;
            background-color: #fff;
            border-color: #fff;
            text-align:center;
            margin-top: 30px;
        }
        .panel-login>.panel-heading a{
            text-decoration: none;
            color: #666;
            font-weight: bold;
            font-size: 15px;
            -webkit-transition: all 0.1s linear;
            -moz-transition: all 0.1s linear;
            transition: all 0.1s linear;
        }
        .panel-login>.panel-heading a.active{
            color: #029f5b;
            font-size: 18px;
        }
        .panel-login>.panel-heading hr{
            margin-top: 10px;
            margin-bottom: 0px;
            clear: both;
            border: 0;
            height: 1px;
            background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
            background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
            background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
            background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
        }
        .panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
            height: 45px;
            border: 1px solid #ddd;
            font-size: 16px;
            -webkit-transition: all 0.1s linear;
            -moz-transition: all 0.1s linear;
            transition: all 0.1s linear;
        }
        .panel-login input:hover,
        .panel-login input:focus {
            outline:none;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
            border-color: #ccc;
        }
        .btn-login {
            background-color: #59B2E0;
            outline: none;
            color: #fff;
            font-size: 14px;
            height: auto;
            font-weight: normal;
            padding: 14px 0;
            text-transform: uppercase;
            border-color: #59B2E6;
        }
        .btn-login:hover,
        .btn-login:focus {
            color: #fff;
            background-color: #53A3CD;
            border-color: #53A3CD;
        }
        .forgot-password {
            text-decoration: underline;
            color: #888;
        }
        .forgot-password:hover,
        .forgot-password:focus {
            text-decoration: underline;
            color: #666;
        }

        .btn-register {
            background-color: #1CB94E;
            outline: none;
            color: #fff;
            font-size: 14px;
            height: auto;
            font-weight: normal;
            padding: 14px 0;
            text-transform: uppercase;
            border-color: #1CB94A;
        }
        .btn-register:hover,
        .btn-register:focus {
            color: #fff;
            background-color: #1CA347;
            border-color: #1CA347;
    }

</style>
<body>

<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-12">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							{{-- <div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div> --}}
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="{{ route('loginSubmit') }}" method="post" role="form" style="display: block;">
                                    @csrf
									<div class="form-group">
										<input required type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="">
                                        @if ($errors->has('email'))
                                            <div >
                                                    @foreach ($errors->get('email') as $error)
                                                    <span class="text-danger " >{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        @endif
									</div>
									<div class="form-group">
										<input required type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" value="">
                                        @if ($errors->has('password'))
                                            <div >
                                                    @foreach ($errors->get('password') as $error)
                                                    <span class="text-danger " >{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        @endif
									</div>
							
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input required type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="" method="post" role="form" style="display: none;">
                                    @csrf
									<div class="form-group">
										<input required type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Enter Your Full Name" value="">
                                        @if ($errors->has('name'))
                                            <div >
                                                    @foreach ($errors->get('name') as $error)
                                                    <span class="text-danger " >{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        @endif
									</div>
									<div class="form-group">
										<input required type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                                        @if ($errors->has('email'))
                                            <div >
                                                    @foreach ($errors->get('email') as $error)
                                                    <span class="text-danger " >{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        @endif
									</div>
                                    <div class="form-group">
                                        <input required type="password" name="password" id="passwordId" tabindex="2" class="form-control" placeholder="Password">
                                        @if ($errors->has('password'))
                                            <div >
                                                    @foreach ($errors->get('password') as $error)
                                                    <span class="text-danger " >{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        @endif
                                    </div>
                                
                                    <div class="form-group">
                                        <input required type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                                        <span id="password-error" class="text-danger"></span>
                                    </div>
                                
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input required type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now" onclick="return validateForm()">
                                            </div>
                                        </div>
                                    </div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    
</body>
</html>

<script>
     function validateForm() {
        var password = document.getElementById('passwordId').value;
        var confirmPassword = document.getElementById('confirm-password').value;
        if (password !== confirmPassword) {
            document.getElementById('password-error').textContent = 'Passwords do not match';
            return false;
        } else {
            document.getElementById('password-error').textContent = '';
            return true;
        }
    }



    $(function() {

$('#login-form-link').click(function(e) {
    $("#login-form").delay(100).fadeIn(100);
     $("#register-form").fadeOut(100);
    $('#register-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
});
$('#register-form-link').click(function(e) {
    $("#register-form").delay(100).fadeIn(100);
     $("#login-form").fadeOut(100);
    $('#login-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
});

});
</script>