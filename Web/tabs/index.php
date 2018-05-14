<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="tabbable" style="margin-bottom: 18px;">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">Request Audit</a></li>
            <li class=""><a href="#tab2" data-toggle="tab">Status</a></li>
            <li class=""><a href="#tab3" data-toggle="tab">Settings</a></li>
            <li class=""><a href="#tab4" data-toggle="tab">Help</a></li>
          </ul>
          <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
            <div class="tab-pane active" id="tab1">
              <p><script>$('#tab1').load('../loginScreen/login.php');</script></p>
            </div>
            <div class="tab-pane" id="tab2">
            <div></div>
              <p>Placeholder 2</p>
            </div>
            <div class="tab-pane" id="tab3">
              <p>Placeholder 3</p>
            </div>
            <div class="tab-pane" id="tab4">
              <p>Placeholder</p>
            </div>
          </div>
        </div>
        <script>
$('#tab2').load('../loginScreen/login.php');
$('#tab3').load('/settings.html');
$('#tab4').load('/help.html');
$("topdiv").load("contents/abc.html #xyz",function(){$("#innertabs").tabs();});
</script>
</body>
</html>