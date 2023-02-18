<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin2 </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="admin/vendors/feather/feather.css">
    <link rel="stylesheet" href="admin/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="admin/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="admin/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="admin/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="admin/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="admin/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="admin/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
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
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">x</button>

                                        {{ session()->get('message') }}
                                    </div>
                                @endif

                                <div class="d-sm-flex justify-content-around align-items-center">
                                    <div>
                                        <h4 class="card-title card-title-dash text-center">Categories List</h4>
                                        <p class="card-subtitle card-subtitle-dash">
                                            <?php $totalCategories = DB::table('categories')->count(); ?>
                                            You
                                            have <strong> {{ $totalCategories }}
                                            </strong> categories</p>
                                    </div>


                                    <div class="d-sm-flex justify-content-between align-items-center">
                                        <form action="{{ url('/add_category') }}" method="POST">
                                            @csrf

                                            <div class="">
                                                <input name="category_name" type="text" class="form-control"
                                                    id="category" placeholder="Enter Category Name" required="">
                                            </div>

                                            <div>
                                                <button type="submit"
                                                    class="btn btn-primary btn-lg text-white mb-0 me-0"
                                                    type="button"><i class="mdi mdi-menu"></i>&nbsp; Add
                                                    new Category</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <div class="table-responsive  mt-1">
                                    <table class="table table-hover text-center">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Item#</th>

                                                <th>Category Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php $count = 0; ?>
                                        @foreach ($data as $data)
                                            <?php $count++; ?>
                                            <tbody class="text-center">
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $data->category_name }}</td>
                                                    <td>
                                                        <a href="{{ url('/delete_category', $data->id) }}"
                                                            class="btn btn-danger text-end">Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>

                            </div>


                            <!-- container-scroller -->
                        </div>
                    </div>
                </div>
            </div>



                        @include('admin.script')
                        <!-- End custom js for this page-->
</body>

</html>
