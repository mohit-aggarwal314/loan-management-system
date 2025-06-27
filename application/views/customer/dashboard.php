<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Welcome, <?= $this->session->userdata('user')->name ?></h2>
        <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger">Logout</a>
    </div>

    <div class="mb-3">
        <a href="<?= base_url('customer/apply_loan') ?>" class="btn btn-primary">Apply for a New Loan</a>
        <a href="<?= base_url('customer/repay') ?>" class="btn btn-secondary">Make Repayment</a>
    </div>

    <h4>Your Loan Applications</h4>
    <?php if (isset($loans) && count($loans) > 0): ?>
        <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Amount</th>
                    <th>Tenure</th>
                    <th>Purpose</th>
                    <th>Status</th>
                    <th>Applied On</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($loans as $loan): ?>
                <tr>
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
                    <td><?= $loan->created_at ?></td>
                    <td><a href="<?= base_url('customer/loan_detail/'.$loan->id) ?>" class="btn btn-sm btn-info">View</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">No loan applications found.</div>
    <?php endif; ?>

</div>
</body>
</html>
