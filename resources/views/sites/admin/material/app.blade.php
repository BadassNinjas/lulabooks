
<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LulaBooks Admin</title>

        <link rel="dns-prefetch" href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="/css/admin.min.css">
        <link rel="dns-prefetch" rel="apple-touch-icon-precomposed" href="/img/lulafavicon180.png">
        <link rel="dns-prefetch" rel="icon" href="/img/lulafavicon196.png">
    </head>
    <body>
          <div id="app"></div>
          <script>
            window.System = {
              CSRF: '{{ csrf_token() }}',
              AuthCheckComplete: false
            }
          </script>
          <script src="/js/admin.min.js"></script>
    </body>
</html>
