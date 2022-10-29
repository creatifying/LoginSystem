<?php
session_start();
if (isset($_SESSION["loggedin"])){
    header('Location: /dash.php');
      exit();
  }
require 'components/header.php';
?>
<div class="b-example-divider"></div>

<div class="px-4 pt-5 my-5 text-center border-bottom">
    <h1 class="display-4 fw-bold">Login & Registration System</h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Where is the best login registration system made using PHP and  bootstrap. PHP is the open source programming language and Bootstrap is the most popular CSS Framework for developing responsive and mobile-first websites</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
            <button type="button"   class="btn btn-primary btn-lg px-4 me-sm-3" onclick="window.location='/login.php';">Login</button>
            <button type="button" class="btn btn-outline-secondary btn-lg px-4" onclick="window.location='/signup.php';">Signup</button>
        </div>
    </div>
    
    </div>
</div>
<?php

require 'components/footer.php';
?>