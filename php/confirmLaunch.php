<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content=''>
    <link rel='icon' href='favicon.ico'>

    <title>ViNeL - Virtual Networking Lab</title>

    <!-- Bootstrap core CSS -->
    <link href='../dist/css/bootstrap.min.css' rel='stylesheet'>

    <!-- Custom styles for this template -->
    <link href='../css/dashboard.css' rel='stylesheet'>
    <link href='../css/loading.css' rel='stylesheet'>

  </head>

  <body>

    <nav class='navbar navbar-inverse navbar-fixed-top'>
      <div class='container-fluid'>
        <div class='navbar-header'>
          <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='navbar-brand' href='#'>ViNeL</a>
        </div>
        <div id='navbar' class='navbar-collapse collapse'>
          <ul class='nav navbar-nav navbar-right'>
            <li><a href='/'>Dashboard</a></li>
            <li><a href='/account.php'>Account</a></li>
            <li><a href='/docs.php'>Documentation</a></li>
          </ul>
          <form class='navbar-form navbar-right'>
            <input type='text' class='form-control' placeholder='Search...'>
          </form>
        </div>
      </div>
    </nav>

    <div class='container-fluid'>
      <div class='row'>
        <div class='col-sm-3 col-md-2 sidebar'>
          <ul class='nav nav-sidebar'>
            <li><a href='/'>Overview</span></a></li>
            <li class='active'><a href='/single.php'>Single <span class='sr-only'>(current)</a></li>
            <li><a href='/network.php'>Network</a></li>
            <li><a href='/logs.php'>Logs</a></li>
          </ul>
        </div>
        <div id='divMain' class='col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main'>
          <h1 class='page-header'>Launch Single VM Summary</h1>
          <form action='tools/launchVM.php' method='POST'>
            <fieldset>
              <?php include('displayConfirm.php'); ?>
            </fieldset>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js'></script>
    <script src='../dist/js/bootstrap.min.js'></script>
    <script src='../assets/js/docs.min.js'></script>
    <script src='../js/confirm.js'></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src='../assets/js/ie10-viewport-bug-workaround.js'></script>
  </body>
</html>
