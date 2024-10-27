<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h3>Customer Name : {{$data->name}}</h3>

    <h3>Customer Address : {{$data->rec_address}}</h3>

    <h3>Phone : {{$data->phone}}</h3>

    <h2>Product Title : {{$data->product->title}}</h2>
    <h2>Price : {{$data->product->price}}</h2>
    @if($data->product->images)
        @php
            $images = json_decode($data->product->images);
        @endphp
        @foreach($images as $image)
            <img src="products/{{$image}}" style="width: 50px; height: 50px;" >
        @endforeach
    @endif

</body>
</html>