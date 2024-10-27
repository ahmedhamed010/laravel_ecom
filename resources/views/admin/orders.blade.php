
@include('admin.header')

<div class="d-flex align-items-stretch">
<!-- Sidebar Navigation-->

    @include('admin.sidebar')

<!-- Sidebar Navigation end-->
<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">All Orders</h2>
        </div>
    </div>

    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th>customer name</th>
                    <th>Address</th>
                    <th>phone</th>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Payment Status</th>
                    <th>status</th>
                    <th>Change status</th>
                    <th>Print Pdf</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $data)
                    <tr>
                        <th>{{$data->name}}</th>
                        <td>{{$data->rec_address}}</td>
                        <td>{{$data->phone}}</td>
                        <td>{{$data->product->title}}</td>
                        <td>${{$data->product->price}}</td>
                        <td>
                            @if($data->product->images)
                                @php
                                    $images = json_decode($data->product->images);
                                @endphp
                                @foreach($images as $image)
                                    <img src="products/{{$image}}" style="width: 50px; height: 50px;" >
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if ($data->payment_status == 'cash on delivery')
                                <span style="color: red">{{$data->payment_status}}</span>
                            @else
                            <span style="color: green">{{$data->payment_status}}</span>
                            @endif
                        </td>
                        <td>
                            @if ($data->status == 'in progress')
                                <span style="color: red">{{$data->status}}</span>
                            @elseif ($data->status == 'on the way')
                            <span style="color: orange">{{$data->status}}</span>
                            @else
                            <span style="color: green">{{$data->status}}</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-danger" href="{{url('on_the_way' , $data->id)}}">On The Way</a>
                            <a class="btn btn-success" href="{{url('delivered' , $data->id)}}">Delivered</a>
                        </td>
                        <td>
                            <a class="btn btn-secondary" href="{{url('print_pdf' , $data->id)}}">Print Pdf</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>

    

    @include('admin.footer')