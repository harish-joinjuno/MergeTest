@extends('template.public')

@section('content')

    <div id="form-page">
        <div class="form-wrapper">
            {{--<div class="typeform-widget" data-url="https://leveredge.typeform.com/to/rnsA02?first_name={{$first_name}}&email_address={{$email_address}}" style="width: 100%; height: 100%;"></div> <script> (function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm", b="https://embed.typeform.com/"; if(!gi.call(d,id)) { js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })() </script>--}}

            <iframe id="typeform-full" width="100%" height="100%" frameborder="0" src="https://leveredge.typeform.com/to/rnsA02?first_name={{$first_name}}&email_address={{$email_address}}"></iframe> <script type="text/javascript" src="https://embed.typeform.com/embed.js"></script>
        </div>
    </div>

@endsection

{{--<html> <head> <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> <title>Determine Refi Eligibility</title> <style type="text/css"> html{ margin: 0; height: 100%; overflow: hidden; } iframe{ position: absolute; left:0; right:0; bottom:0; top:0; border:0; } </style> </head> <body> <iframe id="typeform-full" width="100%" height="100%" frameborder="0" src="https://leveredge.typeform.com/to/rnsA02"></iframe> <script type="text/javascript" src="https://embed.typeform.com/embed.js"></script> </body> </html>--}}
