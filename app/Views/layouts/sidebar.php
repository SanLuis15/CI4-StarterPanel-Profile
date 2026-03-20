<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="<?= base_url() ?>" class="brand-link">
            <img src="<?= base_url('assets/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">CodeIgniter 4</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false" id="navigation">
                <?php $role = session('user')['role'] ?? ''; ?>
                
                <?php if ($role === 'admin'): ?>
                    <li class="nav-header">ADMIN PANEL</li>
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard') ?>" class="nav-link <?= ($segment == 'dashboard') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-speedometer"></i><p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('students') ?>" class="nav-link <?= ($segment == 'students') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-people"></i><p>Students CRUD</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('records') ?>" class="nav-link <?= ($segment == 'records') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-folder"></i><p>Records</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/roles') ?>" class="nav-link <?= ($segment == 'roles') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-shield-lock"></i><p>Role Management</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/users') ?>" class="nav-link <?= ($segment == 'users') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-person-gear"></i><p>User Assignment</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('profile') ?>" class="nav-link <?= ($segment == 'profile') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-person"></i><p>My Profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('settings') ?>" class="nav-link <?= ($segment == 'settings') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-gear"></i><p>Settings</p>
                        </a>
                    </li>
                    
                <?php elseif ($role === 'teacher'): ?>
                    <li class="nav-header">TEACHER PANEL</li>
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard') ?>" class="nav-link <?= ($segment == 'dashboard') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-speedometer"></i><p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('students') ?>" class="nav-link <?= ($segment == 'students') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-people"></i><p>Students List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('records') ?>" class="nav-link <?= ($segment == 'records') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-folder"></i><p>Records</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('profile') ?>" class="nav-link <?= ($segment == 'profile') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-person"></i><p>My Profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('settings') ?>" class="nav-link <?= ($segment == 'settings') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-gear"></i><p>Settings</p>
                        </a>
                    </li>
                    
                <?php elseif ($role === 'coordinator'): ?>
                    <li class="nav-header">COORDINATOR PANEL</li>
                    <li class="nav-item">
                        <a href="<?= base_url('records') ?>" class="nav-link <?= ($segment == 'records') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-folder"></i><p>Records Management</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('profile') ?>" class="nav-link <?= ($segment == 'profile') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-person"></i><p>My Profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('settings') ?>" class="nav-link <?= ($segment == 'settings') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-gear"></i><p>Settings</p>
                        </a>
                    </li>
                    
                <?php else: ?>
                    <li class="nav-header">STUDENT PANEL</li>
                    <li class="nav-item">
                        <a href="<?= base_url('student/dashboard') ?>" class="nav-link <?= ($segment == 'dashboard') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-speedometer"></i><p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('profile') ?>" class="nav-link <?= ($segment == 'profile') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-person"></i><p>My Profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('records') ?>" class="nav-link <?= ($segment == 'records') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-folder"></i><p>Records View</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('settings') ?>" class="nav-link <?= ($segment == 'settings') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-gear"></i><p>Settings</p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</aside>