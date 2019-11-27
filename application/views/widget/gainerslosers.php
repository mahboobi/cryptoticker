<html>

<head>
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700,800,900" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script>
  $(document).ready(function() {
      $(".tabs-menu a").click(function(event) {
          event.preventDefault();
          $(this).parent().addClass("current");
          $(this).parent().siblings().removeClass("current");
          var tab = $(this).attr("href");
          $(".tab-content").not(tab).css("display", "none");
          $(tab).fadeIn();
      });
  });
  </script>
  <script >
  window.onload = function() {
    function makeChart(values, height, parent, filled) {
      var width = 90;
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


  <style>
  body {
    font-family: 'Work Sans', sans-serif;
line-height: 1.5;
font-size: 12px;
padding: 2px;
margin: 0px;
background: #fff;
}

.losergianers-tab{
  width: 100%;
float: left;
}

.tabs-menu {
    float: left;
    clear: both;
    list-style: none;
    width: 100%;
    margin: 0px;
    padding: 0px;
}
.tabs-menu li {
  height: 39px;
      line-height: 36px;
      float: left;
      margin-right: 10px;
      background-color: #ececec;
      border-top: 1px solid #d4d4d1;
      width: 46%;
      text-align: center;
      color: #025b7a;
      border-radius: 9px;
      margin: 6px 2%;
      text-transform: capitalize;
      overflow: hidden;
}

.tabs-menu li.current {
  position: relative;
background-color: #025b7a;
z-index: 5;
width: 46%;
margin: 6px 2%;
float: left;
background: #fff;
border-radius: 9px;
overflow: hidden;
}
.tabs-menu li a {
  padding: 0px 0px;
      text-transform: uppercase;
      color: #035978;
      text-decoration: none;
      width: 100%;
      float: left;
      text-align: center;
      font-size: 17px;
      font-weight: 700;
}

.tabs-menu .current a {
  color: #035978;
background: #2998bf;
padding: 2px 0px;
font-size: 17px;
font-weight: 700;
}

.tab {
    border: 1px solid #d4d4d1;
    background-color: #fff;
    float: left;
    margin-bottom: 20px;
    width: 99.7%;
}

.tab table{
  width: 100%;
  font-size: 12px;
}

.tab table td{
  border-top: 1px solid #ddd;
  padding: 8px;
  text-transform: capitalize;
  text-align: center;
}

.tab table td:nth-child(2){

}


.tab-content {
    width: 100%;
    padding: 0px;
    display: none;
}

thead{
      background: #ececec;
}

thead th{
  border: none;
    padding: 8px;
}

#tab-1 {
 display: block;
}
#tabs-container{
  width: 100%;
float: left;
}


  </style>
</head>
  <body>
    <div class="losergianers-tab">


      <div id="tabs-container">
    <ul class="tabs-menu">
        <li class="current"><a href="#tab-1">Top Gainers</a></li>
        <li><a href="#tab-2">Top Losers</a></li>

    </ul>
    <div class="tab">
        <div id="tab-1" class="tab-content">
          <table>
            <thead>
              <tr>


              <th>
                Coin/Token
              </th>
              <th>
                Last Price
              </th>
              <th>
                % Change
              </th>
              <th>

              </th>
              </tr>
            </thead>
            <?php foreach($coin_gainers as $k => $v ): ?>
              <tr>

                  <td>
                  <?= $v->coin_id ?>
                  </td>
                     <td>

                     <?= $v->price_usd ?>
                   </td>

                   <td>

                   <?= $v->percent_change_24h ?>
                 </td>
                 <td>
        <span class="sparkline sparkline-filled" data-values="<?php
        $price_str = '';
        //echo $v->coin_id; pr($coin_prices);
        foreach($coin_prices[$v->coin_id] as $o)
          $price_str .= $o->price_usd.','; //die();
        echo rtrim($price_str, ','); ?>"
       ></span>
                 </td>

                 </tr>
            <?php endforeach; ?>


          </table>
        </div>
        <div id="tab-2" class="tab-content">
          <table>
            <thead>
              <tr>


              <th>
                Coin/Token
              </th>
              <th>
                Last Price
              </th>
              <th>
                % Change
              </th>

              </tr>
            </thead>
            <?php foreach($coin_loosers as $k => $v ): ?>
              <tr>

                  <td>
                  <?= $v->coin_id ?>
                  </td>
                     <td>

                     <?= $v->price_usd ?>
                   </td>

                   <td>

                   <?= $v->percent_change_24h ?>
                 </td>
                 <td>
                    <span class="sparkline sparkline-filled" data-values="<?php
                    $price_str = '';
                    //echo $v->coin_id; pr($coin_prices);
                    foreach($coin_prices[$v->coin_id] as $o)
                      $price_str .= $o->price_usd.','; //die();
                    echo rtrim($price_str, ','); ?>"
                   ></span>
                 </td>

                 </tr>
            <?php endforeach; ?>


          </table>

        </div>
        <div id="tab-3" class="tab-content">
          <table>
            <tr>
              <td>
                Verge
              </td>
              <td>
                $0.003
              </td>
              <td>
                <span class="green">23% </span>
              </td>
            </tr>
            <tr>
              <td>
                Ripple
              </td>
              <td>
                $0.003
              </td>
              <td>
                <span class="green">23% </span>
              </td>
            </tr>
            <tr>
              <td>
                Tron
              </td>
              <td>
                $0.003
              </td>
              <td>
                <span class="green">23% </span>
              </td>
            </tr>
            <tr>
              <td>
                Corado
              </td>
              <td>
                $0.003
              </td>
              <td>
                <span class="green">23% </span>
              </td>
            </tr>

          </table>
        </div>

    </div>
</div>

    </div>


  </body>

</html>
