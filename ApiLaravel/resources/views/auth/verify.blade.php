<!DOCTYPE html>
<html>
<head>
    <title>Send Forgot Password</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifikasi Email</div>

                <div class="card-body">
                   <h3>Hello!</h3>
                   <p>Please click the button below to verify your email address.</p>
                   <a href="{{ route('passwordreset', $id) }}" class="btn btn-primary">Verify Email Address</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


