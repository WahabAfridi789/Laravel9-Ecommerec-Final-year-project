<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab"
                                                href="#overview" role="tab" aria-controls="overview"
                                                aria-selected="true">Overview</a>
                                        </li>
                                    </ul>

                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                        aria-labelledby="overview">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div
                                                    class="statistics-details d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <p class="statistics-title">Total orders

                                                        </p>
                                                        <h3 class="rate-percentage">

                                                            <?php $order = App\Models\Order::all(); ?>
                                                            {{ $order->count() }}
                                                        </h3>

                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Pending Orders</p>
                                                        <h3 class="rate-percentage">
                                                            {{ $order->where('delivery_status', 'processing')->count() }}

                                                        </h3>

                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Completed Orders</p>

                                                        <h3 class="rate-percentage">
                                                            {{ $order->where('delivery_status', 'Delivered')->count() }}
                                                        </h3>
                                                        {{-- <h3 class="rate-percentage"> {{$order->where('status','delivered')->count()}}</h3> --}}

                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Total Users</p>
                                                        <h3 class="rate-percentage">
                                                            <?php $user = App\Models\User::all(); ?>
                                                            {{ $user->count() - 1 }}
                                                        </h3>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Total Categories</p>
                                                        <h3 class="rate-percentage">
                                                            <?php $category = App\Models\Category::all(); ?>
                                                            {{ $category->count() }}
                                                        </h3>

                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title"></p>
                                                        <h3 class="rate-percentage"></h3>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                                        <div class="card bg-primary card-rounded">
                                                            <div class="card-body pb-0">
                                                                <h4 class="card-title card-title-dash text-white mb-4">
                                                                    Total Revnue</h4>
                                                                <div class="row">
                                                                    <div class="col-sm-8 ">
                                                                        <h2
                                                                            class="card-title card-title-dash text-white mb-4 fs-2">
                                                                            <?php $payment = App\Models\Payment::all();
                                                                            $total = $payment->sum('total_amount');
                                                                            ?>
                                                                            ${{ $total }}.00
                                                                        </h2>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="status-summary-chart-wrapper pb-4">
                                                                            <canvas id="status-summary"></canvas>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
