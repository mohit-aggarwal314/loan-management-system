<?php $this->load->view('layout/header'); ?>

<h2 class="text-center mb-4">Register</h2>

<?= validation_errors('<div class="alert alert-warning">', '</div>'); ?>

<form method="post" class="mx-auto" style="max-width:400px;">
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success w-100">Register</button>
</form>
<p class="text-center mt-3">
    Already have an account? <a href="<?= base_url('auth/login') ?>">Login</a>
</p>


<?php $this->load->view('layout/footer'); ?>

