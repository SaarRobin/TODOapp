<?php

/** @var array $tasks */
/** @var $this View */
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
        <div class="col-md-6">
            <h2>My personal TODO list</h2>
        </div>
        <div class="col-md-10">
            <a href="../index/logout" role="button" class="btn btn-danger">Log out</a>
            <!-- Button trigger modal -->
            <button class="btn btn-primary " data-toggle="modal" data-target="#addNew">
                Add new task
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close"
                                data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            Add new task
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form role="form" method="post" action="../index/add">
                            <div class="form-group">
                                <label for="taskName">Task Name</label>
                                <input type="text" class="form-control"
                                       id="taskName" name="taskName" placeholder="New task name"/>
                            </div>
                            <div class="form-group">
                                <label for="comments">Comments</label>
                                <input type="text" class="form-control"
                                       id="comments" name="comments" placeholder="Add comment"/>
                            </div>
                            <div class="form-group">
                                <label for="dueDate">Due Date</label>
                                <input type="text" class="form-control"
                                       id="dueDate" name="dueDate" placeholder="yyyy-mm-dd"/>
                            </div>
                            <button type="submit" id="addNewSubmit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Task name</th>
        <th>Comments</th>
        <th>Date created</th>
        <th>Date due</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 0;
    foreach ($tasks as $task): ?>
        <?php
        $i += 1;
        ?>
        <tr>
            <th><?= $i ?></th>
            <th><?= htmlspecialchars(isset($task['taskName'])) ?></th>
            <th><?= htmlspecialchars(isset($task['comments'])) ?></th>
            <th><?= htmlspecialchars(isset($task['createDate'])) ?></th>
            <th><?= htmlspecialchars(isset($task['dueDate'])) ?></th>
            <th class="table-borderless" style="border-top: none;">
                <form class="btn-group" method="GET" action="../index/delete">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <input type="hidden" name="id" value="<?= isset($task['id']) ?>"/>
                </form>
            </th>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
</body>
</html>