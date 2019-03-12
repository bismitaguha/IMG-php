<!DOCTYPE html>
<html>
<head>
<title>Change your Password</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">
     body{ font: 14px sans-serif; }
     .wrapper{ width: 350px; padding: 20px;}
     .help-block{ color: red;}
</style>
</head>
<body>
<div class="wrapper">
<div class="form-group">
<form id="change" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
  <label>Current Password:</label>
  <input type="password" name="current_password" class="form-control"><br>
  <hr>
  <label>New Password:</label>
  <input type="password" name="new_password" class="form-control" id="password" ><br>
  <label>Confirm Password:</label>
  <input type="password" name="conf_password" class="form-control" id="conf_password" onkeyup='check()' ><br>
  <span id="message"></span>
</form>
</div>
</div>
<script>

function check() {
  if(document.getElementById('password').value == document.getElementById('conf_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Password matching';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Password does not match';
  }}

</script>
</body>
</html>

