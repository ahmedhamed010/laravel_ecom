<!DOCTYPE html>
<html>

<head>

    @include('home.css');

</head>
<body>
    <div class="hero_area">

        

        <!-- header section strats -->

            @include('home.header')

        <!-- end header section -->







    </div>

        <!-- product details section -->

        <section class="shop_section layout_padding">

            <div class="container">
                <div class="heading_container heading_center">
                    <h2> Product Details</h2>
                </div>
                <div class="row">
                    <div class=" col-md-12">
                        <div class="box">
                            <div class="img-box">
                                @if($data->images)
                                    @php
                                        $images = json_decode($data->images);
                                    @endphp
                                    @if(isset($images[1])) <!-- هنا تحدد الصورة الثانية (index 1) -->
                                        <img src="{{ asset('products/'.$images[1]) }}" style="width: 100px; height: 100px;">
                                    @else
                                        <img src="{{ asset('products/'.$images[0]) }}" style="width: 100px; height: 100px;"> <!-- إذا لم توجد الصورة الثانية، يتم عرض الأولى -->
                                    @endif
                                @endif
                            </div>
                            <div class="detail-box" style="padding: 15px">
                                <h6>{{$data->title}}</h6>
                                <h6>Price : <span>${{$data->price}}</span></h6>
                            </div>

                            <div class="detail-box" style="padding: 15px">
                                <h6>Category : {{$data->category}}</h6>
                                <h6>Available Quantity : <span>{{$data->quantity}}</span></h6>
                            </div>

                            <div class="detail-box" style="padding: 15px">
                                <p> <span>Description : </span>{{$data->description}}</p>
                            </div>

                            <div>
                                <a class="btn bg-dark text-white btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" href="{{url('add_cart' , $data->id)}}">Add to cart</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </section>


            {{-- <div class="row mb-5">
                <div class="col-lg-6">
                  <!-- PRODUCT SLIDER-->
                  <div class="row m-sm-0">
                    <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0">
                      <div class="owl-thumbs d-flex flex-row flex-sm-column" data-slider-id="1">

                        <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0">
                            @if($data->images)
                                @php
                                    $images = json_decode($data->images);
                                @endphp
                                @foreach($images as $image)
                                    <img class="w-100" src="{{ asset('products/'.$image) }}" alt="">
                                @endforeach
                            @endif
                        </div>
                        

    
                      </div>
                    </div>
                    <div class="col-sm-10 order-1 order-sm-2">
                      <div class="owl-carousel product-slider" data-slider-id="1">

                        @if($data->images)
                        @php
                            $images = json_decode($data->images);
                        @endphp
                        @foreach($images as $image)
                            <a class="d-block" href="{{ asset('products/'.$image) }}" data-lightbox="product" title="Product item">
                                <img class="img-fluid" src="{{ asset('products/'.$image) }}" alt="">
                            </a>
                        @endforeach
                    @endif
                      </div>
                    </div>
                  </div>
                </div>
                <!-- PRODUCT DETAILS-->
                <div class="col-lg-6">
                  <ul class="list-inline mb-2">
                    <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                  </ul>
                  <h1>{{$data->title}}></h1>
                  <p class="text-muted lead">${{$data->price}}</p>
                  <p class="text-small mb-4">{{$data->description}}.</p>
                  <div class="row align-items-stretch mb-4">
                    <div class="col-sm-5 pr-sm-0">
                      <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                        <div class="quantity">
                          <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                          <input class="form-control border-0 shadow-0 p-0" type="text" value="1">
                          <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3 pl-sm-0"><a class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" href="cart.php">Add to cart</a></div>
                  </div><a class="btn btn-link text-dark p-0 mb-4" href="#"><i class="far fa-heart mr-2"></i>Add to wish list</a><br>
                  <ul class="list-unstyled small d-inline-block">
                    <li class="px-3 py-2 mb-1 bg-white"><strong class="text-uppercase">SKU:</strong><span class="ml-2 text-muted">039</span></li>
                    <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Category:</strong><a class="reset-anchor ml-2" href="#">
                        {{$data->category}}
                    </a></li>
                    <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Tags:</strong><a class="reset-anchor ml-2" href="#">Innovation</a></li>
                  </ul>
                </div>
              </div> --}}
        
            <!-- end product details section -->







    


        <!-- footer section -->

            @include('home.footer')

        <!-- end footer section -->

</body>

</html>