<?php

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker4').datetimepicker({
                pickTime: false
            });
        });
    </script>
</head>
<body>
<div class="well">
    <div id="datetimepicker4" class="input-append">
        <input data-format="yyyy-MM-dd" type="text"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
    </div>
</div>
</body>
</html>