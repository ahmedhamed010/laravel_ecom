<!DOCTYPE html>
<html>

<head>
  <style>
    .text-danger{
      color: #e72010 !important
    }
  </style>

    @include('home.css')

</head>
<body>
    <div class="hero_area">

        

        <!-- header section strats -->

            @include('home.header')

        <!-- end header section -->

        <section class="contact_section ">
          <div class="container px-0">
            <div class="heading_container ">
              <h2 class="">
                Contact Us
              </h2>
            </div>
          </div>
          <div class="container container-bg">
            <div class="row">
              <div class="col-lg-7 col-md-6 px-0">
                <div class="map_container">
                  <div class="map-responsive">
                    <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Eiffel+Tower+Paris+France" width="600" height="300" frameborder="0" style="border:0; width: 100%; height:100%" allowfullscreen></iframe>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-5 px-0">
                @if (Session::has('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success')}}
                  </div>
                @endif
                <form action="{{url('contact_store')}}" method="post" class="leave-comment">
                  @csrf

                  <div class="form-floating my-4">
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" />
                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                
                <div class="form-floating my-4">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" />
                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                
                <div class="form-floating my-4">
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone" />
                    @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                
                <div class="form-floating my-4">
                    <input type="text" name="message" value="{{ old('message') }}" class="message-box" placeholder="Message" />
                    @error('message')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                

                  <div class="d-flex ">
                    <button value="submit">
                      SEND
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      
        <br><br><br>



    </div>




        <!-- footer section -->

            @include('home.footer')

        <!-- end footer section -->

</body>

</html>