<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <h2 class="m-0">Edit Student</h2>
        </div>
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Student Information</h3>
                </div>
                <div class="card-body">
                    <form action="/students/update/<?= $student['id'] ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" value="<?= old('name', $student['name']) ?>" required>
                            <?php if(session('errors.name')): ?>
                                <div class="text-danger"><?= session('errors.name') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" value="<?= old('email', $student['email']) ?>" required>
                            <?php if(session('errors.email')): ?>
                                <div class="text-danger"><?= session('errors.email') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course</label>
                            <input type="text" name="course" class="form-control" value="<?= old('course', $student['course']) ?>" required>
                            <?php if(session('errors.course')): ?>
                                <div class="text-danger"><?= session('errors.course') ?></div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Student</button>
                        <a href="/students" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
