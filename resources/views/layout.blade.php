<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">

        <title>TripTrip</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
        </style>
    </head>
    <body>
      <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
      <script src="js/index.js"></script>
      <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-88826309-1', 'auto');
      ga('send', 'pageview');
      </script>
      <header id="banner" class="navbar navbar-default navbar-fixed-top">
        <div class="container"><a href="#top" class="scrollable"><img src="https://s31.postimg.org/67g2pvv7f/Screen_Shot_2016_06_26_at_3_46_05_PM.png" alt="trip logo" title="trip logo"/></a>
          <button type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
          <nav id="navbar" role="navigation" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              @yield('header')
            </ul>
          </nav>
        </div>
      </header>
      <!-- end header-->
      <a id="top" name="home"></a>

      <!-- Top Image -->
      @yield('topImage')

      <!-- Google Map Section -->
      @yield('map')

      <!-- Gallery Grid Section-->
      @yield('new')

      <!-- Sharing Picture Section-->
      @yield('share')
      <!-- Scroll to Top Button (Only supposed to be visible on small and small screen sizes)-->
      <div class="scroll-top"><a href="#top" class="button scrollable"><i class="fa fa-chevron-up"></i></a></div>

      <!-- @yield('feedback') -->
      @yield('footer')

      <!-- Google Translator -->
      @yield('translate')
    </body>
</html>
