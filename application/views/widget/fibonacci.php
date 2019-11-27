<html>

<head>
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700,800,900" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

  <script>
  function unFormatNoFloat(selector) {
		if ($(selector).attr('number-format') == 'eu') {
			return $(selector).val().replace(/,/g, '.');
		}
		return $(selector).val();
	}

$( "#uptending" ).click(function() {

		var A = unFormatNoFloat('#uplow') * 1;
		var B = unFormatNoFloat('#uphigh') * 1;
		var C = unFormatNoFloat('#upcustom');
		var customValSelector = C ? ',#upcustom' : '';
		if (B > A) {

			var pips = B - A;
			var ret1 = B - (pips * 0.236);
			var ret2 = B - (pips * 0.382);
			var ret3 = B - (pips * 0.5);
			var ret4 = B - (pips * 0.618);
			var ret5 = B - (pips * 0.764);
			var ret6 = B - (pips * 1);
			var ret7 = B - (pips * 1.382);

			var ext1 = B + (pips * 2.618);
			var ext2 = B + (pips * 2);
			var ext3 = B + (pips * 1.618);
			var ext4 = B + (pips * 1.382);
			var ext5 = B + (pips * 1);
			var ext6 = B + (pips * 0.618);
			var ext7 = B + (pips * 0.5);
			var ext8 = B + (pips * 0.382);
			var ext9 = B + (pips * 0.236);


			if (C.length > 0) {
				C = C * 1;
				ext1 = C + (pips * 2.618);
				ext2 = C + (pips * 2);
				ext3 = C + (pips * 1.618);
				ext4 = C + (pips * 1.382);
				ext5 = C + (pips * 1);
				ext6 = C + (pips * 0.618);
				ext7 = C + (pips * 0.5);
				ext8 = C + (pips * 0.382);
				ext9 = C + (pips * 0.236);

			}


			$("table#upRetrace td#result1").text(B);
			$("table#upRetrace td#result2").text(ret1);
			$("table#upRetrace td#result3").text(ret2);
			$("table#upRetrace td#result4").text(ret3);
			$("table#upRetrace td#result5").text(ret4);
			$("table#upRetrace td#result6").text(ret5);
			$("table#upRetrace td#result7").text(A);
			$("table#upRetrace td#result8").text(ret7);

			$("table#upExten td#result1").text(ext1, 5);
			$("table#upExten td#result2").text(ext2, 5);
			$("table#upExten td#result3").text(ext3, 5);
			$("table#upExten td#result4").text(ext4, 5);
			$("table#upExten td#result5").text(ext5, 5);
			$("table#upExten td#result6").text(ext6, 5);
			$("table#upExten td#result7").text(ext7, 5);
			$("table#upExten td#result8").text(ext8, 5);
			$("table#upExten td#result9").text(ext9, 5);

		}
		else {

			ShowError("#uphigh");
			ShowError("#uplow");


		}
	});


	function downtrend_calculator() {
		$("#downloader img").fadeIn('fast').fadeOut();
		HideError("#downhigh");
		HideError("#downlow");

		var A = unFormatNoFloat("#downhigh") * 1;
		var B = unFormatNoFloat("#downlow") * 1;
		var C = unFormatNoFloat("#downcustom");
		var customValSelector = C ? ',#downcustom' : '';

		if (validateNumeric("#downlow,#downhigh" + customValSelector) && A > B) {
			var pips = A - B;
			var ret1 = B + (pips * 0.236);
			var ret2 = B + (pips * 0.382);
			var ret3 = B + (pips * 0.5);
			var ret4 = B + (pips * 0.618);
			var ret5 = B + (pips * 0.764);
			var ret6 = B + (pips * 1);
			var ret7 = B + (pips * 1.382);


			var ext1 = B - (pips * 2.618);
			var ext2 = B - (pips * 2);
			var ext3 = B - (pips * 1.618);
			var ext4 = B - (pips * 1.382);
			var ext5 = B - (pips * 1);
			var ext6 = B - (pips * 0.618);
			var ext7 = B - (pips * 0.500);
			var ext8 = B - (pips * 0.382);
			var ext9 = B - (pips * 0.236);


			if (C.length > 0) {
				C = C * 1;
				ext1 = C - (pips * 2.618);
				ext2 = C - (pips * 2);
				ext3 = C - (pips * 1.618);
				ext4 = C - (pips * 1.382);
				ext5 = C - (pips * 1);
				ext6 = C - (pips * 0.618);
				ext7 = C - (pips * 0.500);
				ext8 = C - (pips * 0.382);
				ext9 = C - (pips * 0.236);

			}


			$("table#downRetrace td#result1").text(formatNumber(toFixed(ret7, 5)));
			$("table#downRetrace td#result2").text(formatNumber(toFixed(A, 5)));
			$("table#downRetrace td#result3").text(formatNumber(toFixed(ret5, 5)));
			$("table#downRetrace td#result4").text(formatNumber(toFixed(ret4, 5)));
			$("table#downRetrace td#result5").text(formatNumber(toFixed(ret3, 5)));
			$("table#downRetrace td#result6").text(formatNumber(toFixed(ret2, 5)));
			$("table#downRetrace td#result7").text(formatNumber(toFixed(ret1, 5)));
			$("table#downRetrace td#result8").text(formatNumber(toFixed(B, 5)));


			$("table#downExten td#result1").text(formatNumber(toFixed(ext9, 5)));
			$("table#downExten td#result2").text(formatNumber(toFixed(ext8, 5)));
			$("table#downExten td#result3").text(formatNumber(toFixed(ext7, 5)));
			$("table#downExten td#result4").text(formatNumber(toFixed(ext6, 5)));
			$("table#downExten td#result5").text(formatNumber(toFixed(ext5, 5)));
			$("table#downExten td#result6").text(formatNumber(toFixed(ext4, 5)));
			$("table#downExten td#result7").text(formatNumber(toFixed(ext3, 5)));
			$("table#downExten td#result8").text(formatNumber(toFixed(ext2, 5)));
			$("table#downExten td#result9").text(formatNumber(toFixed(ext1, 5)));

		}
		else {
			ShowError("#downhigh");
			ShowError("#downlow");
		}
	}

	$(document).ready(function () {
		$('#uptrendform input').keypress(function (event) {
			if (event.keyCode == 13) {
				uptrend_calculator();
				return false;
			}
		});
		$('#downtrendform input').keypress(function (event) {
			if (event.keyCode == 13) {
				downtrend_calculator();
				return false;
			}
		});
	});

  </script>


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
    width: 100%;
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

.fibonacci input {
    padding: 12px;
    width: 19%;
    float: left;
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

.calcToolContainer{
  padding: 0px 15px;
  width: 100%;
  float: left;
  background: #f0f0f2
}
  </style>
</head>
  <body>

    <div class="fibonacci">
      <div class="newToolContainer calcToolContainer">
	<form onsubmit="return false;" id="fibonacci_uptrend" name="fibonacci_uptrend" number-format="us">
		<div class="fibonacciBox">
			<h3>Uptrend</h3>

			<div class="inner">
				<label>High <span class="fibnoacciBlue">(b)</span></label>
				<input type="text" name="uphigh" id="uphigh" class="newInput inputTextBox" number-format="us">
				<label>Low <span class="fibnoacciGold">(a)</span></label>
				<input type="text" name="uplow" id="uplow" class="newInput inputTextBox" number-format="us">
				<label>Custom <span class="fibnoacciOrange">(c)</span></label>
				<input type="text" name="upcustom" id="upcustom" class="newInput inputTextBox" number-format="us">
				<a id="uptending" href="javascript:void(0);" class="newBtn Arrow LightGray">Calculate</a>				<div class="clear"></div>
			</div>
		</div>
		<div class="result-div">
      <div class="fib-split">
        <table id="upRetrace">
        <thead>
        <tr>
          <th colspan="2">Retracements</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>0% (b)</td>
          <td id="result1"></td>
        </tr>
        <tr>
          <td>23.6%</td>
          <td id="result2"></td>
        </tr>
        <tr>
          <td>38.2%</td>
          <td id="result3"></td>
        </tr>
        <tr>
          <td>50%</td>
          <td id="result4"></td>
        </tr>
        <tr>
          <td>61.8%</td>
          <td id="result5"></td>
        </tr>
        <tr>
          <td>76.4%</td>
          <td id="result6"></td>
        </tr>
        <tr>
          <td>100% (a)</td>
          <td id="result7"></td>
        </tr>
        <tr>
          <td>138.2%</td>
          <td id="result8"></td>
        </tr><tr>
        </tr></tbody>
        </table>
      </div>
      <div class="fib-split">

  		<table id="upExten">
  		<thead>
  		<tr>
  			<th colspan="2">Extentions</th>
  		</tr>
  		</thead>
  		<tbody>
  		<tr>
  			<td>261.8%</td>
  			<td id="result1"></td>
  		</tr>
  		<tr>
  			<td>200%</td>
  			<td id="result2"></td>
  		</tr>
  		<tr>
  			<td>161.8%</td>
  			<td id="result3"></td>
  		</tr>
  		<tr>
  			<td>138.2%</td>
  			<td id="result4"></td>
  		</tr>
  		<tr>
  			<td>100%</td>
  			<td id="result5"></td>
  		</tr>
  		<tr>
  			<td>61.8%</td>
  			<td id="result6"></td>
  		</tr>
  		<tr>
  			<td>50%</td>
  			<td id="result7"></td>
  		</tr>
  		<tr>
  			<td>38.2%</td>
  			<td id="result8"></td>
  		</tr>
  		<tr>
  			<td>23.6%</td>
  			<td id="result9"></td>
  		</tr>
  		</tbody>
  		</table>

    </div>
    </div>



	</form>

	<form onsubmit="return false;" id="fibonacci_downtrend" name="fibonacci_downtrend" number-format="us">
		<div class="fibonacciBox">
			<h3>Downtrend</h3>

			<div class="inner">
				<label>High <span class="fibnoacciGold">(a)</span></label>
				<input type="text" name="downhigh" id="downhigh" class="newInput inputTextBox" number-format="us">
				<label>Low <span class="fibnoacciBlue">(b)</span></label>
				<input type="text" name="downlow" id="downlow" class="newInput inputTextBox" number-format="us">
				<label>Custom <span class="fibnoacciOrange">(c)</span></label>
				<input type="text" name="downcustom" id="downcustom" class="newInput inputTextBox" number-format="us">
				<a href="javascript:void(0);" onclick="downtrend_calculator();" class="newBtn Arrow LightGray">Calculate</a>				<div class="clear"></div>
			</div>
		</div>
    <div class="result-div">
      <div class="fib-split">
		<table id="downRetrace">
		<thead>
		<tr>
			<th colspan="2">Retracements</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>138.2%</td>
			<td id="result1"></td>
		</tr>
		<tr>
			<td>100% (a)</td>
			<td id="result2"></td>
		</tr>
		<tr>
			<td>76.4%</td>
			<td id="result3"></td>
		</tr>
		<tr>
			<td>61.8%</td>
			<td id="result4"></td>
		</tr>
		<tr>
			<td>50%</td>
			<td id="result5"></td>
		</tr>
		<tr>
			<td>38.2%</td>
			<td id="result6"></td>
		</tr>
		<tr>
			<td>23.6%</td>
			<td id="result7"></td>
		</tr>
		<tr>
			<td>0% (b)</td>
			<td id="result8"></td>
		</tr>
		</tbody>
		</table>
    </div>
    <div class="fib-split">

		<table id="downExten">
		<thead>
		<tr>
			<th colspan="2">Extentions</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>23.6%</td>
			<td id="result1"></td>
		</tr>
		<tr>
			<td>38.2%</td>
			<td id="result2"></td>
		</tr>
		<tr>
			<td>50%</td>
			<td id="result3"></td>
		</tr>
		<tr>
			<td>61.8%</td>
			<td id="result4"></td>
		</tr>
		<tr>
			<td>100%</td>
			<td id="result5"></td>
		</tr>
		<tr>
			<td>138.2%</td>
			<td id="result6"></td>
		</tr>
		<tr>
			<td>161.8%</td>
			<td id="result7"></td>
		</tr>
		<tr>
			<td>200%</td>
			<td id="result8"></td>
		</tr>
		<tr>
			<td>261.8%</td>
			<td id="result9"></td>
		</tr>
		</tbody>
		</table>
    </div>
    </div>

	</form>
</div>
    </div>


  </body>

</html>
