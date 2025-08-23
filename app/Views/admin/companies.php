
<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2><i class="fas fa-building"></i> Manage Companies</h2>
            <a href="/admin/add-company" class="btn btn-success">
                <i class="fas fa-plus"></i> Add Company
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
                                <th>Description</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($companies)): ?>
                                <?php foreach ($companies as $company): ?>
                                <tr>
                                    <td><?= $company['id'] ?></td>
                                    <td><?= $company['name'] ?></td>
                                    <td><?= substr($company['description'], 0, 50) ?>...</td>
                                    <td>
                                        <span class="badge bg-<?= $company['status'] == 'active' ? 'success' : 'danger' ?>">
                                            <?= ucfirst($company['status']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('M d, Y', strtotime($company['created_at'])) ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-info" onclick="viewCompany(<?= $company['id'] ?>)">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No companies found</td>
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
