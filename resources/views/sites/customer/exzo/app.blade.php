
<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui"/>

        <title>LulaBooks</title>

        <link href="https://fonts.googleapis.com/css?family=Questrial|Raleway:700,900" rel="stylesheet">

        <link rel="stylesheet" href="/css/customer.min.css">

        <link rel="apple-touch-icon-precomposed" href="/img/lulalogo.png">
        <link rel="icon" href="/img/lulalogo.png">
    </head>
    <body>
          <div id="app"></div>
          <script>
            window.System = {
              CSRF: '{{ csrf_token() }}',
              AuthCheckComplete: false
            }
          </script>
          <script src="/js/customer.min.js"></script>
            <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
    </body>
</html>
