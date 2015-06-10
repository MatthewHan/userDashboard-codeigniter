<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Default</title>
    <link rel="stylesheet" href="assets/style.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Bootstrap specific javascript functions -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="/assets/css/signin.css" rel="stylesheet">
    <script type = "text/javascript">
    $(document).ready(function(){
        $(function() {
            $('#login-form-link').click(function(e) {
            $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
            });
            $('#register-form-link').click(function(e) {
            $("#register-form").delay(100).fadeIn(100);
            $("#login-form").fadeOut(100);
            $('#login-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
            });
        });
    })
    </script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="navbar-brand" href="#">Test App</span>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/dashboard">Dashboard</a>
                    </li>
                    <li>
                        <a href="/profile">Profile</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a>Hello <?= $this->session->userdata('name') ?></a>
                    </li>
                    <li>
                        <a href="/logout">Log Off</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Add User -->
    <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-12">
                    <a href="#" class = "active" id="register-form-link">Add New User</a>
                  </div>
                </div>
                <hr>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    <form id="register-form" action="/add" method="post" role="form" style="display: block">
                      <div class="form-group">
                        <input type="text" name="first_name" id="first_name" tabindex="1" class="form-control" placeholder="First Name" value="<?= set_value('first_name') ?>" >
                        <?php if(form_error('first_name')){?> 
                        <span class="help-block alert alert-danger"><?= form_error('first_name') ?></span> 
                        <?php
                        } ?>
                      </div>
                      <div class="form-group">
                        <input type="text" name="last_name" id="last_name" tabindex="1" class="form-control" placeholder="Last Name" value="<?= set_value('last_name') ?>" >
                        <?php if(form_error('last_name')){?> 
                        <span class="help-block alert alert-danger"><?= form_error('last_name') ?></span> 
                        <?php
                        } ?>
                      </div>
                      <div class="form-group">
                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="<?= set_value('email') ?>" >
                        <?php if(form_error('email')){?> 
                        <span class="help-block alert alert-danger"><?= form_error('email') ?></span> 
                        <?php
                        } ?>
                      </div>
                      <div class="form-group">
                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                        <?php if(form_error('password')){?> 
                        <span class="help-block alert alert-danger"><?= form_error('password') ?></span> 
                        <?php
                        } ?>
                      </div>
                      <div class="form-group">
                        <input type="password" name="confirm_password" id="confirm_password" tabindex="2" class="form-control" placeholder="Confirm Password">
                        <?php if(form_error('confirm_password')){?> 
                        <span class="help-block alert alert-danger"><?= form_error('confirm_password') ?></span> 
                        <?php
                        } ?>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6 col-sm-offset-3">
                            <button name="register_submit" id="register_submit" tabindex="4" class="form-control btn btn-register" value="register">Add New User</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

</body>
</html>