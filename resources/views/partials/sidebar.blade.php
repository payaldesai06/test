@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">            
            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/admin/home') }}">
                    <i class="fa fa-home"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>
            <li class="{{ $request->segment(1) == 'category' ? 'active' : '' }}">
                <a href="{{ route('admin.category.index') }}">
                    <i class="fa fa-list-alt"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="{{ $request->segment(1) == 'product' ? 'active' : '' }}">
                <a href="{{ route('admin.product.index') }}">
                    <i class="fa fa-product-hunt"></i>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

