<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Profile</title>
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Bootstrap specific javascript functions -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="/assets/css/signin.css" rel="stylesheet">
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
    <!-- Page Content -->
    <!-- Update Profile -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class = "active text-primary bold">Update Profile <?php if($this->session->userdata('user_level')=='admin' && $this->session->userdata('id') != $user['id']){ echo "for User ID# {$user['id']}";} ?></h3>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <?php if($this->session->flashdata('update_success')){?> 
                    <span class="help-block alert alert-success"><?= $this->session->flashdata('update_success') ?></span> 
                    <?php
                    } ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="update-form" action="/update" method="post" role="form">
                                    <div class="form-group">
                                        <input type="text" name="first_name" id="first_name" tabindex="1" class="form-control" placeholder="First Name" value="<?= $user['first_name'] ?>" >
                                        <?php if(form_error('first_name')){?> 
                                        <span class="help-block alert alert-danger"><?= form_error('first_name') ?></span> 
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="last_name" id="last_name" tabindex="1" class="form-control" placeholder="Last Name" value="<?= $user['last_name'] ?>" >
                                        <?php if(form_error('last_name')){?> 
                                        <span class="help-block alert alert-danger"><?= form_error('last_name') ?></span> 
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="<?= $user['email'] ?>" >
                                        <?php if(form_error('email')){?> 
                                        <span class="help-block alert alert-danger"><?= form_error('email') ?></span> 
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="description" cols="20" rows="10" id="description" class="form-control message" style="height: 80px; overflow: hidden;" placeholder="Tell us about yourself!"><?php if($user['description']){echo $user['description'];} ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Current Password">
                                        <?php if(form_error('password')){?> 
                                        <span class="help-block alert alert-danger"><?= form_error('password') ?></span> 
                                        <?php
                                        } ?>
                                        <?php if($this->session->flashdata('update_error')){?> 
                                        <span class="help-block alert alert-danger"><?= $this->session->flashdata('update_error') ?></span> 
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="confirm_password" id="confirm_password" tabindex="2" class="form-control" placeholder="Confirm Current Password">
                                        <?php if(form_error('confirm_password')){?> 
                                        <span class="help-block alert alert-danger"><?= form_error('confirm_password') ?></span> 
                                        <?php
                                        } ?>
                                    </div>
                                    <input type="hidden" name = "user_id" value = "<?= $this->session->userdata('id') ?>">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <button name="update_submit" id="update_submit" tabindex="4" class="form-control btn btn-primary" value="update">Update Profile</button>
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
    <!-- Update Password -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class = "active text-primary bold">Update Password <?php if($this->session->userdata('user_level')=='admin' && $this->session->userdata('id') != $user['id']){ echo "for User ID# {$user['id']}";} ?></h3>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <?php if($this->session->flashdata('update_password_success')){?> 
                    <span class="help-block alert alert-success"><?= $this->session->flashdata('update_password_success') ?></span> 
                    <?php
                    } ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="update-form" action="/updatepass" method="post" role="form">
                                    <div class="form-group">
                                        <input type="password" name="new_password" id="new_password" tabindex="3" class="form-control" placeholder="New Password">
                                        <?php if(form_error('new_password')){?> 
                                        <span class="help-block alert alert-danger"><?= form_error('new_password') ?></span> 
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="confirm_new_password" id="confirm_new_password" tabindex="3" class="form-control" placeholder="Confirm New Password">
                                        <?php if(form_error('confirm_new_password')){?> 
                                        <span class="help-block alert alert-danger"><?= form_error('confirm_new_password') ?></span> 
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="current_password" id="current_password" tabindex="3" class="form-control" placeholder="Current Password">
                                        <?php if(form_error('current_password')){?> 
                                        <span class="help-block alert alert-danger"><?= form_error('current_password') ?></span> 
                                        <?php
                                        } ?>
                                        <?php if($this->session->flashdata('password_update_error')){?> 
                                        <span class="help-block alert alert-danger"><?= $this->session->flashdata('password_update_error') ?></span> 
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="confirm_current_password" id="confirm_current_password" tabindex="3" class="form-control" placeholder="Confirm Current Password">
                                        <?php if(form_error('confirm_current_password')){?> 
                                        <span class="help-block alert alert-danger"><?= form_error('confirm_current_password') ?></span> 
                                        <?php
                                        } ?>
                                    </div>
                                    <input type="hidden" name = "user_id" value = "<?= $this->session->userdata('id') ?>">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <button id="update_submit" tabindex="4" class="form-control btn btn-primary">Update Password</button>
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