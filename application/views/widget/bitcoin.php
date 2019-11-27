<html>

<head>
  <script
    src="https://code.jquery.com/jquery-3.2.1.js"
    integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
    crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700,800,900" rel="stylesheet">
  <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>

<script src="https://code.highcharts.com/modules/exporting.js"></script>


<style>

body {
    font-family: 'Work Sans', sans-serif;
background: #fff;
}

#container {
	min-width: 310px;
	max-width: 800px;
	height: 400px;
	margin: 0 auto
}

.highcharts-credits{
  background: #fff;
}

.coin-data{
  background: #f1f1f1;
    float: left;
    width: 96%;
    padding: 0px 2%;
    position: relative;
}

.coin-data .name{
  width: 50%;
  text-align: left;
  float: left;
}

.coin-data .price{
  float: left;
text-align: right;
width: 50%;
}

.coin-data h2{
  font-size: 34px;
  margin-bottom: -6px;
  margin-top: 16px;
}

.coin-data h1{
  margin-bottom: -8px;
font-size: 42px;
margin-top: 10px;
font-weight: 900;
}

.coin-data:after{
content:"";
position: absolute;
    top: 0px;
    width: 2px;
    background: #025b7a;
    height: 100%;
    left: 0;
    right: 0;
    margin: auto;
    transform: rotate(19deg);
}
</style>
</head>
<body>
  <div id="container"></div>
  <div class="coin-data">
    <div class="name">
      <h1><?= $coin_meta->name ?></h1>
      <p>
        Rank <?= $coin_meta->rank ?> | Market Cap $<?= $coin_meta->market_cap_usd ?>
      </p>
    </div>

    <div class="price">
      <h2><?= $coin_meta->price_usd ?></h2>
      <p>
        24h: <?= $coin_meta->percent_change_24h ?>% | 7d: <?= $coin_meta->percent_change_7d ?>%
      </p>
    </div>

  </div>



  <script>
  Highcharts.chart('container', {
       chart: {
           zoomType: 'x'
       },
       title:{
         text:'<?= $coin_meta->name ?>'
       },
       xAxis: {
           type: 'datetime'
       },
       yAxis: {
           title: {
               text: 'USD'
           }
       },
       legend: {
           enabled: false
       },
       plotOptions: {
           area: {
               fillColor: {
                   linearGradient: {
                       x1: 0,
                       y1: 0,
                       x2: 0,
                       y2: 1
                   },
                   stops: [
                       [0, Highcharts.getOptions().colors[0]],
                       [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                   ]
               },
               marker: {
                   radius: 0
               },
               lineWidth: 1,
               states: {
                   hover: {
                       lineWidth: 1
                   }
               },
               threshold: null
           }
       },


      series: [{


          data: [
              <?php foreach($coin_data as $k => $v ): ?>
                    [<?= $v->last_updated ?>000, <?= $v->price_usd ?> ],
              <?php endforeach; ?>
          ]
      },  ]
  });

  </script>


</body>
</html>
