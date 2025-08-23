
<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h2><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h2>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Telecallers</h5>
                        <h2><?= $total_telecallers ?></h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="/admin/telecallers" class="text-white text-decoration-none">
                    <small>View Details <i class="fas fa-arrow-circle-right"></i></small>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Companies</h5>
                        <h2><?= $total_companies ?></h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-building fa-3x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="/admin/companies" class="text-white text-decoration-none">
                    <small>View Details <i class="fas fa-arrow-circle-right"></i></small>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Numbers</h5>
                        <h2><?= $total_numbers ?></h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-phone-alt fa-3x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="/admin/numbers" class="text-white text-decoration-none">
                    <small>View Details <i class="fas fa-arrow-circle-right"></i></small>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Assigned Numbers</h5>
                        <h2><?= $assigned_numbers ?></h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-user-tag fa-3x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="/admin/assign-numbers" class="text-white text-decoration-none">
                    <small>Assign More <i class="fas fa-arrow-circle-right"></i></small>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-chart-bar"></i> Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <a href="/admin/add-telecaller" class="btn btn-primary btn-block w-100">
                            <i class="fas fa-user-plus"></i> Add Telecaller
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="/admin/add-company" class="btn btn-success btn-block w-100">
                            <i class="fas fa-building"></i> Add Company
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="/admin/upload-numbers" class="btn btn-info btn-block w-100">
                            <i class="fas fa-upload"></i> Upload Numbers
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="/admin/assign-numbers" class="btn btn-warning btn-block w-100">
                            <i class="fas fa-user-tag"></i> Assign Numbers
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
