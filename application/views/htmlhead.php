<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<?php if(is($viewData['refresh'])): ?>
    <meta http-equiv="refresh" content="<?=$viewData['refresh']?>">
<?php endif; ?>
    <link rel="icon" href="/favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<?php /* <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css"> */ ?>
    <!-- Custom styles for this template -->
    <link href="<?=$cssPath?>lazy.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php if(chk($viewData['graph_lib']) == 'charts'): ?>
    <script src="/assets/Highcharts-4.0.4/js/highcharts.js"></script>
<?php elseif(chk($viewData['graph_lib']) == 'stocks'): ?>
    <script src="/assets/Highstock-2.0.4/js/highstock.js"></script>
<?php endif; ?>