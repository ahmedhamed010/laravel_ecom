
@include('admin.header')

<div class="d-flex align-items-stretch">
<!-- Sidebar Navigation-->

    @include('admin.sidebar')

<!-- Sidebar Navigation end-->
<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Edit Product</h2>
        </div>
    </div>

    <div class="container-fluid">

        <form enctype="multipart/form-data" method="post" action="{{url('edit_product' , $data->id)}}">

            @csrf

            <div class="form-group">
                <label for="title" style="font-weight: bold;"> Product Title :</label>
                <input type="text" class="form-control" name="title" value="{{$data->title}}" required>
            </div>
            
            <div class="form-group">
                <label for="price" style="font-weight: bold;"> Price :</label>
                <input type="text" class="form-control" name="price" value="{{$data->price}}" required>
            </div>

            <div class="form-group">
                <label for="category" style="font-weight: bold;">Category:</label>
                <select class="form-control" name="category" required>
                    <option value="{{$data->category}}">{{$data->category}}</option>
                    @foreach($category as $cat)
                        <option value="{{ $cat->category_name }}">
                            {{ $cat->category_name  }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            

            <div class="form-group">
                <label for="description" style="font-weight: bold;"> Description :</label>
                <textarea class="form-control" name="description" value="" required>{{$data->description}}</textarea>
            </div>


            <div class="form-group">
                <label for="quantity" style="font-weight: bold;"> Quantity :</label>
                <input type="number" class="form-control" name="quantity" value="{{$data->quantity}}" required>
            </div>
        
            <div class="form-group">
                <label for="image" style="font-weight: bold;">Images:</label>
                <input type="file" class="form-control" id="image" name="images[]" multiple>
                <br>
                @if($data->images)
                    @php
                        $images = json_decode($data->images);
                    @endphp
                    @foreach($images as $image)
                        <img src="{{ asset('products/'.$image) }}" style="width: 50px; height: 50px; margin-right: 5px;">
                    @endforeach
                @endif
            </div>
            
        
        
            <button type="submit" class="btn btn-primary form-control">Update product</button> 
        </form>

    </div>

</div>
    
  
   @include('admin.footer')