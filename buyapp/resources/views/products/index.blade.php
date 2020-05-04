<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Usuarios</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <h1>Lista de productos</h1>
    <div class="row float-right" style="margin-bottom: 10px;">
        <a href="/products/create" class="btn btn-primary">
            Crear Producto
        </a>
    </div>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Nombres</th>
            <th>Cantidad</th>
            <th>Stock</th>
            <th>Precio unitario</th>
            <th>Proveedor</th>
            <th></th>
            <th></th>
        </tr>
        @foreach($products as $p)
            <tr>
                <td>{{$p->id}}</td>
                <td>{{$p->name}}</td>
                <td>{{$p->cantidad}}</td>
                <td>{{$p->stock}}</td>
                <td>{{$p->unit_price}}</td>
                <td>{{$p->provider->name}}</td>
                <td><a href="/products/{{$p->id}}/edit" class="btn btn-warning">
                        Editar
                    </a></td>
                <td>
                    <form action="/products/{{$p->id}}" method="post">
                        @method('DELETE')
                        @csrf
                        <input type="submit" name="eliminar" class="btn btn-danger" value="Eliminar">
                    </form>

            </tr>
        @endforeach
    </table>
</div>
</body>
</html>
