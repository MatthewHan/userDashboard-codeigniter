<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Bootstrap specific javascript functions -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/assets/css/dashboard.css">
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

    <div class="container">
        <h2>All Users/Manage Users</h2>
        <div class="method">
            <div class="row margin-0 list-header hidden-sm hidden-xs">
                <div class="col-md-1"><div class="header">ID</div></div>
                <div class="col-md-2"><div class="header">Name</div></div>
                <div class="<?php if($this->session->userdata['user_level']=='admin'){echo 'col-md-3';}else{echo 'col-md-4';} ?>"><div class="header">Email</div></div>
                <div class="<?php if($this->session->userdata['user_level']=='admin'){echo 'col-md-2';}else{echo 'col-md-3';} ?>"><div class="header">Registered On</div></div>
                <div class="col-md-2"><div class="header">User Level</div></div>
                <?php if($this->session->userdata['user_level']=='admin')
                {?>
                    <div class="col-md-2"><div class="header">Edit/Remove</div></div>
                <?php
                }?>
            </div>
            <?php 
            foreach($users as $user)
            {?>
                <div class="row margin-0">
                    <div class="col-md-1">
                        <div class="cell">
                            <?= $user['id'] ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="cell">
                            <a href="/users/show/<?= $user['id']?>"><?= $user['name'] ?></a>
                        </div>
                    </div>
                    <div class="<?php if($this->session->userdata['user_level']=='admin'){echo 'col-md-3';}else{echo 'col-md-4';} ?>">
                        <div class="cell">
                            <?= $user['email'] ?>
                        </div>
                    </div>
                    <div class="<?php if($this->session->userdata['user_level']=='admin'){echo 'col-md-2';}else{echo 'col-md-3';} ?>">
                        <div class="cell">
                            <?= date("F j, Y" ,strtotime($user['created_at'])) ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="cell">
                            <?= $user['user_level'] ?>
                        </div>
                    </div>
                    <?php if($this->session->userdata['user_level']=='admin')
                    {?>
                        <div class="col-md-2">
                        <div class="cell">
                            <a href="/users/edit/<?= $user['id']?>">Edit</a> / Remove
                        </div>
                    </div>
                    <?php
                    }?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>