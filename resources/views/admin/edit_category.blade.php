
@include('admin.header')

<div class="d-flex align-items-stretch">
<!-- Sidebar Navigation-->

    @include('admin.sidebar')

<!-- Sidebar Navigation end-->
<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Update Category</h2>
        </div>
    </div>

    <div class="container-fluid">
        <form method="post" action="{{url('update_category' , $data->id)}}">
        
            @csrf

            <div class="form-group">
                <label for="category" style="font-weight: bold;" > Update Category :</label>
                <input type="text" class="form-control" name="category" value="{{$data->category_name}}">
            </div>
        
            <div class="form-group">
                <input type="submit" value="Update Category" class="form-control btn btn-success">
            </div>
    
        </form>
    </div>

</div>
   
   @include('admin.footer')