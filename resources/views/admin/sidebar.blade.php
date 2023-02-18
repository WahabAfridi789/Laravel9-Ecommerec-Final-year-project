 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
         <li class="nav-item">
             <a class="nav-link" href="{{ url('admin_dashboard') }}">
                 <i class="mdi mdi-grid-large menu-icon"></i>
                 <span class="menu-title">Dashboard</span>
             </a>
         </li>

         <li class="nav-item nav-category"> Categories Meni</li>
         <li class="nav-item">
             <a class="nav-link" href="{{ url('categories') }}">
                 <i class="mdi mdi-grid-large menu-icon"></i>
                 <span class="menu-title">Categories</span>
             </a>
         </li>


         <li class="nav-item nav-category"> Products Menu</li>
         <li class="nav-item">
             <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                 aria-controls="form-elements">
                 <i class="menu-icon mdi mdi-card-text-outline"></i>
                 <span class="menu-title">Products</span>
                 <i class="menu-arrow"></i>
             </a>
             <div class="collapse" id="form-elements">
                 <ul class="nav flex-column sub-menu">
                     <li class="nav-item"><a class="nav-link" href="{{ url('view_product') }}">Addd Products</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ url('/show_product') }}">Show Products</a></li>
                 </ul>
             </div>
         </li>


         <li class="nav-item nav-category"> Orders Menu</li>
         <li class="nav-item">
             <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                 <i class="menu-icon mdi mdi-table"></i>
                 <span class="menu-title">Orders</span>
                 <i class="menu-arrow"></i>
             </a>
             <div class="collapse" id="tables">
                 <ul class="nav flex-column sub-menu">
                     <li class="nav-item"> <a class="nav-link" href="{{ url('pending_order') }}">Pending Orders</a></li>
                     <li class="nav-item"> <a class="nav-link" href="{{ url('delivered_orders') }}">Delivered Orders</a></li>
                 </ul>
             </div>
         </li>



     </ul>
 </nav>
