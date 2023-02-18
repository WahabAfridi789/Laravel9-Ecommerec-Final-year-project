<!DOCTYPE html>
<html>

<head>
    <base href="/public">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Basic -->
    @include('home.css')
</head>

<body>

    @include('sweetalert::alert')
    <div class="hero_area">

        <!-- header section strats -->

        @include('home.header')
        <!-- end header section -->

        <!-- Your Cart -->
        <section class="inner_page_head">
            <div class="container_fuild">
                <div class="row">
                    <div class="col-md-12">
                        <div class="full">
                            <h3>Your Cart</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="content-wrapper">
            <table class="table table-striped table-dark">
                <thead class="thead-light">
                    <tr>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Sub Total</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $total_items_price = 0; ?>
                    @if (count($cart) == 0)
                        <tr>
                            <td colspan="6" class="text-center">Your Cart is empty</td>
                        </tr>


                        <tr>
                            <td colspan="6" class="text-center">
                                <a href="{{ url('products') }}"
                                    style="background:#f7444e;
                    border:none"
                                    class="btn btn-primary">Shop Now</a>
                            </td>
                    @endif
                    @foreach ($cart as $item)
                        <tr>
                            <td>{{ $item->product_title }}</td>
                            <td>
                                <img width="100px" src="{{ asset('product/' . $item->product_image) }}" alt="">
                            </td>
                            <td>${{ $item->product_price }}</td>
                            <td>{{ $item->product_quantity }}</td>
                            <td>${{ $item->product_price * $item->product_quantity }}</td>
                            <td>
                                <a href="{{ url('delete_from_cart', $item->id) }}"
                                    onclick="return confirm(
                        'Are you sure to delete this item from cart?')"
                                    class="btn btn-danger " id="{{ $item->id }}"><i class="fa fa-trash"> </i></a>
                            </td>

                            <!-- <td>
                    <a href="{{ url('delete_from_cart', $item->id) }}"
                     class="btn btn-danger deletefromcart" id="{{ $item->id }}" >Remove ajax</a>

                </td> -->
                        </tr>
                        <?php $total_items_price += $item->product_price * $item->product_quantity; ?>
                    @endforeach

                    @if (count($cart) != 0)
                        <tr>
                            <td colspan="4" class="text-right">Total Price</td>
                            <td>${{ $total_items_price }}</td>
                            <td></td>
                        </tr>


                    @endif

                </tbody>


            </table>

            <div class="text-center">
                <a href="{{ url('products') }}"
                    style="background:#f7444e;
                    border:none"
                    class="btn btn-primary">Shop Now</a>
                @if (count($cart) != 0)
                    <a href="{{ url('checkout') }}"
                        style="background:#f7444e;
                    border:none"
                        class="btn btn-primary">Checkout</a>

                        <a href="{{ url('stripe',$total_items_price) }}"
                        style="background:#f7444e;
                    border:none"
                        class="btn btn-primary">Proceed to payment</a>
                @endif
            </div>
        </div>
        <!-- end slider section -->

        <div class="content-wrapper">
            <table class="table table-striped table-dark">
                <thead class="thead-light">
                    <tr>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Sub Total</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="cart_items">

                </tbody>


            </table>
            <br><br><br>



        </div>

        <!-- footer start -->
        @include('home.footer')
        <!-- footer end -->
        <div class="cpy_">
            <p class="mx-auto">© 2023 All Rights Reserved By <a href="https://html.design/">Abdul Wahab </a><br>

                Distributed By <a href="#" target="_blank">Maouz Anwar</a>
            </p>
        </div>
        <!-- jQery -->
        @include('home.script')
        <script>
            //delete cart item from cart using ajax

            function fetchCartData() {
                $.ajax({
                    url: 'fetch_cart_data',
                    type: 'get',
                    success: function(response) {
                        console.log(response);
                        $('#cart_items').html(response);
                    }
                });
            }

            fetchCartData();

            $(document).ready(function() {

                $(document).on('click', '.deletefromcart', function(e) {
                    e.preventDefault();
                    var id = $(this).attr('id');
                    console.log(id);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: 'delete_from_cart_ajax/' + id,
                        type: 'delete',
                        success: function(data) {
                            console.log(data);
                            if (data.status == 'success') {
                                swal("Success", "Item deleted from cart", "success");
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }
                        }
                    });
                    fetchCartData();
                });


            });
        </script>
</body>

</html>
