<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>The HTML5 Herald</title>
        <meta name="description" content="The HTML5 Herald">
        <meta name="author" content="SitePoint">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    </head>
    <body>
                  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?php echo base_url();?>">LoginCI</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php  echo base_url();?>">Home </a>
      </li>
    </ul>
      <ul class="nav navbar-nav navbar-right">
       <?php if($this->session->userdata('logged_in')):?>
       <li class="nav-item">
        <a class="nav-link" href="<?php  echo base_url();?>user/logoff">Logoff</a>
      </li>
      <?php else :?>
        <li class="nav-item">
        <a class="nav-link" href="<?php  echo base_url();?>user/login">Login</a>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php  echo base_url();?>user/register">Register</a>
      </li>
      <?php endif;?>
    </ul>
  </div>
</nav>
        <div class ="container">
        <div class="row">
             <?php if($this->session->flashdata('active_fail')): ?>
            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('active_fail').'</p>'; ?>
            <?php endif; ?>
            <?php if($this->session->flashdata('active_success')): ?>
            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('active_success').'</p>'; ?>
            <?php endif; ?>
            <?php if($this->session->flashdata('login_failure')): ?>
            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failure').'</p>'; ?>
            <?php endif; ?>
            
       


