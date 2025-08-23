
<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2><i class="fas fa-phone-alt"></i> Manage Numbers</h2>
            <div>
                <a href="/admin/upload-numbers" class="btn btn-info">
                    <i class="fas fa-upload"></i> Upload Numbers
                </a>
                <a href="/admin/assign-numbers" class="btn btn-warning">
                    <i class="fas fa-user-tag"></i> Assign Numbers
                </a>
            </div>
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
                                <th>Phone</th>
                                <th>Company</th>
                                <th>Assigned To</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($numbers)): ?>
                                <?php foreach ($numbers as $number): ?>
                                <tr>
                                    <td><?= $number['id'] ?></td>
                                    <td><?= $number['name'] ?></td>
                                    <td><?= $number['phone'] ?></td>
                                    <td>
                                        <span class="badge bg-info"><?= $number['company_name'] ?? 'N/A' ?></span>
                                    </td>
                                    <td>
                                        <?php if ($number['telecaller_name']): ?>
                                            <span class="badge bg-success"><?= $number['telecaller_name'] ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Unassigned</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?= $number['status'] == 'assigned' ? 'success' : ($number['status'] == 'completed' ? 'primary' : 'warning') ?>">
                                            <?= ucfirst($number['status']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('M d, Y', strtotime($number['created_at'])) ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-info" onclick="viewNumber(<?= $number['id'] ?>)">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">No numbers found</td>
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
function viewNumber(id) {
    // Add view number functionality later
    alert('View number functionality will be added');
}
</script>
<?= $this->endSection() ?>
