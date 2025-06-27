<!DOCTYPE html>
<html>
<head>
    <title>Repayment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">

    <h2 class="mb-4">Make a Repayment</h2>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <?= validation_errors('<div class="alert alert-warning">', '</div>') ?>

    <form method="post" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label class="form-label">Select Loan</label>
            <select name="loan_id" class="form-select" required>
                <option value="">-- Choose --</option>
                <?php foreach ($loans as $loan): ?>
                    <option value="<?= $loan->id ?>">
                        #<?= $loan->id ?> - ₹<?= $loan->amount ?> (<?= $loan->tenure ?> months)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Repayment Amount</label>
            <input type="number" name="amount" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Submit Repayment</button>
    </form>

    <a href="<?= base_url('customer/dashboard') ?>" class="btn btn-link mt-3">← Back to Dashboard</a>

</div>
</body>
</html>
