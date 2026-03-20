<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-6">
            <h3>Roles Management</h3>
        </div>
        <div class="col-6 text-end">
            <a href="<?= base_url('admin/roles/create') ?>" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Create Role</a>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name (Slug)</th>
                        <th>Label</th>
                        <th>Description</th>
                        <th>Users Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $role): ?>
                        <tr>
                            <td><?= esc($role['id']) ?></td>
                            <td><?= esc($role['name']) ?></td>
                            <td><?= esc($role['label']) ?></td>
                            <td><?= esc($role['description']) ?></td>
                            <td><span class="badge bg-secondary"><?= esc($role['user_count']) ?></span></td>
                            <td>
                                <a href="<?= base_url('admin/roles/edit/' . $role['id']) ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Edit</a>
                                <?php if ($role['name'] !== 'admin'): ?>
                                    <a href="<?= base_url('admin/roles/delete/' . $role['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this role?')"><i class="bi bi-trash"></i> Delete</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
