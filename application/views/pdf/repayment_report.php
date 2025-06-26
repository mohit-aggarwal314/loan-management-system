<h3>Repayment Report - Loan #<?= $loan->id ?></h3>
<p>Loan Amount: ₹<?= $loan->amount ?></p>
<p>Status: <?= ucfirst($loan->status) ?></p>

<h4>Repayments:</h4>
<table border="1" cellpadding="5">
    <tr><th>Amount</th><th>Paid At</th></tr>
    <?php foreach ($repayments as $r): ?>
        <tr><td>₹<?= $r->amount ?></td><td><?= $r->paid_at ?></td></tr>
    <?php endforeach; ?>
</table>
