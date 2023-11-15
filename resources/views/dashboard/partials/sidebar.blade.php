 <!-- Side Nav START -->
 <div class="side-nav">
     <div class="side-nav-inner">
         <ul class="side-nav-menu scrollable">
             <li class="nav-item dropdown">
                 <a href="{{ url('admin/dashboard') }}">
                     <span class="icon-holder">
                         <i class="anticon anticon-home"></i>
                     </span>
                     <span class="title">Dahboard</span>
                 </a>
             </li>
             <li class="nav-item dropdown">
                 <a class="dropdown-toggle" href="javascript:void(0);">
                     <span class="icon-holder">
                         <i class="anticon anticon-pie-chart"></i>
                     </span>
                     <span class="title">Master Data</span>
                     <span class="arrow">
                         <i class="arrow-icon"></i>
                     </span>
                 </a>
                 <ul class="dropdown-menu">
                     <li>
                         <a href="{{ url('admin/categories') }}">Categories</a>
                     </li>
                     <li>
                         <a href="{{ url('admin/tags') }}">Tags</a>
                     </li>
                 </ul>
             </li>
             <li class="nav-item dropdown">
                 <a class="dropdown-toggle" href="javascript:void(0);">
                     <span class="icon-holder">
                         <i class="anticon anticon-dashboard"></i>
                     </span>
                     <span class="title">Product</span>
                     <span class="arrow">
                         <i class="arrow-icon"></i>
                     </span>
                 </a>
                 <ul class="dropdown-menu">
                     <li>
                         <a href="{{ url('admin/products') }}">Products</a>
                     </li>
                     <li>
                         <a href="{{ url('admin/special-products') }}">Special Product</a>
                     </li>
                 </ul>
             </li>
             {{-- <li class="nav-item dropdown">
                 <a href="{{ url('products') }}">
                     <span class="icon-holder">
                         <i class="anticon anticon-dashboard"></i>
                     </span>
                     <span class="title">Products</span>
                 </a>
             </li> --}}
         </ul>
     </div>
 </div>
 <!-- Side Nav END -->
