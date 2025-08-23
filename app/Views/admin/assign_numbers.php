
<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2><i class="fas fa-user-tag"></i> Assign Numbers</h2>
            <a href="/admin/numbers" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Numbers
            </a>
        </div>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-cogs"></i> Assignment Settings</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/assign-numbers" id="assignForm">
                    <div class="mb-3">
                        <label for="telecaller_id" class="form-label">Select Telecaller</label>
                        <select class="form-select" id="telecaller_id" name="telecaller_id" required>
                            <option value="">Choose Telecaller</option>
                            <?php foreach ($telecallers as $telecaller): ?>
                                <option value="<?= $telecaller['id'] ?>"><?= $telecaller['name'] ?> (<?= $telecaller['username'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="company_id" class="form-label">Filter by Company</label>
                        <select class="form-select" id="company_id" name="company_id" required onchange="filterNumbers()">
                            <option value="">Choose Company</option>
                            <?php foreach ($companies as $company): ?>
                                <option value="<?= $company['id'] ?>"><?= $company['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Selected Numbers: <span id="selectedCount">0</span></label>
                        <div class="form-text">Select numbers from the list on the right</div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-user-tag"></i> Assign Selected Numbers
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-list"></i> Unassigned Numbers</h5>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="selectAll" onchange="toggleAll()">
                    <label class="form-check-label" for="selectAll">
                        Select All
                    </label>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-sm">
                        <thead class="sticky-top bg-light">
                            <tr>
                                <th width="50">Select</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Company</th>
                            </tr>
                        </thead>
                        <tbody id="numbersTable">
                            <?php if (!empty($unassigned_numbers)): ?>
                                <?php foreach ($unassigned_numbers as $number): ?>
                                <tr data-company="<?= $number['company_id'] ?>">
                                    <td>
                                        <input type="checkbox" class="form-check-input number-checkbox" 
                                               name="number_ids[]" value="<?= $number['id'] ?>" 
                                               onchange="updateCount()">
                                    </td>
                                    <td><?= $number['name'] ?></td>
                                    <td><?= $number['phone'] ?></td>
                                    <td>
                                        <span class="badge bg-info"><?= $number['company_name'] ?></span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No unassigned numbers found</td>
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
function filterNumbers() {
    const companyId = document.getElementById('company_id').value;
    const rows = document.querySelectorAll('#numbersTable tr[data-company]');
    
    rows.forEach(row => {
        if (!companyId || row.dataset.company === companyId) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
            // Uncheck hidden checkboxes
            const checkbox = row.querySelector('.number-checkbox');
            if (checkbox) checkbox.checked = false;
        }
    });
    
    updateCount();
    document.getElementById('selectAll').checked = false;
}

function toggleAll() {
    const selectAll = document.getElementById('selectAll');
    const visibleCheckboxes = document.querySelectorAll('#numbersTable tr:not([style*="display: none"]) .number-checkbox');
    
    visibleCheckboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    updateCount();
}

function updateCount() {
    const checkedBoxes = document.querySelectorAll('.number-checkbox:checked');
    document.getElementById('selectedCount').textContent = checkedBoxes.length;
}

// Form validation
document.getElementById('assignForm').addEventListener('submit', function(e) {
    const telecallerId = document.getElementById('telecaller_id').value;
    const companyId = document.getElementById('company_id').value;
    const checkedBoxes = document.querySelectorAll('.number-checkbox:checked');
    
    if (!telecallerId) {
        alert('Please select a telecaller');
        e.preventDefault();
        return;
    }
    
    if (!companyId) {
        alert('Please select a company');
        e.preventDefault();
        return;
    }
    
    if (checkedBoxes.length === 0) {
        alert('Please select at least one number to assign');
        e.preventDefault();
        return;
    }
    
    if (!confirm(`Are you sure you want to assign ${checkedBoxes.length} numbers?`)) {
        e.preventDefault();
    }
});
</script>
<?= $this->endSection() ?>
