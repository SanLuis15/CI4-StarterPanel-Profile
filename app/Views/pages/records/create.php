<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <h2 class="m-0">Create New Record</h2>
        </div>
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Record Information</h3>
                </div>
                <div class="card-body">
                    <form action="/records/store" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="<?= old('title') ?>" required>
                            <?php if(session('errors.title')): ?>
                                <div class="text-danger"><?= session('errors.title') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4" required><?= old('description') ?></textarea>
                            <?php if(session('errors.description')): ?>
                                <div class="text-danger"><?= session('errors.description') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-control" required>
                                <option value="">Select Category</option>
                                <option value="Technology" <?= old('category') == 'Technology' ? 'selected' : '' ?>>Technology</option>
                                <option value="Business" <?= old('category') == 'Business' ? 'selected' : '' ?>>Business</option>
                                <option value="Education" <?= old('category') == 'Education' ? 'selected' : '' ?>>Education</option>
                                <option value="Health" <?= old('category') == 'Health' ? 'selected' : '' ?>>Health</option>
                                <option value="Other" <?= old('category') == 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>
                            <?php if(session('errors.category')): ?>
                                <div class="text-danger"><?= session('errors.category') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                <option value="pending" <?= old('status') == 'pending' ? 'selected' : '' ?>>Pending</option>
                            </select>
                            <?php if(session('errors.status')): ?>
                                <div class="text-danger"><?= session('errors.status') ?></div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Record</button>
                        <a href="/records" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
