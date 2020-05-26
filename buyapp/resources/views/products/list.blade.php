<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Usuarios</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}"></link>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav mr-sm-2">
            <a id="show_car" class="nav-item nav-link active" href="#">
                <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><span id="car">Carrito</span></a>

        </div>
    </div>
</nav>
<div class="container">
    <h1>Buscador de productos</h1>

        <form action="/products/list" method="get" class="form-horizontal">
            <div class="form-group row">
                <div class="col-md-10">
                    <input type="text" name="search" id="search" class="form-control" >
                </div>
                <div class="col-md-2">
                    <input type="submit" value="Buscar" class="btn btn-primary btn-block">
                </div>

            </div>
        </form>

        @foreach($products as $p)
        <div class="row row-list">
            <div class="col-md-3">
                <img src={{isset($p->photo) ? url($p->photo) : "https://informesinbandera.com/img/placeholder-img.png"}} alt="" width="250px">
            </div>
            <div class="col-md-6">
                <h2>{{$p->name}}</h2>
                <h5>{{$p->city}},{{$p->country}}</h5>
                <p>
                    {{$p->description}}
                </p>
            </div>
            <div class="col-md-3">
                <div class="col-md-12">
                    @php
                        setlocale(LC_MONETARY, 'es_MX');
                    @endphp
                    <h3>${{$p->unit_price}}</h3>
                </div>

                <div class="col-md-12">
                    <span class="glyphicon glyphicon-send" aria-hidden="true"></span>Envío Gratis
                </div>
                @if($p->is_new)
                <div class="col-md-12">
                    <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>Nuevo producto
                </div>
                @endif
                <div class="col-md-12" style="margin-top: 5px;">
                    <input data-product="{{$p->id}}" type="button" class="add_car btn btn-primary btn-block" value="Agregar a carrito">
                </div>
            </div>

        </div>
        @endforeach

</div>
</body>
<script type="text/javascript">
    var products_add=[];
    $(document).ready(function () {
        $('.add_car').on('click',function () {
            products_add.push($(this).data('product'));
            $('span#car').html("Carrito ("+products_add.length+")");
            console.log(products_add);
        })

        $('#show_car').on('click',function () {
            let pars = {};
            pars.products = products_add;
            $.ajax({
                url: '/products/show_car',
                type: 'get',
                dataType: 'json',
                content: 'application/json; charset=utf-8',
                data:pars,
                async: true,
                success:function (data,textStatus,xhr) {

                },
                error:function (xhr, textStatus, errorThrow) {

                }
            });
        })
    });
</script>
</html>
