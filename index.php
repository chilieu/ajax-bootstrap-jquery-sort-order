
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Here's a simple tutorial showing how to use jQuery UI's sortable plugin to update a database table's sort order field on the fly using ajax.">
    <meta name="keywords" content="JQuery, Sortable, Ajax Sorting, Drag and Drop, List Sorting">
    <title>Jquery-Sortable Ajax</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    
    <!-- Bootstrap Glyphicons CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap-glyphicons.css" />
  
    <!--JQuery JS-->
    <script type="text/javascript" src="js/jquery.min.js"></script>

    <!--JQuery UI JS-->
    <script type="text/javascript" src="js/jquery-ui.js"></script>

    <!--Re-Ordering Table JS-->
    <script type="text/javascript" src="js/jquery.rowreordering.js"></script>

    <link rel="shortcut icon" href="files/favicon.ico" />
</head>
    <body>
        

        <div class="container-fluid">
            

<h1>jQuery UI Sortable Example</h1>
<p>Here's a simple tutorial showing how to use jQuery UI's sortable plugin to update a database table's sort order field on the fly using ajax.</p>
<p>Here's the HTML markup used to define the content that will be sortable (I'm using table but you don't have to, you can use div instead)</p>
<p>Below is an example, you can also download from GitHub @ <a href="https://github.com/chilieu/ajax-bootstrap-jquery-sort-order">ajax-bootstrap-jquery-sort-order</a> or get to know me @ <a href="http://www.chilieu.me/">Chi T Lieu</a></p>


<h2>JQuery Ajax Sortable Order</h2>

<table align="center" class="table table-striped table-bordered table-hover dataTable" id="motherboard-list">
    <thead>
        <tr>
            <th width="10px"></th>
            <th width="45%">Manufacturer</th>
            <th width="45%">Model</th>
         </tr>
    </thead>

    <tbody>
            <tr id="4">
            <td class="move"><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span></td>
            <td>SuperMicro</td>
            <td>X10SLX-F</td>
        </tr>
            <tr id="8">
            <td class="move"><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span></td>
            <td>SuperMicro</td>
            <td>H97M-PLUS</td>
        </tr>
            <tr id="3">
            <td class="move"><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span></td>
            <td>SuperMicro</td>
            <td>X10SLA-F</td>
        </tr>
            <tr id="5">
            <td class="move"><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span></td>
            <td>SuperMicro</td>
            <td>X10SRW-F</td>
        </tr>
            <tr id="6">
            <td class="move"><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span></td>
            <td>SuperMicro</td>
            <td>X9SCL</td>
        </tr>
        </tbody>
    
</table>


<pre>
<?php
echo htmlspecialchars('
<table align="center" class="table table-striped table-bordered table-hover dataTable" id="motherboard-list">
    <thead>
        <tr>
            <th width="10px"></th>
            <th width="45%">Manufacturer</th>
            <th width="45%">Model</th>
         </tr>
    </thead>
    <tbody>
            <tr id="4">
            <td class="move"><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span></td>
            <td>SuperMicro</td>
            <td>X10SLX-F</td>
        </tr>
            <tr id="8">
            <td class="move"><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span></td>
            <td>SuperMicro</td>
            <td>H97M-PLUS</td>
        </tr>
            <tr id="3">
            <td class="move"><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span></td>
            <td>SuperMicro</td>
            <td>X10SLA-F</td>
        </tr>
            <tr id="5">
            <td class="move"><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span></td>
            <td>SuperMicro</td>
            <td>X10SRW-F</td>
        </tr>
            <tr id="6">
            <td class="move"><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span></td>
            <td>SuperMicro</td>
            <td>X9SCL</td>
        </tr>
    </tbody>
</table>
');?>
</pre>

<pre>
<?php
echo htmlspecialchars('     <tr id="4">');?>
</pre>

<p><u>is ID of row, we will use this ID for updating</u></p>

<p><strong>Including libs:</strong></p>

<pre>
<?php
echo htmlspecialchars('
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="//www.chilieu.me/ajax-jquery-sortable/css/bootstrap.min.css"/>
    
    <!-- Bootstrap Glyphicons CSS -->
    <link rel="stylesheet" type="text/css" href="//www.chilieu.me/ajax-jquery-sortable/css/bootstrap-glyphicons.css"/>
  
    <!--JQuery JS-->
    <script type="text/javascript" src="//www.chilieu.me/ajax-jquery-sortable/js/jquery.min.js"></script>

    <!--JQuery UI JS-->
    <script type="text/javascript" src="//www.chilieu.me/ajax-jquery-sortable/js/jquery-ui.js"></script>

    <!--Re-Ordering Table JS-->
    <script type="text/javascript" src="//www.chilieu.me/ajax-jquery-sortable/js/jquery.rowreordering.js"></script>
');?>
</pre>

<p><strong>Javascript inline:</strong></p>
<pre>
<?php
echo htmlspecialchars('
<script language="javascript">

$(document).ready(function() {

    //Rows Reordering
    $("#motherboard-list tbody").rowsReOrdering({
        sOrderURL: "UpdateOrder.php"
    });

});

</script>
');?>
</pre>

<p><strong>Finally to handle things on the server side (using PHP in this demo) we might have some code that looks like this ("UpdateOrder.php"):</strong></p>

<pre>
<?php
echo htmlspecialchars('
<?php

$data = array();

$appendix = 100;

foreach($_POST["order"] as $key => $val){

    $data[$key]["id"] = $val;

    $data[$key]["order"] = ($key + 1) * $appendix;

    //Use MySQL Query to update sorting field from here

}

print_r($data);

?>
');?>
</pre>

<script>

$(document).ready(function() {

    //Rows Reordering
    $("#motherboard-list tbody").rowsReOrdering({
        sOrderURL: "UpdateOrder.php"
    });

});

</script>

        </div>

                <footer class="footer">
          <div align="center">
                <p class="text-muted">JQuery-Sortable-Ajax project &copy; <a href="http://www.chilieu.me">Chi Lieu</a>.</p>
          </div>
        </footer>
	</body>
</html>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-59474380-1', 'auto');
  ga('send', 'pageview');

</script>