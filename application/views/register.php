<div class="col-md-4 offset-md-4">     
    <h2>Register</h2><br>
    <?php echo validation_errors(); ?>
    <?php echo form_open("user/register");

    ?>
      <div class="form-group">
        <label>Enter Your Name</label>
        <input type="text" class="form-control" name="user_name"  placeholder="Enter Your UserId">
      </div>
      <div class="form-group">
        <label>Enter Your Email</label>
        <input type="email" class="form-control" name="email"  placeholder="Enter Your Email">
      </div>
      <div class="form-group">
        <label>Enter Your Password </label>
        <input type="password" class="form-control" name="password"  placeholder="Enter Password">
      </div>
      <div class="form-group">
            <label>Re-enter Password </label>
            <input type="password" class="form-control" name="confirm_password"  placeholder="Re-Enter Your Password">
      </div>
      <?php echo $image ; ?>
      <div class="form-group">
            <label>Solve Captcha </label>
            <input type="text" class="form-control" name="captcha" >
      </div>
       <button type="submit" class="btn btn-primary">Submit</button>
      <?php echo form_close();?>
</div>
