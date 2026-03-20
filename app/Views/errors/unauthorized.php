<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card text-center shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h3 class="card-title m-0"><i class="fas fa-exclamation-triangle"></i> Access Denied</h3>
                </div>
                <div class="card-body py-5">
                    <h1 class="display-3 text-danger"><i class="fas fa-lock"></i> 403</h1>
                    <h4 class="mt-4">Unauthorized Access</h4>
                    <p class="lead">
                        You do not have permission to view this page.
                        <br>
                        Your current role is: <strong><?= session('user')['role'] ?? 'guest' ?></strong>
                    </p>
                    
                    <?php 
                        $role = session('user')['role'] ?? '';
                        $dashLink = '/';
                        if ($role === 'student') $dashLink = '/student/dashboard';
                        if ($role === 'teacher' || $role === 'admin') $dashLink = '/dashboard';
                    ?>
                    <a href="<?= base_url($dashLink) ?>" class="btn btn-primary mt-3">
                        <i class="fas fa-arrow-left"></i> Return to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
