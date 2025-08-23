
<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2><i class="fas fa-upload"></i> Upload Numbers</h2>
            <a href="/admin/numbers" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Numbers
            </a>
        </div>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-file-csv"></i> CSV Upload</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h6><i class="fas fa-info-circle"></i> CSV Format Instructions:</h6>
                    <ul class="mb-0">
                        <li>First column: Name</li>
                        <li>Second column: Phone Number</li>
                        <li>No header row required</li>
                        <li>Example: John Doe,1234567890</li>
                    </ul>
                </div>

                <form method="POST" action="/admin/upload-numbers" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="company_id" class="form-label">Select Company</label>
                        <select class="form-select" id="company_id" name="company_id" required>
                            <option value="">Choose Company</option>
                            <?php foreach ($companies as $company): ?>
                                <option value="<?= $company['id'] ?>"><?= $company['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="csv_file" class="form-label">CSV File</label>
                        <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv" required>
                        <div class="form-text">Only CSV files are allowed.</div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Upload Numbers
                        </button>
                        <a href="/admin/numbers" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6><i class="fas fa-download"></i> Sample CSV</h6>
            </div>
            <div class="card-body">
                <p>Download a sample CSV file to see the correct format:</p>
                <div class="bg-light p-3 rounded">
                    <pre class="mb-0">John Doe,1234567890
Jane Smith,0987654321
Mike Johnson,5555555555</pre>
                </div>
                <button class="btn btn-outline-primary btn-sm mt-2" onclick="downloadSample()">
                    <i class="fas fa-download"></i> Download Sample
                </button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function downloadSample() {
    const csvContent = "data:text/csv;charset=utf-8,John Doe,1234567890\nJane Smith,0987654321\nMike Johnson,5555555555";
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "sample_numbers.csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>
<?= $this->endSection() ?>
