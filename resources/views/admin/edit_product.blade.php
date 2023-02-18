<base href="/public">
@include('admin.css')
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
                Update Products
            </h2>

            <form action="{{url('/update_product_confirm',$product->id)}}" method="post" enctype="multipart/form-data">
                @csrf

                  <div class="form-group">
                        <label for="exampleInputName1">Product Title</label>
                        <input type="text" name="title" class="form-control" id="exampleInputName1" placeholder="Enter product title here" required="" value="{{$product->title}}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail3">Description</label>
                        <input type="text" class="form-control" name="description" id="exampleInputEmail3" placeholder="Write a description" value={{$product->description}}>
                      </div>


            <div class="form-group">
                <label for="">Product Price</label>
                <input class="form-control" type="text" name="price" placeholder = "Write a price" required="" value="{{$product->price}}">
            </div>

              <div class="form-group">
                <label for="">Discount Price</label>
                <input class="form-control" type="text" name="discount_price" placeholder = "Write a price"  value="{{$product->discount_price}}">
            </div>

            <div class="form-group">
                <label for="">Product Quantity</label>
                <input class="form-control" type="number" name="quantity" placeholder = "" min="0"  value="{{$product->quantity}}">
            </div>

            <div class="form-group">
                <label for="">Product Category</label>
                <select class="form-control" name="category" id="" required="">
                    <option value="{{$product->category}}" selected="">{{$product->category}}</option>
                    @foreach($category as $category)
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="">
                <label for="">Current Product Image</label>
                <img src="product/{{$product->image}}" alt="" width="100px" height="100px">
            </div>



            <div class="">
                <label for="">Change Product Image</label>
                <input type="file" name="image" placeholder = "Write a price" >
            </div>




            <div class="">
                <input type="submit" value="Update Product" class="btn btn-primary">

            </div>
            <div class="">
                <a href="{{ url('show_product') }}" class="btn btnprimary">Back to Products</a>

            </div>
          </form>
</div>
</div>
</div>
</div>
