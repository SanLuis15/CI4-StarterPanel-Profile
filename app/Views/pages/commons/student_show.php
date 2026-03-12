<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <h2 class="m-0">Student Details</h2>
        </div>
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">ID:</dt>
                        <dd class="col-sm-9"><?= esc($student['id']) ?></dd>

                        <dt class="col-sm-3">Name:</dt>
                        <dd class="col-sm-9"><?= esc($student['name']) ?></dd>

                        <dt class="col-sm-3">Email:</dt>
                        <dd class="col-sm-9"><?= esc($student['email']) ?></dd>

                        <dt class="col-sm-3">Course:</dt>
                        <dd class="col-sm-9"><?= esc($student['course']) ?></dd>

                        <dt class="col-sm-3">Created At:</dt>
                        <dd class="col-sm-9"><?= esc($student['created_at']) ?></dd>
                    </dl>
                    <a href="/students/edit/<?= $student['id'] ?>" class="btn btn-warning">Edit</a>
                    <a href="/students" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
