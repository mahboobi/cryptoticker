<?php 
include_once(APPPATH.'views/paths.php');

include_once($VIEWPATH.'htmlhead.php');
?>
  </head>

  <body>
<?php
//if(isset($viewData['welcome_on'])) echo '<h1>Welcome to Mooscrap!</h1><br />';

//if(!isset($viewData['header_off'])) 
//if($viewData['page'] != 'login') include_once($VIEWPATH.'header.php');
include_once($VIEWPATH.'header.php');

$controller_path = isset($viewData['controller_path']) ? $viewData['controller_path'].'/' : '';
if(isset($viewData['module']) && isset($viewData['page'])) include_once($VIEWPATH.$controller_path.$viewData['module'].'/'.$viewData['page'].'.php');
else echo 'view is not set';

include_once($VIEWPATH.'footer.php');