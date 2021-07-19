<!DOCTYPE html>
<html lang="en">

  <head>

    @include('layouts.template.public.head')
<!--

TemplateMo 551 Stand Blog

https://templatemo.com/tm-551-stand-blog

-->
  </head>

  <body>

    @include('layouts.template.public.header')

    @include('layouts.template.public.banner')

    @yield('content')
    
    
    
    @include('layouts.template.public.footer')

    @include('layouts.template.public.scripts')

  </body>
</html>