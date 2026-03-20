<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-6">
            <h3>Create Role</h3>
        </div>
        <div class="col-6 text-end">
            <a href="<?= base_url('admin/roles') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back to List</a>
        </div>
    </div>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('admin/roles/store') ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name (Slug)</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= old('name') ?>" required pattern="[a-z_]+" placeholder="e.g. guest_user (lowercase and underscore only)">
                </div>
                <div class="mb-3">
                    <label for="label" class="form-label">Label</label>
                    <input type="text" name="label" id="label" class="form-control" value="<?= old('label') ?>" required placeholder="e.g. Guest User">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3"><?= old('description') ?></textarea>
                </div>
                <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Save</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
