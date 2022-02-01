@extends('template.public')

@section('content')

    <div id="form-page">
        <div class="form-wrapper">
            {{--<div class="typeform-widget" data-url="https://leveredge.typeform.com/to/MeT2Ee" style="width: 100%; height: 100%;"></div> <script> (function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm", b="https://embed.typeform.com/"; if(!gi.call(d,id)) { js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })() </script>--}}

            <iframe id="typeform-full" width="100%" height="100%" frameborder="0" src="https://leveredge.typeform.com/to/MeT2Ee"></iframe> <script type="text/javascript" src="https://embed.typeform.com/embed.js"></script>

        </div>
    </div>

@endsection
