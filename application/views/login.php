<?php echo validation_errors();?>

<?php if($this->session->flashdata('login_failure')): ?>
    <?php echo '<p class="alert alert-success">'.$this->session->flashdata('login_failure').'</p>'; ?>
   <?php endif; ?>


    <div class='col-md-4 offset-md-4'>
        
        <?php echo form_open('user/login'); ?>
        <h2 class='text-center'><?php echo $title ;?></h2>
            <div class='form-group'>
                <label>Enter Your Email</label>
                <input type='text' name='email' class='form-control' placeholder='Enter Your  Email'>
            </div>
            <div class='form-group'>
                <label>Password</label>
                <input type='password' name='password' class='form-control'>
            </div>
            <?php echo $image ; ?>
            <div class="form-group">
                  <label>Solve Captcha </label>
                  <input type="text" class="form-control" name="captcha" >
            </div>
        <button type='submit' class='btn btn-primary btn-block'>Login</button>
        <?php echo form_close();?>
    </div>                     



