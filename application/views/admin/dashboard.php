<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Dashboard</h2>
        <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger">Logout</a>
    </div>

    <h5 class="mb-3">Filter by Status:</h5>
    <div class="mb-4">
        <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-outline-secondary btn-sm">All</a>
        <a href="<?= base_url('admin/dashboard?status=pending') ?>" class="btn btn-outline-warning btn-sm">Pending</a>
        <a href="<?= base_url('admin/dashboard?status=approved') ?>" class="btn btn-outline-success btn-sm">Approved</a>
        <a href="<?= base_url('admin/dashboard?status=rejected') ?>" class="btn btn-outline-danger btn-sm">Rejected</a>
        
    </div>

    <h4>Loan Applications</h4>
    <?php if (!empty($loans)): ?>
    <div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Customer</th>
                <th>Email</th>
                <th>Amount</th>
                <th>Tenure</th>
                <th>Purpose</th>
                <th>Status</th>
                <th>Action</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($loans as $loan): ?>
            <tr>
                <td><?= $loan->name ?></td>
                <td><?= $loan->email ?></td>
                <td>₹<?= $loan->amount ?></td>
                <td><?= $loan->tenure ?> months</td>
                <td><?= $loan->purpose ?></td>
                <td>
                    <span class="badge 
                        <?= $loan->status == 'approved' ? 'bg-success' : 
                            ($loan->status == 'rejected' ? 'bg-danger' : 'bg-warning text-dark') ?>">
                        <?= ucfirst($loan->status) ?>
                    </span>
                </td>
                <td>
                    <?php if ($loan->status == 'pending'): ?>
                        <a href="<?= base_url('admin/update_status/'.$loan->id.'/approved') ?>" class="btn btn-success btn-sm">Approve</a>
                        <a href="<?= base_url('admin/update_status/'.$loan->id.'/rejected') ?>" class="btn btn-danger btn-sm">Reject</a>
                    <?php else: ?>
                        <span class="text-muted">No Action</span>
                    <?php endif; ?>
                </td>
                <td><a href="<?= base_url('admin/loan_detail/'.$loan->id) ?>" class="btn btn-info btn-sm">View</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php else: ?>
        <div class="alert alert-info">No loan applications available.</div>
    <?php endif; ?>

</div>
</body>
</html>
