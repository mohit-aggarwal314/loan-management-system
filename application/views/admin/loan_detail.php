<!DOCTYPE html>
<html>
<head>
    <title>Loan Detail - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">

    <h2 class="mb-4">Loan #<?= $loan->id ?> for <?= $loan->name ?> (<?= $loan->email ?>)</h2>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Amount:</strong> ₹<?= $loan->amount ?></p>
            <p><strong>Status:</strong> 
                <span class="badge 
                    <?= $loan->status == 'approved' ? 'bg-success' : 
                        ($loan->status == 'rejected' ? 'bg-danger' : 'bg-warning text-dark') ?>">
                    <?= ucfirst($loan->status) ?>
                </span>
            </p>
            <p><strong>Total Repaid:</strong> ₹<?= $total_repaid ?></p>
            <p><strong>Balance:</strong> ₹<?= $balance ?></p>
        </div>
    </div>

    <h4>Repayment History</h4>
    <?php if ($repayments): ?>
    <table class="table table-bordered">
        <thead>
            <tr><th>Amount</th><th>Paid At</th></tr>
        </thead>
        <tbody>
            <?php foreach ($repayments as $r): ?>
            <tr><td>₹<?= $r->amount ?></td><td><?= $r->paid_at ?></td></tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <div class="alert alert-warning">No repayments found for this loan.</div>
    <?php endif; ?>

    <a href="<?= base_url('index.php/admin/dashboard') ?>" class="btn btn-link">← Back to Dashboard</a>

</div>
</body>
</html>
