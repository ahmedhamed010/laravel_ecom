
@include('admin.header')

<div class="d-flex align-items-stretch">
<!-- Sidebar Navigation-->

    @include('admin.sidebar')

<!-- Sidebar Navigation end-->
<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">All Products</h2>
        </div>
    </div>
    
    <div class="container-fluid">

        <form class="row g-3" method="get" action="{{url('product_search')}}">
            @csrf
            <div class="col-auto">
                <input type="search" class="form-control" name="search" placeholder="Search" value="{{ request()->query('search') }}">
            </div>
            <div class="col-auto">
                <input type="submit" class="btn btn-info mb-3" value="Search">
            </div>
        </form>

        <table class="table table_hover table_bordered table_striped" id="productsTable">

            <thead>
                <tr>
                    <th>id</th>
                    <th>Title</th>
                    <th>price</th>
                    <th>category</th>
                    <th>description</th> 
                    <th>count</th>
                    <th>img</th>
                    <th>controls</th>
                </tr>
            </thead>
        
            <tbody>
                
                @foreach ( $product as $pro )
                
            <tr>
                <td>{{$pro->id}}</td>
                <td>{{$pro->title}}</td>
                <td>{{$pro->price}}</td>
                <td>{{$pro->category}}</td>
                {{-- Show Short Description  --}}
                {{-- limit   => بتحدد عدد الحروف --}}
                {{-- words   => بتحدد عدد الكلمات --}}
                <td>{!!Str::words($pro->description , 2)!!}</td>
                <td>{{$pro->quantity}}</td>
                <td width="200px">
                    @if($pro->images)
                        @php
                            $images = json_decode($pro->images);
                        @endphp
                        @foreach($images as $image)
                            <img src="products/{{$image}}" style="width: 50px; height: 50px;" >
                        @endforeach
                    @endif
                </td>
                
                <td>  
                    <a class="btn btn-primary" href="{{url('update_product' , $pro->slug)}}">Edit</a>
                    <a href="{{url('delete_product' , $pro->id)}}" class="btn btn-danger" onclick="confirmation(event)">Delete</a>
                </td>
            </tr>
            @endforeach        
            </tbody>
        </table>

            {{-- pagination --}}
        <div class="d-flex justify-content-center">
            {{ $product->appends(['search' => request()->query('search')])->onEachSide(1)->links() }}
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
        .then((willCancel) => {
            if (willCancel) {
                window.location.href=urlToRedirect; // إعادة التوجيه إذا تم التأكيد
            }
        });
    }

</script>

    
  
   @include('admin.footer')