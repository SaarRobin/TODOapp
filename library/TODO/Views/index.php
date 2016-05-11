<?php

/** @var array $tasks */
/** @var $this View */
/** @var array $countries */
/** @var string $error */
use Erply\SDK\MVC\View;

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
?>

<!doctype html>
<html lang="en">
<head>
    <?= $this->render(__DIR__ . '/components/headers.php', []); ?>
    <title>TODO APP</title>
</head>
<body>


<div class="container-fluid">

    <div class="row">
        <div class="navbar-header">
            <h2>Create your own TODO list</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 text-center"><h4>Register</h4></div>
        <div class="col-md-6 text-center"><h4>Sign in</h4></div>
    </div>
    <div class="row">
        <!--    Sign up-->
        <div class="sign-up col-md-6">
            <div class="sign-up-form ">
                <form class="form-horizontal" role="form" method="post" action="../signup/index">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Username</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                                   value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Password</label>

                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="name" name="password" placeholder="Password"
                                   value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email"
                                   placeholder="example@domain.com"
                                   value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="country" class="col-sm-2 control-label">Contry</label>

                        <div class="col-sm-10">
                            <select name="country" id="country" class="form-control">
                                <?php foreach ($countries as $country): ?>
                                    <option
                                        value="<?= $country['countryName'] ?>"><?= htmlspecialchars($country['countryName']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <input id="submit" name="submit" type="submit" value="Register" class="btn btn-primary">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <! Will be used to display an alert to the user>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--    Login-->
        <div class="col-md-6" id="login-form">
            <? if (strlen($error) > 1) {
                echo $error;
            } ?>
            <form class="form-horizontal" role="form" method="post" action="../signin/index">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                               value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="name" name="password" placeholder="Password"
                               value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input id="submit" name="submit" type="submit" value="Sign in" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<div class="modal fade" id="infoModal" style="display: block">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>

                <h3>Info</h3>
            </div>
            <div class="modal-body">
                <p>
                    Hy there. <br/><br/>
                    Welcome to an TODO application. I would higly appreciate if you would use it. <br/>
                    The main goal is to generate a lot of data. So feel free to create any number of users. <br/>
                    Create users with different countries and stuff. Login in, create tasks, delete them etc. <br/>
                    So basically abuse it. <br/>
                    My main wish is that you won't do any XSS stuff and etc. Please be kind! <br/>
                    All the inputs don't have to be nice. Since all the database is going to be dropped later. <br/>
                    This application is used to write a bachelors degree thesis on Third-Party Services for Logging
                    Applications.
                    <br/>
                    It's full of holes and is very unsafe, I allready know that. It will be burned after the thesis is
                    done.
                </p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>