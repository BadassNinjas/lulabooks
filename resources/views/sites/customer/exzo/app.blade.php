
<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui"/>

        <title>LulaBooks</title>
        <!-- Facebook Meta -->
        <meta property="og:image" content="{{asset('img/favicon.png')}}"/>
        <meta property="og:title" content="Lulabooks online store"/>
        <meta property="og:url" content="https://lulabooks.mobi"/>
        <meta property="og:description" content="We Sell New and Second hand Textbooks at very low prices"/>
        
        <!--Twitter Meta -->
        <meta propery="twitter:card" content="summary" />
        <meta propery="twitter:title" content="Lulabooks online store" />
        <meta propery="twitter:image" content="{{asset('img/favicon.png')}}" />
        <meta propery="twitter:description" content="We Sell New and Second hand Textbooks at very low prices" />
        <link rel="icon" href="{{asset('img/favicon.png')}}" type="image/x-icon"/>
        <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon"/>
        <link href="https://fonts.googleapis.com/css?family=Questrial|Raleway:700,900" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('css/customer.min.css')}}">

        <link rel="apple-touch-icon-precomposed" href="{{asset('img/lulalogo.png')}}">
        <link rel="icon" href="{{asset('img/favicon.png')}}">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-92189096-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-92189096-1');
        </script>

        <!-- Hotjar Tracking Code for https://lulabooks.mobi -->
        <script>
          (function(h,o,t,j,a,r){
              h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
              h._hjSettings={hjid:765656,hjsv:6};
              a=o.getElementsByTagName('head')[0];
              r=o.createElement('script');r.async=1;
              r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
              a.appendChild(r);
          })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script>

    </head>
    <body>
          <div id="app"></div>
          <script>
            window.System = {
              CSRF: '{{ csrf_token() }}',
              AuthCheckComplete: false
            }
          </script>
          <script async defer src="{{asset('js/customer.min.js')}}"></script>
          <script async defer type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
    </body>
</html>
