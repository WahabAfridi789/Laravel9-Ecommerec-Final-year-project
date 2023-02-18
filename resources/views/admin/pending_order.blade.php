<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        .search_div {



        }

        li {
            list-style: none;
        }
        #search_orders{
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.5);
            padding: 10px;
            font-size: 16px;
            margin-bottom: 10px;
        }
    </style>
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
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border me-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
                    </div>
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
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Pending Orders</h4>


                                <div class="table-responsive">
                                     <li class="search_div">

                                        <input id="search_orders" type="search" class="form-control"
                                            placeholder="Search Here" title="Search here">


                                    </li>
                                    <table class="table table-dark">
                                        <thead>
                                            <tr>

                                                <th> Name </th>
                                                <th> EMail </th>
                                                <th> Address</th>
                                                <th> Phone </th>
                                                <th> Quantity </th>
                                                <th> Product title </th>
                                                <th> Price </th>
                                                <th> Payment Status </th>
                                                <th> Delivery Status </th>
                                                <th> Image </th>
                                                <th>
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody class="all_records">
                                            @foreach ( $order as $order )
                                            <tr>

                                                <td>
                                                    {{ $order->user_name }}
                                                </td>
                                                <td>{{$order->user_email}} </td>
                                                <td>{{$order->user_address}} </td>
                                                <td>{{$order->user_phone}}</td>
                                                <td>{{$order->product_quantity}}</td>
                                                <td>{{$order->product_title}}</td>
                                                <td>{{$order->product_price}}</td>
                                                <td>
                                                    <div class="badge badge-outline-success">{{$order->payment_status}}</div>
                                                </td>
                                                <td>
                                                    <div class="badge badge-outline-success">{{$order->delivery_status}}</div>
                                                </td>
                                                <td>

                                                    <img src="{{ asset('product/' . $order->product_image) }}" width="100px"
                                                        height="100px">
                                                </td>

                                               @if ($order->delivery_status == 'processing')
                                                    <td>
                                                    <a href="{{ url('delivered_order', $order->id) }}" onclick="return confirm('Are you sure?')"
                                                        class="btn btn-danger">Delivered</a>
                                                </td>
                                                @else
                                                <td>
                                                    <strong>
                                                        Delivered
                                                    </strong>
                                                </td>
                                               @endif

                                            </tr>
 @endforeach
                                        </tbody>

<tbody id="tbody_ajax" class="search_record_table">

                                        </tbody>
                                    </table>
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
