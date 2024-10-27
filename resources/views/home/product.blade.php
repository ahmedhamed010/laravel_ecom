<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">
        @foreach ($product as $pro)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3 d-flex">
                <div class="box h-100">
                    <a href="{{url('product_details', $pro->id)}}">
                        <div class="img-box">
                            @if($pro->images)
                                @php
                                    $images = json_decode($pro->images);
                                @endphp
                                @if(isset($images[2]))
                                    <img src="products/{{$images[1]}}" style="width: 100%; height: auto;">
                                @else
                                    <img src="products/{{$images[0]}}" style="width: 100%; height: auto;">
                                @endif
                            @endif
                        </div>
                        <div class="detail-box mt-2">
                            <h6>{{$pro->title}}</h6>
                            <h6>Price <span>${{$pro->price}}</span></h6>
                        </div>

                        <div>
                          <a class="btn bg-dark text-white btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" href="{{url('add_cart' , $pro->id)}}">Add to cart</a>

                        </div>

                    </a>
                </div>
            </div>
        @endforeach
    </div>
    
      <div class="btn-box">
        <a href="">
          View All Products
        </a>
      </div>
    </div>
  </section>