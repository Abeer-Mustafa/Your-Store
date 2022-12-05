<!-- ============================== -->
<!-- =========== Sidebar ========== -->
<!-- ============================== -->

<aside class="main-sidebar">
   <section class="sidebar">
      <div class="user-panel">
         <div class="pull-left image">
            @if(Auth::user()->image)
               <img src="{{ URL::to('/storage') }}/images/users/{{Auth::user()->image}}"  class="img-circle" alt="User Image" />
            @else
               <img src="{{ URL::to('/front') }}/image/catalog/default_user.png"  class="img-circle" alt="User Image" />
            @endif
         </div>
         <div class="pull-left info">

            <p>{{ Auth::user()->name }}</p>
            <a href="{{ route('dashboard') }}"><i class="fa fa-circle text-success"></i> {{ __('dashboard.Online') }}</a>
         </div>
      </div>

      <!-- sidebar menu -->
      <ul class="sidebar-menu" data-widget="tree">

         <li class="header">{{ __('dashboard.MAIN NAVIGATION') }}</li>
         
         <!-- Home -->
         <li>
            <a href="{{ route('dashboard') }}">
               <i class="fa fa-home text-green"></i> 
               <span>{{ __('dashboard.Home') }}</span>
            </a>
         </li>           

         <!-- Users -->
         <li>
            <a href="{{ route('users.index') }}">
               <i class="fa fa-users text-yellow"></i> 
               <span>{{ __('dashboard.Users') }}</span>
            </a>
         </li>         

         <!-- Categories -->
         <li>
            <a href="{{ route('cats.index') }}">
               <i class="fa fa-list text-maroon"></i> 
               <span>{{ __('dashboard.Categories') }}</span>
            </a>
         </li>

         <!-- Products -->
         <li>
            <a href="{{ route('products.index') }}">
               <i class="fa fa-product-hunt text-aqua"></i> 
               <span>{{ __('dashboard.Products') }}</span>
            </a>
         </li>

         <!-- Brands -->
         <li>
            <a href="{{ route('brands.index') }}">
               <i class="fa fa-bitcoin text-red"></i> 
               <span>{{ __('dashboard.Brands') }}</span>
            </a>
         </li>

         <!-- Orders -->
         <li>
            <a href="{{ route('orders') }}">
               <i class="fa fa-shopping-cart text-green"></i> 
               <span>{{ __('dashboard.Orders') }}</span>
            </a>
         </li>  

         <!-- Reviews -->
         <li>
            <a href="{{ route('reviews') }}">
               <i class="fa fa-star text-yellow"></i> 
               <span>{{ __('dashboard.Reviews') }}</span>
            </a>
         </li>

         <!-- Notifications -->
         <li>
            <a href="{{ route('notifications') }}">
               <i class="fa fa-envelope text-red"></i> 
               <span>{{ __('dashboard.Notifications') }}</span>
            </a>
         </li>
      </ul>
   </section>
</aside>