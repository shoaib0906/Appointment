@inject('request', 'Illuminate\Http\Request')
<div class="page-header-inner">
    <div class="page-header-inner">
        <div class="navbar-header">
            <a href="{{ url('/') }}"
               class="navbar-brand">
                @lang('quickadmin.quickadmin_title')
            </a>
        </div>
        <a href="javascript:;"
           class="menu-toggler responsive-toggler"
           data-toggle="collapse"
           data-target=".navbar-collapse">
        </a>

        <div class="top-menu">
            <ul class="nav navbar-nav">
              
              <li class="dropdown">
                
                <ul class="dropdown-menu">

                   <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                      <a href="{{ route('auth.change_password') }}">
                          <i class="fa fa-key"></i>
                          <span class="title">Change password</span>
                      </a>
                  </li>
                  <li>
                      <a href="#logout" onclick="$('#logout').submit();">
                          <i class="fa fa-arrow-left"></i>
                          <span class="title">@lang('quickadmin.qa_logout')</span>
                      </a>
                  </li>
                  
                </ul>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{strtoupper(Auth::user()->name)}} 
                  &nbsp;&nbsp;&nbsp;&nbsp;
                <span class="caret"></span></a>
              </li>             
            </ul>                  
      </div>
    </div>
</div>

