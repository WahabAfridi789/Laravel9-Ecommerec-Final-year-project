<!DOCTYPE html>
<html>

<head>
    <base href="/public">
    <!-- Basic -->
    @include('home.css')
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')

        <section class="product_section layout_padding">
            <div class="container">
                <div class="heading_container heading_center">
                    <h2>
                        Our <span>products</span>
                    </h2>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box">
                            <div class="option_container">
                                @if ($product->quantity == 0)
                                    <div class="options">
                                       
                                        <label class="btn btn-danger">
                                            Sold Out
                                        </label>
                                    </div>
                                @else
                                    <div class="options">
                                        <a href="{{ url('product_details', $product->id) }}" class="option1">
                                            Product Details
                                        </a>
                                        <a href="" class="option2">
                                            Buy Now
                                        </a>
                                    </div>
                                @endif

                            </div>
                            <div class="img-box">

                                <img src="product/{{ $product->image }}" alt="">

                            </div>
                            <div class="detail-box">
                                <h5>
                                    ${{ $product->title }}
                                </h5>

                                @if ($product->discount != 0)
                                    <h6 style="color:f7444e;">
                                        Discount price <br>
                                        ${{ $product->discount }}
                                    </h6>

                                    <h6 style="text-decoration:line-through">
                                        Price <br>
                                        ${{ $product->price }}
                                    </h6>
                                @else
                                    <h6>
                                        Price <br>
                                        ${{ $product->price }}
                                    </h6>
                                @endif





                            </div>

                        </div>
                        <h6 class="text-center">
                            <span>
                                Category:
                            </span>
                            <span>
                                {{ $product->category }}
                            </span>
                        </h6>
                        <h6 class="text-center">
                            <span>
                                Available Quantity:
                            </span>

                            <span>
                                {{ $product->quantity }}
                            </span>

                        </h6>
                        <h6 class="text-center">
                            <span>
                                Description:
                            </span>
                            <span>
                                {{ $product->description }}
                            </span>
                        </h6>

                        <form action="{{ url('add_cart', $product->id) }}" method="post">
                            @csrf

                            @if($product->quantity!=0)
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="number" min="1" max="{{ $product->quantity }}" name="quantity"
                                        value="" style="width:100px">
                                </div>
                                <div class="col-md-4">
                                    <input type="submit" value="Add To Cart">
                                </div>

                            </div>
                            @endif
                        </form>

                    </div>
                </div>
        </section>


    </div>





    @include('home.footer')



    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

        </p>
    </div>

    <!-- jQery -->
    @include('home.script')
</body>

</html>
