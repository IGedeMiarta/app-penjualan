 <!-- Side Nav START -->
 <div class="side-nav">
     <div class="side-nav-inner">
         <ul class="side-nav-menu scrollable">
             <li class="nav-item dropdown {{ request()->is('admin/dashboard') ? 'active' : '' }}"">
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
                     <li class="{{ request()->is('admin/categories') ? 'active' : '' }}">
                         <a href="{{ url('admin/categories') }}">Categories</a>
                     </li>
                     <li class="{{ request()->is('admin/brand') ? 'active' : '' }}">
                         <a href="{{ url('admin/brand') }}">Brand</a>
                     </li>
                     <li class="{{ request()->is('admin/products') ? 'active' : '' }}">
                         <a href="{{ url('admin/products') }}">Products</a>
                     </li>
                     <li class="{{ request()->is('admin/special-products') ? 'active' : '' }}">
                         <a href="{{ url('admin/special-products') }}">Discount Product</a>
                     </li>
                 </ul>
             </li>
             <li class="nav-item dropdown">
                 <a class="dropdown-toggle" href="javascript:void(0);">
                     <span class="icon-holder">
                         <i class="anticon anticon-dashboard"></i>
                     </span>
                     <span class="title">Transaction</span>
                     <span class="arrow">
                         <i class="arrow-icon"></i>
                     </span>
                 </a>
                 <ul class="dropdown-menu">
                     <li class="{{ request()->is('admin/categories') ? 'active' : '' }}">
                         <a href="{{ url('admin/categories') }}">List</a>
                     </li>
                 </ul>
             </li>
             <li class="nav-item dropdown">
                 <a class="dropdown-toggle" href="javascript:void(0);">
                     <span class="icon-holder">
                         <i class="anticon anticon-dashboard"></i>
                     </span>
                     <span class="title">Report</span>
                     <span class="arrow">
                         <i class="arrow-icon"></i>
                     </span>
                 </a>
                 <ul class="dropdown-menu">
                     <li class="{{ request()->is('admin/categories') ? 'active' : '' }}">
                         <a href="{{ url('admin/categories') }}">List</a>
                     </li>
                 </ul>
             </li>
         </ul>
     </div>
 </div>
 <!-- Side Nav END -->
