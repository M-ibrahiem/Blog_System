<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title>{{ $setting->getTranslation(LaravelLocalization::getCurrentLocale())->title }}</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<link rel="shortcut icon" href="{{ $setting->favicon }}" type="image/x-icon" />
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">

<!-- Design fonts -->
<link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">

<!-- Bootstrap core CSS -->
<link href="{{ asset('front/css/bootstrap.css') }}" rel="stylesheet">

<!-- FontAwesome Icons core CSS -->
<link href="{{ asset('front/css/font-awesome.min.css') }}" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="{{ asset('front/style.css') }}" rel="stylesheet">

<!-- Responsive styles for this template -->
<link href="{{ asset('front/css/responsive.css') }}" rel="stylesheet">

<!-- Colors for this template -->
<link href="{{ asset('front/css/colors.css') }}" rel="stylesheet">

<!-- Version Garden CSS for this template -->
<link href="{{ asset('front/css/version/garden.css') }}" rel="stylesheet">

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
        <div class="collapse top-search" id="collapseExample">
            <div class="card card-block">
                <div class="newsletter-widget text-center">
                    <form class="form-inline">
                        <input type="text" class="form-control" placeholder="What you are looking for?">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </form>
                </div><!-- end newsletter -->
            </div>
        </div><!-- end top-search -->

        <div class="topbar-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 hidden-xs-down">
                        <div class="topsocial">
                            <a href="{{ $setting->facebook }}" data-toggle="tooltip" data-placement="bottom"
                                title="Facebook"><i class="fa fa-facebook"></i></a>
                            <a href="{{ $setting->linkedin }}" data-toggle="tooltip" data-placement="bottom"
                                title="Linked In"><i class="fa fa-youtube"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i
                                    class="fa fa-pinterest"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i
                                    class="fa fa-twitter"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Flickr"><i
                                    class="fa fa-flickr"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i
                                    class="fa fa-instagram"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Google+"><i
                                    class="fa fa-google-plus"></i></a>
                        </div><!-- end social -->
                    </div><!-- end col -->

                    <div class="col-lg-4 hidden-md-down">
                    </div><!-- end col -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="topsearch text-right">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"><i
                                    ></i>
                                     {{ $properties['native'] }}</a>
                                    @endforeach
                            </div><!-- end search -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end header-logo -->
        </div><!-- end topbar -->

        <div class="header-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="logo">
                            <a href="garden-index.html"><img src="{{ $setting->logo }}" alt=""></a>
                        </div><!-- end logo -->
                    </div>
                </div><!-- end row -->
            </div><!-- end header-logo -->
        </div><!-- end header -->

        <header class="header">
            <div class="container">
                <nav class="navbar navbar-inverse navbar-toggleable-md">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#Forest Timemenu" aria-controls="Forest Timemenu" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-md-center" id="Forest Timemenu">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="garden-index.html">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="garden-category.html">Gardening</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="garden-category.html">Outdoor Living</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="garden-category.html">Indoor Living</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="garden-category.html">Shopping Guides</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="garden-contact.html">Contact</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div><!-- end container -->
        </header><!-- end header -->
