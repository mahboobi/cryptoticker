<html>

<head>
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script >
  window.onload = function() {
    function makeChart(values, height, parent, filled) {
      var width = 100;
      height = height - 2;
      var max = Math.max.apply(null, values);
      var min = Math.min.apply(null, values);

      function c(x) {
        var s = height / (max - min);
        return height - (s * (x - min));
      }

      var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
      svg.setAttribute('width', width);
      svg.setAttribute('height', height);
      svg.setAttribute('transform', 'translate(0,1)');

      var offset = Math.round(width/(values.length - 1));
      var path = 'M0 ' + c(values[0]).toFixed(2);
      for (var i = 0; i < values.length; i++) {
        path += ' L ' + (i * offset) + ' ' + (c(values[i]).toFixed(2));
      }

      var pathElm = document.createElementNS('http://www.w3.org/2000/svg', 'path');
      pathElm.setAttribute('d', path);
      pathElm.setAttribute('fill', 'none');
      svg.appendChild(pathElm);

      if (filled) {
        path += ' V ' + height;
        path += ' L 0 ' + height + ' Z';
        var e = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        e.setAttribute('d', path);
        e.setAttribute('stroke', 'none');
        svg.appendChild(e);
      }

      parent.appendChild(svg);
    }

    function getDefaultFontSize(pa) {
      pa= pa || document.body;
      var who= document.createElement('div');

      who.style.cssText='display:inline-block; padding:0; line-height:1; position:absolute; visibility:hidden; font-size:1em';

      who.appendChild(document.createTextNode('M'));
      pa.appendChild(who);
      var fs= [who.offsetWidth, who.offsetHeight];
      pa.removeChild(who);
      return fs;
   }

    var elms = document.querySelectorAll('.sparkline');
    for (var i = 0; i < elms.length; i++) {
      var e = elms[i];
      var values = elms[i].dataset.values.split(',').map(function(d) { return parseFloat(d); });
      var height = getDefaultFontSize(e)[1];
      if (e.classList.contains('sparkline-filled')) {
        makeChart(values, height, e, true);
      } else {
        makeChart(values, height, e, false);
      }
    }
  }


  </script>

  <script>
  /* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val(), 10 );
        var max = parseInt( $('#max').val(), 10 );
        var age = parseFloat( data[3] ) || 0; // use data for the age column

        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && age <= max ) ||
             ( min <= age   && isNaN( max ) ) ||
             ( min <= age   && age <= max ) )
        {
            return true;
        }
        return false;
    }
);

$(document).ready(function() {
    var table = $('#sort').DataTable();

    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').keyup( function() {
        table.draw();
        makeChart();
    } );
} );
</script>
  <style>
  body{
        font-family: 'Work Sans', sans-serif;
    font-size: 12px;
    padding: 0px;
    margin: 0px;
    width: 100%;
  }
  .comparision-div {
      min-width: 350px;
      float: left;
      width: 100%;
      height: 100%;
  }

  #dataTables_length{
    float:left;
    width: 50%;
  }

#sort_filter{
  float: right;
width: 50%;
    text-align: right;
    display: none;
}
.comparision-div table{
  padding: 0px;
  border: none;
  border-spacing: 0px;
  border-collapse: separate;
  margin: 9px 0px;
  float: left;
  font-size: 13px;
  width: 100%;
  background: #fff;
}

a.paginate_button {
    padding: 9px;
    cursor: pointer;
}

.dataTables_length, .dataTables_info{
  display: none;
}

.dataTables_paginate{
  width: 100%;
float: left;
text-align: center;
}

thead{
  color: #333;
      font-weight: bold;
      border-bottom: 1px solid #333;
      background: #fff;
}

thead th{
  color: #636262;
    background: #fff;
}

thead th {
    padding: 16px 10px;
    text-align: center;
    font-weight: 400;
}


table td{
padding:15px 10px;
text-align: center;
    color: #545454;
}

thead th:nth-child(2),tr td:nth-child(2){
  text-align: left;
  width: 30%;
  text-transform: capitalize;
}

table tr.odd{
  background: #f3f1f7;
}

table tr td:last-child{
  padding: 0px;
}
.sparkline svg {
  stroke: mediumseagreen;
  stroke-width: 1px;
}
.sparkline-filled svg {
  fill: rgba(60,179,113,0.0);
}

.buy{
  background: #11a511;
    color: #fff;
    padding: 2px 5px;
    font-size: 9px;
    border-radius: 2px;
    border-left: 2px solid #005400;
    font-weight: 500;
}
  </style>
</head>
  <body>
    <div class="comparision-div">


    <table id="sort">
      <thead>
        <tr>
          <th>
            #
          </th>
          <th>
            Name
          </th>
          <th>
            Price USD
          </th>
          <th>
            Price BTC
          </th>

          <th>
            Change 24h
          </th>
          <th>
            Graph
          </th>
        </tr>
      </thead>
    <?php foreach($coin_list as $k => $v ): ?>

        <tr>
          <td>
            <?= $v->rank?>
          </td>
          <td>
            <?= $v->coin_id ?> <small class="buy">BUY</small>
          </td>
          <td>
             <?= $v->price_usd ?>
          </td>
          <td>
             <?= $v->price_btc ?>
          </td>

          <td>
            <?= $v->percent_change_24h ?>%
          </td>

          <td>
            <?php
            $price_str = '';
            foreach($coin_prices[$v->coin_id] as $o)
              $price_str .= $o->price_usd.',';?>
 <span class="sparkline sparkline-filled" data-values="<?php echo rtrim($price_str, ','); ?>"></span>
          </td>
        </tr>

    <?php endforeach; ?>
    </table>
    </div>

    <div class="currency-headmap">
      <table>

      </table>
    </div>
  </body>

</html>
