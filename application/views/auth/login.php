<?php $this->load->view('layout/header'); ?>

<h2 class="text-center mb-4">Login</h2>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
<?php endif; ?>

<form method="post" class="mx-auto" style="max-width:400px;">
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
</form>
<p class="text-center mt-3">
    Don't have an account? <a href="<?= base_url('index.php/auth/register') ?>">Register here</a>
</p>


<?php $this->load->view('layout/footer'); ?>
