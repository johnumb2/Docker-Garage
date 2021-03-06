<?php
require_once('inc/garage.class.php');

$garage = new Garage();

if ($garage->isConfigured()) {
  if (!$garage->isValidSession()) {
    header('Location: login.php');
    exit;
  } elseif (!$garage->isAdmin()) {
    header('Location: ' . dirname($_SERVER['PHP_SELF']));
    exit;
  }
} else {
  header('Location: setup.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <title>Garage</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
    <link rel='stylesheet' href='//bootswatch.com/4/darkly/bootstrap.min.css'>
    <link rel='stylesheet' href='//use.fontawesome.com/releases/v5.0.12/css/all.css' integrity='sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9' crossorigin='anonymous'>
    <link rel='stylesheet' href='css/bootstrap-pincode-input.css'>
  </head>
  <body>
    <div class='container'>
      <table class='table table-striped table-hover table-sm'>
        <thead>
          <tr>
            <th>Pin</th>
            <th>First</th>
            <th>Last</th>
            <th>Role</th>
            <th>Begin</th>
            <th>End</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
<?php
foreach ($garage->getUsers() as $pin => $user) {
  echo "          <tr>" . PHP_EOL;
  echo "            <th>{$pin}</th>" . PHP_EOL;
  echo "            <td>{$user['first_name']}</td>" . PHP_EOL;
  echo "            <td>{$user['last_name']}</td>" . PHP_EOL;
  echo "            <td>{$user['role']}</td>" . PHP_EOL;
  echo "            <td>{$user['begin']}</td>" . PHP_EOL;
  echo "            <td>{$user['end']}</td>" . PHP_EOL;
  echo "            <td>" . PHP_EOL;
  echo "              <button type='button' class='btn btn-sm btn-outline-info' data-toggle='modal' data-target='#editModal'>Edit</button>" . PHP_EOL;
  echo "              <button type='button' class='btn btn-sm btn-outline-danger'>Delete</button>" . PHP_EOL;
  echo "            </td>" . PHP_EOL;
  echo "          </tr>" . PHP_EOL;
}
?>
        </tbody>
      </table>
    </div>
    <div class='modal fade' id='editModal'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id='editModalTitle'>Edit User</h5>
            <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
          </div>
          <div class='modal-body'>
            <div class='form-row justify-content-center'>
              <div class='col-auto'>
                <input class='form-control' type='text' id='first_name' placeholder='First'>
                <input class='form-control' type='text' id='last_name' placeholder='Last'>
                <input type='text' id='pincode'>
              </div>
            </div>
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            <button type='button' class='btn btn-primary'>Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <script src='//code.jquery.com/jquery-3.2.1.min.js' integrity='sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f' crossorigin='anonymous'></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
    <script src='js/bootstrap-pincode-input.js'></script>
    <script>
      $(document).ready(function() {
        $('#pincode').pincodeInput({inputs:6, hidedigits:false});
      });
    </script>
  </body>
</html>
