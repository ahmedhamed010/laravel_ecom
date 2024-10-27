
@include('admin.header')

<div class="d-flex align-items-stretch">
<!-- Sidebar Navigation-->

    @include('admin.sidebar')

<!-- Sidebar Navigation end-->
<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Add Product</h2>
        </div>
    </div>

    <div class="container-fluid">

        <form enctype="multipart/form-data" method="post" action="{{url('upload_product')}}">

            @csrf

            <div class="form-group">
                <label for="title" style="font-weight: bold;"> Product Title :</label>
                <input type="text" class="form-control" name="title" required>
            </div>
            
            <div class="form-group">
                <label for="price" style="font-weight: bold;"> Price :</label>
                <input type="text" class="form-control" name="price" required>
            </div>

            <div class="form-group">
                <label for="category" style="font-weight: bold;"> Category :</label>
                <select type="text" class="form-control" name="category" required>

                    @foreach ( $category as $cat )
                        
                        <option value="{{$cat->category_name}}">{{$cat->category_name}}</option>

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description" style="font-weight: bold;"> Description :</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>


            <div class="form-group">
                <label for="quantity" style="font-weight: bold;"> Quantity :</label>
                <input type="number" class="form-control" name="quantity" required>
            </div>
        
            <div class="form-group">
                <label for="image" style="font-weight: bold;"> Image :</label>
                <input type="file" class="form-control" id="image" name="images[]" multiple required>
            </div>
        
        
            <button type="submit" class="btn btn-primary form-control">Add product</button> 
        </form>

    </div>

</div>
    
  
   @include('admin.footer')