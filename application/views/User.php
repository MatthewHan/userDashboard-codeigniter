<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Wall</title>
	 <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<!-- Bootstrap specific javascript functions -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/assets/css/wall.css">
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
        <?php if($this->session->flashdata('success')){?> 
        <span class="help-block alert alert-success"><?= $this->session->flashdata('success') ?></span> 
        <?php
        } ?>
    </div>
    <!-- User Profile -->
    <div class="col-sm-12 col-md-4 col-xs-offset-0 col-sm-offset-0 toppad" >
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $user['first_name'] ." ". $user['last_name'] ?></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class=" col-md-9 col-lg-9 "> 
                        <table class="table table-user-information">
                            <tbody>
                                <tr>
                                    <td>Registered on:</td>
                                    <td><?= date("F j, Y" ,strtotime($user['created_at'])) ?></td>
                                </tr>
                                <tr>
                                    <td>User ID:</td>
                                    <td><?= $user['id'] ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><a href="mailto: <?= $user['email'] ?>"><?= $user['email'] ?></a></td>
                                </tr>
                                    <td>Description:</td>
                                    <td>
                                        <?php if($user['description']){echo $user['description'];} ?>
                                    </td>  
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Post Messages -->
    <div class="post">
        <form action="/message" method="post" role="form" class="facebook-share-box">
            <div class="timeline-body">
                <h4 class = "col-md-12">Leave <?= $user['first_name']?> a message.</h4>
                <div class="share-form">
                    <div class="share">
                        <div><textarea name="message" cols="40" rows="10" id="status_message" class="form-control message" style="height: 80px; overflow: hidden;" placeholder="What's on your mind ?"></textarea> </div>
                        <input type="hidden" name = "user_id" value = "<?= $this->session->userdata('id') ?>">
                        <input type="hidden" name = "wall_user_id" value = "<?= $user['id'] ?>">
                    </div>
                </div>
            </div>
            <?php if($this->session->flashdata('message_error')){?> 
            <span class="help-block alert alert-danger"><?= $this->session->flashdata('message_error') ?></span> 
            <?php
            }?>
            <div class="timeline-footer clearfix">
                <div class="pull-right">
                    <button name="message_post" value="message" id="btn-share" class="btn btn-primary">Post A Message</button>
                </div>
            </div>
        </form>
    </div>
    <!-- Iterate through wall messages -->
    <?php
    foreach($messages as $message)
    {
    ?>
        <ul class = "timeline">
            <li></li>
            <li id ="M<?= $message['id'] ?>" class="post-list">
                <div class="timeline-panel">
                    <div class="timeline-header">
                        <div class="row">
                            <div class="col-xs-8">
                                <?= $message['poster_name'] ?> - <?= date("F j, Y g:i a" ,strtotime($message['created_at'])) ?>
                            </div>
                            <?php if($this->session->userdata('id')===$message['user_id'])
                            {
                            ?>
                            <div class="col-xs-1 pull-right">
                                <form action="/delete_message" method="post">
                                    <input type="hidden" name="message_id" value = "<?= $message['id'] ?>">
                                    <input type="hidden" name = "wall_user_id" value = "<?= $user['id'] ?>">
                                    <button class="btn btn-danger" name="delete_message" value="delete">Delete</button>
                                </form>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="timeline-heading">                 
                    </div>
                    <div class="timeline-body">
                        <p><?= $message['message'] ?></p>
                    </div>
                    <div class="timeline-footer">
                        <button class = "btn btn-link" data-toggle="collapse" data-target="#collapse<?= $message['id'] ?>">Comments</button>
                    </div>
                </div>
            </li>
        </ul>
        <div id="collapse<?= $message['id'] ?>" class="collapse">
        <!-- Iterate through comments for the message -->
        <?php
        foreach($message['comments'] as $comment)
        { ?>
            <ul class = "timeline">
                <li></li>
                <li id ="C<?= $comment['id'] ?>" class="post-list">
                    <div class="timeline-comment">
                        <div class="timeline-header">
                            <div class="row">
                                <div class="col-xs-6">
                                    <?= $comment['poster_name'] ?> - <?= date("F j, Y g:i a" ,strtotime($comment['created_at'])) ?>
                                </div>
                                <?php if($this->session->userdata('id')==$comment['user_id'])
                                {
                                ?>
                                <div class="col-xs-1 pull-right">
                                    <form action="/delete_comment" method="post">
                                        <input type="hidden" name="comment_id" value = "<?= $comment['id'] ?>">
                                        <input type="hidden" name = "wall_user_id" value = "<?= $user['id'] ?>">
                                        <button class="btn btn-danger" name="delete_comment" value="delete">Delete</button>
                                    </form>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="timeline-heading">                 
                        </div>
                        <div class="timeline-body">
                            <p><?= $comment['comment'] ?></p>
                        </div>
                    </div>
                </li>
            </ul>
        <?php
        }?>

        <!-- post a comment -->
        <div class="post">
            <form action="/comment" method="post" role="form" class="facebook-share-box">
                <div class="timeline-body">
                    <div class="share-form-comment">
                        <div class="share">
                            <div><textarea name="comment" cols="35" rows="8" id="comment" class="form-control message" style="height: 62px; overflow: hidden;" placeholder="What's not on your mind?"></textarea> </div>
                            <input type="hidden" name = "message_id" value = <?= $message['id'] ?>>
                            <input type="hidden" name = "user_id" value = "<?= $this->session->userdata('id') ?>">
                            <input type="hidden" name = "wall_user_id" value = "<?= $user['id'] ?>">
                        </div>
                    </div>
                </div>
                <?php if($this->session->flashdata('comment_error'.$message['id'])){?> 
                <span class="help-block alert alert-danger"><?= $this->session->flashdata('comment_error'.$message['id']) ?></span> 
                <?php
                }?>
                <div class="timeline-footer-comment clearfix">
                    <div class="pull-right">
                        <button name="comment_post" value="comment" id="btn-share" class="btn btn-success">Post A Comment</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    <?php
    }
    ?>
</body>
</html>