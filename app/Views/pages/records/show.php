<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <h2 class="m-0">Record Details</h2>
        </div>
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= esc($record['title']) ?></h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">ID:</dt>
                        <dd class="col-sm-9"><?= esc($record['id']) ?></dd>

                        <dt class="col-sm-3">Title:</dt>
                        <dd class="col-sm-9"><?= esc($record['title']) ?></dd>

                        <dt class="col-sm-3">Description:</dt>
                        <dd class="col-sm-9"><?= esc($record['description']) ?></dd>

                        <dt class="col-sm-3">Category:</dt>
                        <dd class="col-sm-9"><?= esc($record['category']) ?></dd>

                        <dt class="col-sm-3">Status:</dt>
                        <dd class="col-sm-9">
                            <?php if($record['status'] == 'active'): ?>
                                <span class="badge bg-success">Active</span>
                            <?php elseif($record['status'] == 'inactive'): ?>
                                <span class="badge bg-secondary">Inactive</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Pending</span>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-sm-3">Created At:</dt>
                        <dd class="col-sm-9"><?= date('F d, Y h:i A', strtotime($record['created_at'])) ?></dd>

                        <dt class="col-sm-3">Updated At:</dt>
                        <dd class="col-sm-9"><?= date('F d, Y h:i A', strtotime($record['updated_at'])) ?></dd>
                    </dl>
                    <a href="/records/edit/<?= $record['id'] ?>" class="btn btn-warning">Edit</a>
                    <a href="/records" class="btn btn-secondary">Back to List</a>
                    <form action="/records/delete/<?= $record['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this record?')">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
