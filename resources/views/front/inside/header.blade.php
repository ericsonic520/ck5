<nav id="navbar" class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/"><b>{{ $site_name }}</b><br><b>{{ $site_name_en }}</b></a>
    </div>
    
    <div class="navBar">
      
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
            
          @guest
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}"><i class="nav-icon fas fa-sign-in-alt"></i>{{ __('登入') }}</a>
              </li>
              @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}"><i class="nav-icon fas fa-user-plus"></i>{{ __('註冊') }}</a>
                  </li>
              @endif
          @else
              <li class="nav-item">
                  <a class="nav-link" href="/home"><i class="nav-icon fas fa-sign-in-alt"></i>{{ __('後台') }}</a>
              </li>
              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} 
                  @if(Auth::user()->type=='A')
                    (Admin)
                  @else(Auth::user()->type=='G')
                    (一般使用者)
                  @endif
                  <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                          <div style="padding-left: 20px;">{{('登出') }}</div>
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
          @endguest
          <!--<li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">MORE
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Merchandise</a></li>
              <li><a href="#">Extras</a></li>
              <li><a href="#">Media</a></li> 
            </ul>
          </li>
          <li><a href="#"><span class="glyphicon glyphicon-search"></span></a></li>-->
        </ul>
      </div>
      
    </div>
  </div>
</nav>