<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>

            	<li class="text-muted menu-title">Navigation</li>

                @can('admin-access')
                  <li>
                    <a href="{{ route('home') }}" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span> </a>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-pencil-alt"></i><span> Products </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('item.index') }}"> Items</a></li>
                            <li><a href="{{ route('category.index') }}"> Categories</a></li>
                            <li><a href="{{ route('topping.index') }}"> Toppings</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('hot_offer.index') }}" class="waves-effect"><i class="ti-gallery"></i><span> Hot Offers </span></a></li>
                    {{-- <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-gallery"></i><span> Gallery </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('admin.gallery.index') }}"> All Galleries</a></li>
                        </ul>
                    </li> --}}
                  </li>
                @endcan


                <li class="text-muted menu-title">Extra</li>

                <li>
                    <li><a href="{{ route('logout') }}" class="waves-effect"
                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="ti-user"></i><span> Logout </span></a></li>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
