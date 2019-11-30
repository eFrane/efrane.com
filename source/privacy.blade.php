@extends ('_layouts/master')

@section('title')
    Privacy Statement
@stop

@section('body')
<section class="font-thin text-xs mb-4">
    <h1 class="text-2xl">Privacy Statement</h1>

    <p>
        This website is hosted on a <a href="https://digitalocean.com">Digital Ocean</a>
        droplet in their Frankfurt, Germany Datacenter. All communication is SSL encrypted
        with a <a href="https://letsencrypt.org">Let's encrypt</a> certificate.
        <strong class="font-medium">No logging of any kind is done between the server and
        the web client.</strong>
    </p>
</section>
@stop
