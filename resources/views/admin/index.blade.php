
            @include('admin.header')

        <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->

            @include('admin.sidebar')

        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Dashboard</h2>
                </div>
            </div>

            @include('admin.body')
            
        </div>

            
          
           @include('admin.footer')