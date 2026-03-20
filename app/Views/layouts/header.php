<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <?php $role = session('user')['role'] ?? ''; ?>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="bi bi-search"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <?php if (!empty(session()->get('profile_image'))): ?>
                        <img src="<?= base_url('uploads/profiles/' . session()->get('profile_image')) ?>" class="user-image rounded-circle shadow" alt="User Image" style="width: 25px; height: 25px; object-fit: cover;" />
                    <?php else: ?>
                        <img src="<?= base_url('assets/images/avatar4.png') ?>" class="user-image rounded-circle shadow" alt="User Image" />
                    <?php endif; ?>
                    <span class="d-none d-md-inline"><?= session()->get('fullname') ?? 'User' ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary">
                        <?php if (!empty(session()->get('profile_image'))): ?>
                            <img src="<?= base_url('uploads/profiles/' . session()->get('profile_image')) ?>" class="rounded-circle shadow" alt="User Image" style="width: 80px; height: 80px; object-fit: cover;" />
                        <?php else: ?>
                            <img src="<?= base_url('assets/images/avatar4.png') ?>" class="rounded-circle shadow" alt="User Image" />
                        <?php endif; ?>
                        <p><?= session()->get('fullname') ?? 'User' ?><small>Member since 2024</small></p>
                    </li>
                    <li class="user-body">
                        <div class="row">
                            <div class="col-4 text-center"><a href="#">Followers</a></div>
                            <div class="col-4 text-center"><a href="#">Sales</a></div>
                            <div class="col-4 text-center"><a href="#">Friends</a></div>
                        </div>
                    </li>
                    <li class="user-footer">
                        <a href="<?= base_url('/profile') ?>" class="btn btn-default btn-flat">Profile</a>
                        <a href="<?= base_url('logout') ?>" class="btn btn-default btn-flat float-end">Sign out</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>