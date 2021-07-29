<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
<div class="container">
    <h2>list product</h2>
    <table class="table table-dark table-hover">
        <thead>
        <tr>
            <th>name</th>
            <th>price</th>
            <th>thumbnail</th>
            <th>subtotal</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($shoppingCart as $obj)
            <tr>
                <td>
                    {{$obj -> name}}
                </td>
                <td>
                    {{$obj -> unitPrice}}
                </td>
                <td>
                    <img src="{{$obj -> thumbnail}}" alt="" width="70px">
                </td>
                <td>
                    <a href="/add?productId={{$obj->id}}">
                        <input type="hidden" name="productId"&productQuantity=1>
                        <button class="btn btn-primary">Add to Cart</button>
                    </a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


</body>
</html>

