<!DOCTYPE html>
<html>
<head>
    <title>Apply for Loan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">

    <h2 class="mb-4">Apply for a Loan</h2>

    <?= validation_errors('<div class="alert alert-warning">', '</div>') ?>

    <form method="post" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label class="form-label">Loan Amount</label>
            <input type="number" name="amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tenure (in months)</label>
            <input type="number" name="tenure" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Purpose</label>
            <textarea name="purpose" class="form-control" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Submit Application</button>
    </form>

    <a href="<?= base_url('index.php/customer/dashboard') ?>" class="btn btn-link mt-3">← Back to Dashboard</a>

</div>
</body>
</html>
