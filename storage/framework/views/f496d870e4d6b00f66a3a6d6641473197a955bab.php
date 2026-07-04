<nav id="navbar" class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/"><b><?php echo e($site_name); ?></b><br><b><?php echo e($site_name_en); ?></b></a>
    </div>
    
    <div class="navBar">
      
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
            
          <?php if(auth()->guard()->guest()): ?>
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo e(route('login')); ?>"><i class="nav-icon fas fa-sign-in-alt"></i><?php echo e(__('登入')); ?></a>
              </li>
              <?php if(Route::has('register')): ?>
                  <li class="nav-item">
                      <a class="nav-link" href="<?php echo e(route('register')); ?>"><i class="nav-icon fas fa-user-plus"></i><?php echo e(__('註冊')); ?></a>
                  </li>
              <?php endif; ?>
          <?php else: ?>
              <li class="nav-item">
                  <a class="nav-link" href="/home"><i class="nav-icon fas fa-sign-in-alt"></i><?php echo e(__('後台')); ?></a>
              </li>
              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  <?php echo e(Auth::user()->name); ?> 
                  <?php if(Auth::user()->type=='A'): ?>
                    (Admin)
                  <?php else: ?>
                    (一般使用者)
                  <?php endif; ?>
                  <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                          <div style="padding-left: 20px;"><?php echo e(('登出')); ?></div>
                      </a>

                      <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                          <?php echo csrf_field(); ?>
                      </form>
                  </div>
              </li>
          <?php endif; ?>
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
</nav><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/front/inside/header.blade.php ENDPATH**/ ?>