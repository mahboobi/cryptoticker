<html>

<head>
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700,800,900" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script>

  $( document ).ready(function() {
  var cur1old = $(".cur01").data('valold');
var cur1new = $(".cur01").data('valnew');
var cur2old = $(".cur11").data('valold');
var cur2new = $(".cur11").data('valnew');
var cur3old = $(".cur21").data('valold');
var cur3new = $(".cur21").data('valnew');
var cur4old = $(".cur31").data('valold');
var cur4new = $(".cur31").data('valnew');
var cur5old = $(".cur41").data('valold');
var cur5new = $(".cur41").data('valnew');
var cur6old = $(".cur51").data('valold');
var cur6new = $(".cur51").data('valnew');

var compare12old = cur1old - cur2old;
var compare12new = cur1new - cur2new;

if(compare12old > compare12new){
    $(".row1col2").addClass('red');
    $(".row2col1").addClass('green');
    }else {
    $(".row1col2").addClass('green');
    $(".row2col1").addClass('red');
}


var compare13old = cur1old - cur3old;
var compare13new = cur1new - cur3new;

if(compare13old > compare13new){
    $(".row1col3").addClass('red');
    $(".row3col1").addClass('green');
    }else {
    $(".row1col3").addClass('green');
    $(".row3col1").addClass('red');
}

var compare14old = cur1old - cur4old;
var compare14new = cur1new - cur4new;

if(compare14old > compare14new){
    $(".row1col4").addClass('red');
    $(".row4col1").addClass('green');
    }else {
    $(".row1col4").addClass('green');
    $(".row4col1").addClass('red');
}

var compare15old = cur1old - cur5old;
var compare15new = cur1new - cur5new;

if(compare15old > compare15new){
    $(".row1col5").addClass('red');
    $(".row5col1").addClass('green');
    }else {
    $(".row1col5").addClass('green');
    $(".row5col1").addClass('red');
}


var compare16old = cur1old - cur6old;
var compare16new = cur1new - cur6new;

if(compare16old > compare16new){
    $(".row1col6").addClass('red');
    $(".row6col1").addClass('green');
    }else {
    $(".row1col6").addClass('green');
    $(".row6col1").addClass('red');
}


var compare23old = cur2old - cur3old;
var compare23new = cur2new - cur3new;

if(compare23old > compare23new){
    $(".row2col3").addClass('red');
    $(".row3col2").addClass('green');
    }else {
    $(".row2col3").addClass('green');
    $(".row3col2").addClass('red');
}

var compare24old = cur2old - cur4old;
var compare24new = cur2new - cur4new;

if(compare24old > compare24new){
    $(".row2col4").addClass('red');
    $(".row4col2").addClass('green');
    }else {
    $(".row2col4").addClass('green');
    $(".row4col2").addClass('red');
}

var compare25old = cur2old - cur5old;
var compare25new = cur2new - cur5new;

if(compare25old > compare25new){
    $(".row2col5").addClass('red');
    $(".row5col2").addClass('green');
    }else {
    $(".row2col5").addClass('green');
    $(".row5col2").addClass('red');
}

var compare26old = cur2old - cur6old;
var compare26new = cur2new - cur6new;

if(compare26old > compare26new){
    $(".row2col6").addClass('red');
    $(".row6col2").addClass('green');
    }else {
    $(".row2col6").addClass('green');
    $(".row6col2").addClass('red');
}

var compare34old = cur3old - cur4old;
var compare34new = cur3new - cur4new;

if(compare34old > compare34new){
    $(".row3col4").addClass('red');
    $(".row4col3").addClass('green');
    }else {
    $(".row3col4").addClass('green');
    $(".row4col3").addClass('red');
}


var compare35old = cur3old - cur5old;
var compare35new = cur3new - cur5new;

if(compare35old > compare35new){
    $(".row3col5").addClass('red');
    $(".row5col3").addClass('green');
    }else {
    $(".row3col5").addClass('green');
    $(".row5col3").addClass('red');
}

var compare36old = cur3old - cur6old;
var compare65new = cur3new - cur6new;

if(compare35old > compare35new){
    $(".row3col6").addClass('red');
    $(".row6col3").addClass('green');
    }else {
    $(".row3col6").addClass('green');
    $(".row6col3").addClass('red');
}

var compare45old = cur4old - cur5old;
var compare45new = cur4new - cur5new;
if(compare45old > compare45new){
    $(".row4col5").addClass('red');
    $(".row5col4").addClass('green');
    }else {
    $(".row4col5").addClass('green');
    $(".row5col4").addClass('red');
}

var compare46old = cur4old - cur6old;
var compare46new = cur4new - cur6new;
if(compare46old > compare46new){
    $(".row4col6").addClass('red');
    $(".row6col4").addClass('green');
    }else {
    $(".row4col6").addClass('green');
    $(".row6col4").addClass('red');
}

var compare56old = cur5old - cur6old;
var compare56new = cur5new - cur6new;
if(compare56old > compare56new){
    $(".row5col6").addClass('red');
    $(".row6col5").addClass('green');
    }else {
    $(".row5col6").addClass('green');
    $(".row6col5").addClass('red');
}

});

  </script>


  <style>
  body{
        font-family: 'Work Sans', sans-serif;
    font-size: 12px;
    padding: 0px;
    margin: 0px;
    width: 100%;
  }
  .heatmap-div {
    min-width: 350px;
        float: left;
        width: 100%;
        height: 100%;
        background: #fff;
        width: 100%;
  }


      td{
        width:90px;
        text-align:center;
      text-transform: capitalize;
      }

      .red{
        background:red;
        }

        .green{
        background:green;
        }
      }

  </style>
</head>
  <body>
    <div class="heatmap-div">


      <table>

  <tr>
  <td></td>
  <?php $i = 0;
  foreach($coin_list as $k => $v ): ?>
    <td
      class="cur<?= print $i ?>"
      data-valnew="<?= $v->price_usd ?>"
      data-valold="<?= print ($v->price_usd*100)/($v->percent_change_24h+100) ?>"
      >
      <?= $v->coin_id ?>

    </td>

<?php if ($i++ > 4) break;?>
  <?php endforeach; ?>
</tr>
  <!--
    <td class="cur1" data-valnew="" data-valold="13450">BTC</td>

     <td class="cur2" data-valnew="800" data-valold="950">ETH</td>
     <td class="cur3" data-valnew="320" data-valold="450">LTC</td>
     <td class="cur4" data-valnew="0.2" data-valold="0.45">XRP</td>
     <td class="cur5" data-valnew="900" data-valold="4550">BCH</td>
     <td class="cur6" data-valnew="100" data-valold="150">NEM</td> -->
  </tr>
  <tr>
    <td>Bitcoin</td>
     <td class="row1col1"></td>
     <td class="row1col2"></td>
     <td class="row1col3"></td>
     <td class="row1col4"></td>
     <td class="row1col5"></td>
        <td class="row1col6"></td>
  </tr>
  <tr>
     <td >Ethereum</td>
     <td class="row2col1"></td>
     <td class="row2col2"></td>
     <td class="row2col3"></td>
     <td class="row2col4"></td>
     <td class="row2col5"></td>
           <td class="row2col6"></td>
  </tr>
  <tr>
     <td >Bitcoin Cash</td>
     <td class="row3col1"></td>
     <td class="row3col2"></td>
     <td class="row3col3"></td>
     <td class="row3col4"></td>
     <td class="row3col5"></td>
           <td class="row3col6"></td>
  </tr>
  <tr>
     <td >Ripple</td>
     <td class="row4col1"></td>
     <td class="row4col2"></td>
     <td class="row4col3"></td>
     <td class="row4col4"></td>
     <td class="row4col5"></td>
           <td class="row4col6"></td>
  </tr>
  <tr>
     <td>Litecoin</td>
     <td class="row5col1"></td>
     <td class="row5col2"></td>
     <td class="row5col3"></td>
     <td class="row5col4"></td>
     <td class="row5col5"></td>
        <td class="row5col6"></td>
  </tr>
  <tr>
     <td >Cardano</td>
     <td class="row6col1"></td>
     <td class="row6col2"></td>
     <td class="row6col3"></td>
     <td class="row6col4"></td>
     <td class="row6col5"></td>
     <td class="row6col6"></td>
  </tr>
  </table>

    </div>

    <div class="currency-headmap">
      <table>

      </table>
    </div>
  </body>
</html>
