
@include('admin.header')

<div class="d-flex align-items-stretch">
<!-- Sidebar Navigation-->

    @include('admin.sidebar')

<!-- Sidebar Navigation end-->
<div class="page-content">

    <div class="page-header">
        <div class="container-fluid mb-4">
            <h1 class="h5 no-margin-bottom"> Categores </h1>
        </div>
    </div>

    <div class="container-fluid">
        <form method="post" action="{{url('add_category')}}">
        
            @csrf

            <div class="form-group">
                <label for="category" style="font-weight: bold;" > Add Category :</label>
                <input type="text" class="form-control" name="category">
            </div>
        
            <div class="form-group">
                <input type="submit" value="Add Category" class="form-control btn btn-primary">
            </div>
    
        </form>
    </div>

    <div class="container-fluid">
        <table class="table table-bordered w-50 mx-auto text-center">
            <thead class="thead-light">
                <tr>
                    <th>Category Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $data)
                <tr>
                    <td>{{ $data->category_name }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{url('edit_category' , $data->id)}}">Edit</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('delete_category' , $data->id)}}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        

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

@include('admin.footer')