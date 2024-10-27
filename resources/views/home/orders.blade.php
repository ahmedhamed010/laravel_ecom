<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('home.css')
    <title>Document</title>
</head>
<body>

    <div class="hero_area">


            @include('home.header')


            <table class="table mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Delivery Status</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $order )
                        <tr>
                            <td>{{$order->product->title}}</td>
                            <td>{{$order->product->price}}</td>
                            <td>{{$order->status}}</td>
                            <td>  @if($order->product->images)
                                @php
                                    $images = json_decode($order->product->images);
                                @endphp
                                @foreach($images as $image)
                                    <img src="products/{{$image}}" style="width: 50px; height: 50px;" >
                                @endforeach
                            @endif</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


    </div>

                @include('home.footer')

</body>
</html>