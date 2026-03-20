<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">System Settings</h2>
            
            <div class="card card-outline card-primary shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">General Notification Preferences</h3>
                </div>
                <div class="card-body">
                    <?php if ($canEdit): ?>
                        <p class="text-success small">You have administrator permissions to modify system settings.</p>
                    <?php else: ?>
                        <p class="text-muted">You are viewing the settings page in read-only mode according to your role permissions.</p>
                    <?php endif; ?>
                    <hr>
                    <div class="form-group mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="emailNotifs" <?= $canEdit ? 'checked' : 'checked disabled' ?>>
                            <label class="form-check-label" for="emailNotifs">Receive Email Notifications</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="smsNotifs" <?= $canEdit ? '' : 'disabled' ?>>
                            <label class="form-check-label" for="smsNotifs">Receive SMS Alerts</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="updates" <?= $canEdit ? 'checked' : 'checked disabled' ?>>
                            <label class="form-check-label" for="updates">System Update Announcements</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary <?= $canEdit ? '' : 'disabled' ?>" <?= $canEdit ? '' : 'disabled' ?>>Save Changes</button>
                    <?php if (!$canEdit): ?>
                    <br>
                    <small class="text-muted">Your role level does not permit modifying systemic settings.</small>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
