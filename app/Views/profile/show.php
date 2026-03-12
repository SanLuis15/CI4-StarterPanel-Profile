<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">My Profile</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <?php if (!empty($user['profile_image'])): ?>
                            <img src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>" 
                                 class="rounded-circle mb-3" 
                                 style="width: 150px; height: 150px; object-fit: cover;" 
                                 alt="Profile Image">
                        <?php else: ?>
                            <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 150px; height: 150px;">
                                <i class="bi bi-person-fill" style="font-size: 80px; color: white;"></i>
                            </div>
                        <?php endif; ?>
                        <h4><?= esc($user['fullname']) ?></h4>
                        <p class="text-muted"><?= esc($user['username']) ?></p>
                        <a href="<?= base_url('profile/edit') ?>" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Profile Information</h3>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Full Name:</dt>
                            <dd class="col-sm-8"><?= esc($user['fullname']) ?></dd>

                            <dt class="col-sm-4">Username:</dt>
                            <dd class="col-sm-8"><?= esc($user['username']) ?></dd>

                            <dt class="col-sm-4">Student ID:</dt>
                            <dd class="col-sm-8"><?= !empty($user['student_id']) ? esc($user['student_id']) : '<span class="text-muted">Not set</span>' ?></dd>

                            <dt class="col-sm-4">Course:</dt>
                            <dd class="col-sm-8"><?= !empty($user['course']) ? esc($user['course']) : '<span class="text-muted">Not set</span>' ?></dd>

                            <dt class="col-sm-4">Year Level:</dt>
                            <dd class="col-sm-8"><?= !empty($user['year_level']) ? ($user['year_level'] . ' Year') : '<span class="text-muted">Not set</span>' ?></dd>

                            <dt class="col-sm-4">Section:</dt>
                            <dd class="col-sm-8"><?= !empty($user['section']) ? esc($user['section']) : '<span class="text-muted">Not set</span>' ?></dd>

                            <dt class="col-sm-4">Phone:</dt>
                            <dd class="col-sm-8"><?= !empty($user['phone']) ? esc($user['phone']) : '<span class="text-muted">Not set</span>' ?></dd>

                            <dt class="col-sm-4">Address:</dt>
                            <dd class="col-sm-8"><?= !empty($user['address']) ? esc($user['address']) : '<span class="text-muted">Not set</span>' ?></dd>

                            <dt class="col-sm-4">Account Created:</dt>
                            <dd class="col-sm-8"><?= date('F d, Y', strtotime($user['created_at'])) ?></dd>

                            <dt class="col-sm-4">Last Updated:</dt>
                            <dd class="col-sm-8"><?= date('F d, Y', strtotime($user['updated_at'])) ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
