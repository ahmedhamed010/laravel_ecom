<!DOCTYPE html>
<html>

<head>

    @include('home.css')

</head>
<body>
    <div class="hero_area">

        

        <!-- header section strats -->

            @include('home.header')

        <!-- end header section -->

        
        <div class="table-responsive mb-4 ">
            <table class="table">
                <thead class="bg-light">
                    <tr>
                        <th> <strong class="text-small text-uppercase">Product</strong></th>
                        <th> <strong class="text-small text-uppercase">Price</strong></th>
                        <th> <strong class="text-small text-uppercase">Quantity</strong></th>
                        <th> <strong class="text-small text-uppercase">Image</strong></th>
                        <th> <strong class="text-small text-uppercase">Controls</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $value = 0 ;
                    ?>
                    @foreach ($cart as $cart )
                    <tr>
                        <td>{{$cart->product->title}}</td>
                        <td>${{$cart->product->price}}</td>
                        <td>{{$cart->product->quantity}}</td>
                        <td width="200px">
                            @if($cart->product->images)
                                @php
                                    $images = json_decode($cart->product->images);
                                @endphp
                                @foreach($images as $image)
                                    <img src="products/{{$image}}" style="width: 50px; height: 50px;" >
                                @endforeach
                            @endif
                        </td>
                        <td><a href="{{url('delete_product' , $cart->id)}}" class="btn btn-danger" onclick="confirmation(event)">Delete</a></td>
                    </tr>            
                        <?php
                            $value = $value + $cart->product->price ;
                        ?>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center " style="padding: 20px">
            <h3>Total Value Of Cart Is : ${{$value}}</h3>
        </div>


        <div class="mt-4">
            <h2 class="h5 text-uppercase mb-4">Billing details</h2>
            <div class="col-lg-8">
                <form action="{{url('confirm_order')}}" method="post">
                    @csrf
                <div class="row">
                    <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="firstName">First name</label>
                    <input class="form-control form-control-lg" name="name" type="text" value="{{Auth::user()->name}}" placeholder="Enter your first name">
                    </div>
                    <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="email"> Address</label>
                    <input class="form-control form-control-lg" name="address" type="text" value="{{Auth::user()->address}}" placeholder="e.g. Jason@example.com">
                    </div>
                    <div class="col-lg-12    form-group">
                    <label class="text-small text-uppercase" for="phone">Phone number</label>
                    <input class="form-control form-control-lg" name="phone" type="tel" value="{{Auth::user()->phone}}" placeholder="e.g. +02 245354745">
                    </div>

                    <div class="col-lg-12 form-group">
                    <button class="btn btn-dark" type="submit">cash on delivery</button>
                    <a class="btn btn-success" href="{{url('stripe' , $value)}}"> Pay Using Cart </a>
                    </div>
                </div>
                </form>
            </div>
        </div>


    </div>

    <script>

        function confirmation(ev) {
            ev.preventDefault(); // لمنع تنفيذ الرابط تلقائيًا
            var urlToRedirect = ev.currentTarget.getAttribute('href'); // الحصول على رابط التحويل
    
            swal({
                title: "Are You Sure To Delete This?",
                text: "This Delete Will Be Permanent",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = urlToRedirect; // إعادة التوجيه إذا تم التأكيد
                }
            });
        }
    
    </script>
    


        <!-- footer section -->

            @include('home.footer')

        <!-- end footer section -->

</body>

</html>