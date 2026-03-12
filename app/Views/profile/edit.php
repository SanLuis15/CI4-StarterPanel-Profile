<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Profile</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update Your Information</h3>
                    </div>
                    <form action="<?= base_url('/profile/update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <div class="mb-3">
                                        <?php if (!empty($user['profile_image'])): ?>
                                            <img id="preview" src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>" 
                                                 class="rounded-circle mb-3" 
                                                 style="width: 200px; height: 200px; object-fit: cover;" 
                                                 alt="Profile Preview">
                                        <?php else: ?>
                                            <img id="preview" src="<?= base_url('assets/images/avatar4.png') ?>" 
                                                 class="rounded-circle mb-3" 
                                                 style="width: 200px; height: 200px; object-fit: cover;" 
                                                 alt="Profile Preview">
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="profile_image" class="form-label">Profile Image</label>
                                        <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                                        <small class="text-muted">Max size: 2MB (JPG, PNG, WEBP)</small>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="fullname" class="form-label">Full Name *</label>
                                            <input type="text" class="form-control <?= isset(session('errors')['fullname']) ? 'is-invalid' : '' ?>" 
                                                   id="fullname" name="fullname" 
                                                   value="<?= old('fullname', esc($user['fullname'])) ?>" required>
                                            <?php if (isset(session('errors')['fullname'])): ?>
                                                <div class="invalid-feedback"><?= session('errors')['fullname'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="username" class="form-label">Username *</label>
                                            <input type="text" class="form-control <?= isset(session('errors')['username']) ? 'is-invalid' : '' ?>" 
                                                   id="username" name="username" 
                                                   value="<?= old('username', esc($user['username'])) ?>" required>
                                            <?php if (isset(session('errors')['username'])): ?>
                                                <div class="invalid-feedback"><?= session('errors')['username'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="student_id" class="form-label">Student ID</label>
                                            <input type="text" class="form-control <?= isset(session('errors')['student_id']) ? 'is-invalid' : '' ?>" 
                                                   id="student_id" name="student_id" 
                                                   value="<?= old('student_id', esc($user['student_id'] ?? '')) ?>" 
                                                   placeholder="e.g. 2021-00123">
                                            <?php if (isset(session('errors')['student_id'])): ?>
                                                <div class="invalid-feedback"><?= session('errors')['student_id'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="course" class="form-label">Course</label>
                                            <input type="text" class="form-control <?= isset(session('errors')['course']) ? 'is-invalid' : '' ?>" 
                                                   id="course" name="course" 
                                                   value="<?= old('course', esc($user['course'] ?? '')) ?>" 
                                                   placeholder="e.g. BSIT, BSCS">
                                            <?php if (isset(session('errors')['course'])): ?>
                                                <div class="invalid-feedback"><?= session('errors')['course'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="year_level" class="form-label">Year Level</label>
                                            <select class="form-select <?= isset(session('errors')['year_level']) ? 'is-invalid' : '' ?>" 
                                                    id="year_level" name="year_level">
                                                <option value="">Select Year Level</option>
                                                <option value="1" <?= old('year_level', $user['year_level'] ?? '') == '1' ? 'selected' : '' ?>>1st Year</option>
                                                <option value="2" <?= old('year_level', $user['year_level'] ?? '') == '2' ? 'selected' : '' ?>>2nd Year</option>
                                                <option value="3" <?= old('year_level', $user['year_level'] ?? '') == '3' ? 'selected' : '' ?>>3rd Year</option>
                                                <option value="4" <?= old('year_level', $user['year_level'] ?? '') == '4' ? 'selected' : '' ?>>4th Year</option>
                                                <option value="5" <?= old('year_level', $user['year_level'] ?? '') == '5' ? 'selected' : '' ?>>5th Year</option>
                                            </select>
                                            <?php if (isset(session('errors')['year_level'])): ?>
                                                <div class="invalid-feedback"><?= session('errors')['year_level'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="section" class="form-label">Section</label>
                                            <input type="text" class="form-control <?= isset(session('errors')['section']) ? 'is-invalid' : '' ?>" 
                                                   id="section" name="section" 
                                                   value="<?= old('section', esc($user['section'] ?? '')) ?>" 
                                                   placeholder="e.g. IT3A">
                                            <?php if (isset(session('errors')['section'])): ?>
                                                <div class="invalid-feedback"><?= session('errors')['section'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control <?= isset(session('errors')['phone']) ? 'is-invalid' : '' ?>" 
                                                   id="phone" name="phone" 
                                                   value="<?= old('phone', esc($user['phone'] ?? '')) ?>" 
                                                   placeholder="e.g. 09XX-XXX-XXXX">
                                            <?php if (isset(session('errors')['phone'])): ?>
                                                <div class="invalid-feedback"><?= session('errors')['phone'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control <?= isset(session('errors')['address']) ? 'is-invalid' : '' ?>" 
                                                      id="address" name="address" rows="3" 
                                                      placeholder="Enter your home address"><?= old('address', esc($user['address'] ?? '')) ?></textarea>
                                            <?php if (isset(session('errors')['address'])): ?>
                                                <div class="invalid-feedback"><?= session('errors')['address'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Update Profile
                            </button>
                            <a href="<?= base_url('/profile') ?>" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('profile_image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
<?= $this->endSection() ?>
