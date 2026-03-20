<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <h2 class="m-0">Records Management</h2>
            <?php if (session('user')['role'] === 'admin'): ?>
                <a href="/records/create" class="btn btn-primary mt-2">Add New Record</a>
            <?php endif; ?>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Records</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($records)): foreach($records as $record): ?>
                            <tr>
                                <td><?= esc($record['id']) ?></td>
                                <td><a href="/records/show/<?= $record['id'] ?>"><?= esc($record['title']) ?></a></td>
                                <td><?= esc($record['category']) ?></td>
                                <td>
                                    <?php if($record['status'] == 'active'): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php elseif($record['status'] == 'inactive'): ?>
                                        <span class="badge bg-secondary">Inactive</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('M d, Y', strtotime($record['created_at'])) ?></td>
                                <td>
                                    <a href="/records/show/<?= $record['id'] ?>" class="btn btn-sm btn-info">View</a>
                                    <?php if (in_array(session('user')['role'], ['admin', 'teacher', 'coordinator'])): ?>
                                        <a href="/records/edit/<?= $record['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <?php endif; ?>
                                    <?php if (session('user')['role'] === 'admin'): ?>
                                        <form action="/records/delete/<?= $record['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No records found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if(isset($pager)): ?>
                <div class="card-footer">
                    <?php // echo $pager->links(); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
