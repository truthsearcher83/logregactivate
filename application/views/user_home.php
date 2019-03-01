
<?php if($this->session->flashdata('login_success')): ?>
    <?php echo '<p class="alert alert-success">'.$this->session->flashdata('login_success').'</p>'; ?>
    <?php endif; ?>

<p> You logged in </p>

