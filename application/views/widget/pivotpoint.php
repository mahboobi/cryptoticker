<html>

<head>
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700,800,900" rel="stylesheet">

  <script
src="https://code.jquery.com/jquery-3.2.1.js"
integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
crossorigin="anonymous"></script>



  <style>
  body {
    font-family: 'Work Sans', sans-serif;
line-height: 1.5;
font-size: 12px;
padding: 0px;
margin: 0px;
}

	/*Recommendation Section Styling*/

*{
box-sizing:  border-box;
}

.calcToolContainer{
      padding: 15px;
}

    table{
          width: 100%;
    }

    table td{
      border:1px solid #ddd;
      text-align: center;
      line-height: 2;
    }

    .result-div{
      margin: 15px 0px;
    background: #fff;
    padding: 2%;
    width: 96%;
float: left;
    }

    .fib-split{
      width: 50%;
float: left;
    }

    table td:first-child{
      width: 30%;
      font-weight: 800;
    }

.fibonacci{
  padding: 13px;
      background: #f0f0f2;
}

.newToolContainer input {
    padding: 12px;
    width: 100%;
}

.disabled {
    background: #969696;
}

.newBtn {
    background: #333;
    padding: 10px;
    width: 100%;
    float: left;
    text-align: center;
    margin: 10px 0px;
    color: #fff;
    text-decoration: none;
    text-transform: uppercase;
    font-weight: 900;
}

.calcToolRow{
  width: 25%;
  float: left;
}
  </style>
</head>
  <body>



<div class="newToolContainer calcToolContainer">
    <form onsubmit="return false;" id="calc_form" name="calc_form" number-format="us">
        <div class="calcToolRow">
            <label class="rowLabel">High:</label>
            <input type="text" id="HRate" class="newInput inputTextBox" number-format="us" value="10000">
        </div>
        <div class="calcToolRow">
            <label class="rowLabel">Low:</label>
            <input type="text" id="LRate" class="newInput inputTextBox" number-format="us" value="3000">
        </div>
        <div class="calcToolRow">
            <label class="rowLabel">Close:</label>
            <input type="text" id="CRate" class="newInput inputTextBox" number-format="us" value="5000">
        </div>
        <div class="calcToolRow">
            <label class="rowLabel">Open:</label>
            <input type="text" id="ORate" class="newInput inputTextBox" number-format="us" value="6000">
        </div>
        <div class="btnContainer">
            <a href="#" id="pivotcal" class="newBtn Arrow LightGray">Calculate</a>        </div>
        <div class="calcToolBottom">
            <table id="results" class="pivotPointCalcTbl">
                <thead>
                <tr class="title">
                    <th></th>
                    <th>Classic</th>
                    <th>Woodie's</th>
                    <th>Camarilla</th>
                    <th>DeMark's</th>
                </tr>
                </thead>
                <tbody>
                                    <tr class="subtotal">
                        <td class="bold">Resistance 4</td>
                        <td class="infoCol disabled" id="br4"></td>
                        <td class="infoCol disabled" id="wr4"></td>
                        <td class="infoCol" id="cr4"></td>
                        <td class="infoCol disabled" id="demar4"></td>
                    </tr>
                                    <tr class="subtotal">
                        <td class="bold">Resistance 3</td>
                        <td class="infoCol" id="br3"></td>
                        <td class="infoCol disabled" id="wr3"></td>
                        <td class="infoCol" id="cr3"></td>
                        <td class="infoCol disabled" id="demar3"></td>
                    </tr>
                                    <tr class="subtotal">
                        <td class="bold">Resistance 2</td>
                        <td class="infoCol" id="br2"></td>
                        <td class="infoCol" id="wr2"></td>
                        <td class="infoCol" id="cr2"></td>
                        <td class="infoCol disabled" id="demar2"></td>
                    </tr>
                                    <tr class="subtotal">
                        <td class="bold">Resistance 1</td>
                        <td class="infoCol" id="br1"></td>
                        <td class="infoCol" id="wr1"></td>
                        <td class="infoCol" id="cr1"></td>
                        <td class="infoCol" id="demar1"></td>
                    </tr>
                                    <tr class="subtotal">
                        <td class="bold">Pivot Point</td>
                        <td class="infoCol" id="bp"></td>
                        <td class="infoCol" id="wp"></td>
                        <td class="infoCol disabled" id="cp"></td>
                        <td class="infoCol disabled" id="demap"></td>
                    </tr>
                                    <tr class="subtotal">
                        <td class="bold">Support 1</td>
                        <td class="infoCol" id="bs1"></td>
                        <td class="infoCol" id="ws1"></td>
                        <td class="infoCol" id="cs1"></td>
                        <td class="infoCol" id="demas1"></td>
                    </tr>
                                    <tr class="subtotal">
                        <td class="bold">Support 2</td>
                        <td class="infoCol" id="bs2"></td>
                        <td class="infoCol" id="ws2"></td>
                        <td class="infoCol" id="cs2"></td>
                        <td class="infoCol disabled" id="demas2"></td>
                    </tr>
                                    <tr class="subtotal">
                        <td class="bold">Support 3</td>
                        <td class="infoCol" id="bs3"></td>
                        <td class="infoCol disabled" id="ws3"></td>
                        <td class="infoCol" id="cs3"></td>
                        <td class="infoCol disabled" id="demas3"></td>
                    </tr>
                                    <tr class="subtotal subrow">
                        <td class="bold">Support 4</td>
                        <td class="infoCol disabled" id="bs4"></td>
                        <td class="infoCol disabled" id="ws4"></td>
                        <td class="infoCol" id="cs4"></td>
                        <td class="infoCol disabled" id="demas4"></td>
                    </tr>
                                </tbody>
            </table>
        </div>




    </form>

    <script>
    $("#pivotcal").click(function(){
            $("#loader").fadeIn("fast").fadeOut();

            var c = +$("#HRate").val();

            var f = +$("#LRate").val();

            var h = +$("#CRate").val();

            var e = +$("#ORate").val();


                var k = ((c+f)+h)/3;

                var g, a;
                g = 2 * k - c;
                bres1 = 2 * k - f;
                $("#br3").text(c + 2 * (k - f));
                $("#br2").text(k + (bres1 - g));
                $("#br1").text(bres1);
                $("#bp").text(k);
                $("#bs1").text(g);
                $("#bs2").text(k - (bres1 - g));
                $("#bs3").text(f - 2 * (c - k));
                var d = (c + f + (2 * h) / 4);
                $("#wr1").text((2 * d) - f);
                $("#wr2").text(d + c - f);
                $("#wp").text(d);
                $("#ws1").text((2 * d) - c);
                $("#ws2").text((d - c) + f);
                $("#cr1").text(h + ((c - f) * (1.1 / 12)));
                $("#cr2").text(h + ((c - f) * (1.1 / 6)));
                $("#cr3").text(h + ((c - f) * (1.1 / 4)));
                $("#cr4").text(h + ((c - f) * (1.1 / 2)));
                $("#cs1").text(h - ((c - f) * (1.1 / 12)));
                $("#cs2").text(h - ((c - f) * (1.1 / 6)));
                $("#cs3").text(h - ((c - f) * (1.1 / 4)));
                $("#cs4").text(h - ((c - f) * (1.1 / 2)));
                var b;
                if (h < e) {
                    b = (c + (f * 2) + h)
                }
                if (h > e) {
                    b = ((c * 2) + f + h)
                }
                if (h == e) {
                    b = (c + f + (h * 2))
                }
                $("#demar1").text(b / 2) - f;
                $("#demas1").text(b / 2) - c;

        });

        jQuery(document).ready( function() {
            jQuery('#calc_form input').keypress(function(event) { if (event.keyCode == 13) { pivot_calc(); return false; } });
        });

    </script>
</div>


  </body>

</html>
