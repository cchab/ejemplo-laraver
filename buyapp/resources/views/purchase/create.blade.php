<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Usuarios</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
        crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h1>Registrar compra</h1>
    <div class="clontainer">
        <form method="post" action="/purchase" class="form-horizontal" id="form_purchase">
            @csrf
            <div class="col-lg-6">
                <div class="form-group">
            <input type="button" value="agregar producto" class="btn btn-primary" id="btnAdd">
                </div>
            </div>
            <div id="products-list"class="row col-md-12 form-group invisible" >

                    <div class="col-md-4">
                        <select class="products" name="product" id="product" class="form-control">
                            @foreach($products as $p)
                                <option value="{{$p->id}}"
                                        data-price = {{$p->unit_price}}
                                >{{$p->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label name="price" id="price" type="number" class="form-label"> 0.00</label>
                    </div>
                    <div class="col-md-2">
                        <input name="quantity" id="quantity" placeholder="cantidad" type="number" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label name="total" id="total" class="form-label"> 0.00</label>
                    </div>
                    <div class="col-md-2">
                        <input type="button" value="Agregar" class="btn btn-primary" id="addProduct">
                    </div>


            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <input type="submit" name="enviar" id="btn_enviar" value="Guardar" class="btn btn-success">
                </div>
            </div>
        </form>
    </div>

</div>
<script>
    $(document).ready(function () {
        $('#btnAdd').on('click',addProduct_onClick);
        $('.products').on('change',function () {
            $('#price').text($(this).find('option:selected').data('price'));
        })
        $('#quantity').on('change',function () {
            let total = parseFloat($('#price').text()) * parseInt($(this).val());
            $('#total').text(total);
        })
    })

    function addProduct_onClick(){
        $('#products-list').removeClass('invisible');
    }

</script>
</body>
</html>

