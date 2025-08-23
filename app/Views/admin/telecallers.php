
<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2><i class="fas fa-users"></i> Manage Telecallers</h2>
            <a href="/admin/add-telecaller" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Add Telecaller
            </a>
        </div>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($telecallers)): ?>
                                <?php foreach ($telecallers as $telecaller): ?>
                                <tr>
                                    <td><?= $telecaller['id'] ?></td>
                                    <td><?= $telecaller['name'] ?></td>
                                    <td><?= $telecaller['email'] ?></td>
                                    <td><?= $telecaller['phone'] ?></td>
                                    <td><?= $telecaller['username'] ?></td>
                                    <td>
                                        <span class="badge bg-<?= $telecaller['status'] == 'active' ? 'success' : 'danger' ?>">
                                            <?= ucfirst($telecaller['status']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('M d, Y', strtotime($telecaller['created_at'])) ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-info" onclick="viewTelecaller(<?= $telecaller['id'] ?>)">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">No telecallers found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function viewTelecaller(id) {
    // Add view telecaller functionality later
    alert('View telecaller functionality will be added');
}
</script>
<?= $this->endSection() ?>
