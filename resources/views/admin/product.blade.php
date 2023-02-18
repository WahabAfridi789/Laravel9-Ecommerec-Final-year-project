

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
@include('admin.css')
</head>
<body>
  <div class="container-scroller">

 @include('admin.header')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border me-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border me-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>



      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-12 grid-margin stretch-card" >
              <div class="card">
                @if(session()->has('message'))
                  <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss= "alert" aria-hidden="true">X</button>

            {{session()->get('message')}}
        </div>
        @endif
           <div class="card-body">
        <div class="div_center">
            <h2>
                Add Products
            </h2>

            <form action="{{url('/add_product')}}" method="post" enctype="multipart/form-data">
                @csrf

                  <div class="form-group">
                        <label for="exampleInputName1">Product Title</label>
                        <input type="text" name="title" class="form-control" id="exampleInputName1" placeholder="Enter product title here" required="">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail3">Description</label>
                        <input type="text" class="form-control" name="description" id="exampleInputEmail3" placeholder="Write a description">
                      </div>


            <div class="form-group">
                <label for="">Product Price</label>
                <input class="form-control" type="text" name="price" placeholder = "Write a price" required="">
            </div>

              <div class="form-group">
                <label for="">Discount Price</label>
                <input class="form-control" type="text" name="discount_price" placeholder = "Write a price">
            </div>

            <div class="form-group">
                <label for="">Product Quantity</label>
                <input class="form-control" type="number" name="quantity" placeholder = "" min="0" required="">
            </div>

            <div class="form-group">
                <label for="">Product Category</label>
                <select class="form-control" name="category" id="" required="">
                    <option value="" selected="">Add a category</option>
                    @foreach($category as $category)
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="">
                <label for="">Product Image</label>
                <input type="file" name="image" placeholder = "Write a price" required="">
            </div>




            <div class="">
                <input type="submit" value="Add Product" class="btn btn-primary">
            </div>
          </form>
</div>
</div>
</div>
</div>


      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
    @include('admin.script')
  <!-- End custom js for this page-->
</body>

</html>

