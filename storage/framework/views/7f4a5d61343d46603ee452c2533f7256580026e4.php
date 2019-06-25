<div class="logo-container">
    <a href="<?php echo e(route('home')); ?>" class="logo">
        <img src="<?php echo e(asset('img/logo.png')); ?>" width="75" height="35" alt="Porto Admin" />
    </a>
    <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
        <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
    </div>
</div>

<!-- start: search & user box -->
<div class="header-right">
    <ul class="notifications">

        <li>
            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                <i class="fas fa-bell"></i>
                <span class="badge">3</span>
            </a>

            <div class="dropdown-menu notification-menu">
                <div class="notification-title">
                    <span class="float-right badge badge-default">3</span>
                    Alerts
                </div>

                <div class="content">
                    <ul>
                        <li>
                            <a href="#" class="clearfix">
                                <div class="image">
                                    <i class="fas fa-thumbs-down bg-danger text-light"></i>
                                </div>
                                <span class="title">Server is Down!</span>
                                <span class="message">Just now</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="clearfix">
                                <div class="image">
                                    <i class="fas fa-lock bg-warning text-light"></i>
                                </div>
                                <span class="title">User Locked</span>
                                <span class="message">15 minutes ago</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="clearfix">
                                <div class="image">
                                    <i class="fas fa-signal bg-success text-light"></i>
                                </div>
                                <span class="title">Connection Restaured</span>
                                <span class="message">10/10/2017</span>
                            </a>
                        </li>
                    </ul>

                    <hr />

                    <div class="text-right">
                        <a href="#" class="view-more">View All</a>
                    </div>
                </div>
            </div>
        </li>
    </ul>

    <span class="separator"></span>

    <div id="userbox" class="userbox">
        <a href="#" data-toggle="dropdown">
            <figure class="profile-picture">
                    <img src="<?php echo e(asset("storage/usersdata/img/users/".Auth::user()->path)); ?>" alt="<?php echo e(Auth::user()->name); ?>" class="rounded-circle" data-lock-picture="<?php echo e(asset('img/!logged-user.jpg')); ?>" />
            </figure>
            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                <span class="name"><?php echo e(Auth::user()->full_name); ?></span>
                <span class="role"><?php echo e(Auth::user()->type_user); ?></span>
            </div>
            <i class="fa custom-caret"></i>
        </a>

        <div class="dropdown-menu">
            <ul class="list-unstyled mb-2">
                <li class="divider"></li>
                <li>
                    <a role="menuitem" tabindex="-1" href="<?php echo e(route('user.show',Auth::user())); ?>"><i class="fas fa-user"></i> Perfil</a>
                </li>
                <li>
                    <a role="menuitem" tabindex="-1" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();"><i class="fas fa-power-off" ></i> Salir</a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
