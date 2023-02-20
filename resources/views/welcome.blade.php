<!DOCTYPE html>
<html class="h-full" data-theme="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NBack</title>

    <!-- Styles -->
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" media="all" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css'/>

    @if ($_SERVER['HTTP_HOST'] == 'lea.michalm.cz')
        <script type='text/javascript'>
        window.smartlook||(function(d) {
        var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
        var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
        c.charset='utf-8';c.src='https://web-sdk.smartlook.com/recorder.js';h.appendChild(c);
        })(document);
        smartlook('init', '0d5e2de465730c562785b0a478bda770c75bc67e', { region: 'eu' });
        </script>
    @endif
</head>

<body
    class="h-full relative flex p-4
        sm:bg-base-200 sm:bg-cover sm:bg-top"
>

    <div id="app"
        class="w-full h-full overflow-y-auto pb-20
            sm:card sm:w-96 sm:bg-base-100 sm:shadow-xl sm:relative sm:mx-auto sm:p-4 sm:pb-20
            md:w-[32rem]"
    >
        <nback/>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.7/dayjs.min.js'></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
