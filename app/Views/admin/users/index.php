<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
<div class="row mb-3">
        <div class="col-8">
            <h3>User Role Assignment</h3>
        </div>
        <div class="col-4 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="bi bi-person-plus"></i> Add User</button>
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
                        <th>Fullname</th>
                        <th>Email/Username</th>
                        <th>Current Role</th>
                        <th>Assign New Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td><?= esc($u['id']) ?></td>
                            <td><?= esc($u['fullname']) ?></td>
                            <td><?= esc($u['username']) ?></td>
                            <td>
                                <?php if ($u['role_name']): ?>
                                    <span class="badge bg-primary"><?= esc($u['role_label'] ?? $u['role_name']) ?></span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Unassigned</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <form action="<?= base_url('admin/users/assign-role/' . $u['id']) ?>" method="post" class="d-flex gap-2">
                                        <select name="role_id" class="form-select form-select-sm" style="width: auto;" <?= ($u['id'] == session('user')['id']) ? 'disabled' : '' ?>>
                                            <option value="">-- Select Role --</option>
                                            <?php foreach ($roles as $r): ?>
                                                <option value="<?= esc($r['id']) ?>" <?= ($u['role_id'] == $r['id']) ? 'selected' : '' ?>><?= esc($r['label']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-success" <?= ($u['id'] == session('user')['id']) ? 'disabled' : '' ?>>Assign</button>
                                    </form>
                                    <?php if ($u['id'] != session('user')['id']): ?>
                                        <form action="<?= base_url('admin/users/delete/' . $u['id']) ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                                <?php if ($u['id'] == session('user')['id']): ?>
                                    <small class="text-danger d-block mt-1">You cannot change your own role</small>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('admin/users/store') ?>" method="post">
      <div class="modal-header">
        <h5 class="modal-title">Create New User & Assign Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
              <label>Fullname</label>
              <input type="text" name="fullname" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Email Address</label>
              <input type="email" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Role</label>
              <select name="role_id" class="form-select" required>
                  <option value="">-- Select Role --</option>
                  <?php foreach ($roles as $r): ?>
                      <option value="<?= esc($r['id']) ?>"><?= esc($r['label']) ?></option>
                  <?php endforeach; ?>
              </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create User</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
