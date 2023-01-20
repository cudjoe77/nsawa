<!doctype html>
<html lang="en">

<head>
<title>:: M-Funeral 1.0 ::</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Marketellos Consult">
<meta name="author" content="Marketellos Consults">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/animate-css/animate.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/color_skins.css')}}">
</head>

<body class="theme-blue">
    
    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle auth-main">
                <div class="auth-box">
                    <div class="mobile-logo"><a href="{{route('login')}}"><img src="{{asset('assets/images/thumbnail.png')}}" alt="M-Funeral"></a></div>
                    <div class="auth-left">
                        <div class="left-top">
                            <a href="{{route('login')}}">
                                <img src="{{asset('assets/images/logo.png')}}">
                                <span>M-Funeral 1.0</span>
                            </a>
                        </div>
                        <div class="left-slider">
                            <img src="{{asset('assets/images/front_image2.png')}}" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="auth-right">
                        <div class="right-top">
                            <!-- <ul class="list-unstyled clearfix d-flex">
                                <li><a href="{{route('login')}}"><i class="fe fe-home"></i></a></li>
                                <li><a href="#">Help</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul> -->
                        </div>
                        <div class="card">
                            <div class="header">
                                <p class="lead">You are <span class="text">Welcome to M-Funeral</span></p>
                                <span>M-Funeral 1.0</span>
                            </div>
                            <div class="body">
                                <p>Click on Login to access the application.</p>
                                <div class="margin-top-30">
                                    <!-- <a href="javascript:history.go(-1)" class="btn btn-default"><i class="fa fa-arrow-left"></i> <span>Go Back</span></a> -->
                                    <a href="{{route('login')}}" class="btn btn-primary"> <i class="fa fa-2x fa-USER text-col-white"></i> <span>LOGIN</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
	<!-- END WRAPPER -->
</body>


</html>

