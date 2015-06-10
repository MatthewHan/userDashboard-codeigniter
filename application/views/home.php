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
    <link href="assets/css/heroic-features.css" rel="stylesheet">
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
                        <a href="#">Home</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                	<li>
                		<a href="signin">Sign In</a>
                	</li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Page Content -->
    <div class="container">
        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h2>Welcome to the Test</h2>
            <p>We're going to a build a cool application using a MVC framework!  This application was built with the Village88 folks!</p>
            <p><a class="btn btn-primary btn-large">Start</a>
            </p>
        </header>
        <!-- Page Features -->
        <div class="row text-center">

            <div class="col-md-4 col-sm-8 hero-feature">
                <div class="thumbnail">
                    <div class="caption">
                        <h3>Manage Users</h3>
                        <p>Using this application, you'' learn how to add, remove, and edit users for the application.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-8 hero-feature">
                <div class="thumbnail">
                    <div class="caption">
                        <h3>Leave Messages</h3>
                        <p>Users will be able to leave a message to another use using this application.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-8 hero-feature">
                <div class="thumbnail">
                    <div class="caption">
                        <h3>Edit User Information</h3>
                        <p>Admin will be able to edit another use's information (email address, first name, last name, etc).</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</body>
</html>