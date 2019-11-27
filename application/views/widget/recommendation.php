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

	.recommendation{
		background: #fff;
box-shadow: 0px 0px 3px #333;
margin: 16px 0px;
float: left;
width: 100%;
	}

	.recommendation .column-tabs{
		width: 10%;
float: left;
	}

	.column-tabs ul{
		list-style: none;
    margin: 0px 16px 0px 0px;
	}

	.column-tabs ul li{
		width: 100%;
background: #e0e0e0;
margin: 10px 0px;
text-align: center;
	}

	.full-right{
		float: left;
width: 90%;
	}

	.col-recommendation, .moving-table{
		width: 100%;
    float: left;
	}

	.grey-coin{
		float: left;
width: 90%;
background: #f0f0f2;
padding: 10px;
	}

	.grey-coin h2{
    font-size: 59px;
      float: left;
      margin: 0px;
	}

	.details-right{
		float: right;
        text-align: right;
	}

	.details-right h3{
    font-size: 28px;
    margin-top: 10px;
    margin-bottom: 0px;
	}

.details-right .date{
	color: #989797;
}
.trade-icon{
	width: 9%;
padding: 10px;
float: left;
}
.final-summary{
  float: left;
  border: 1px solid #ddd;
  width: 100%;
  padding: 10px;
}
.final-summary p{
	margin: 0px;
}

.final-summary .sell{
	background: #d02222;
  color: #fff;
  padding: 7px 22px;
  border-radius: 94px;
}

.final-summary .buy{
	background: #22d02b;
	color: #fff;
  padding: 7px 22px;
  border-radius: 94px;
}
.final-summary .neutral{
	background: #d08622;
	color: #fff;
	padding: 7px 22px;
	border-radius: 94px;
}

    table{
          width: 100%;
    }

    table td{
      border:1px solid #ddd;
    }
    lcToolContainer{
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

    <div class="recommendation">
      <div class="column-tabs">
        <ul>
          <li class="active">
            <a href="#">BTC</a>
          </li>
          <li>
            <a href="#">ETH</a>
          </li>
          <li>
            <a href="#">BCH</a>
          </li>
          <li>
            <a href="#">IOTA</a>
          </li>
          <li>
            <a href="#">XRP</a>
          </li>
          <li>
            <a href="#">LTC</a>
          </li>
          <li>
            <a href="#">BCG</a>
          </li>
          <li>
            <a href="#">XRM</a>
          </li>
          <li>
            <a href="#">XEM</a>
          </li>
        </ul>
      </div>
      <div class="full-right">

      <div class="col-recommendation">
        <div class="grey-coin">
          <h2>BTC</h2>
          <div class="details-right">
            <h3>$21,121.22</h3>
            <span class="date">Nov 11, 2017 23:33</span>
          </div>
        </div>

      </div>
      <div class="final-summary">
        <p>
          SUMMARY : <span class="sell">STRONG: SELL</span>
        </p>
      </div>
      <div class="moving-table">
        <table>
          <tr>
            <td>
              Moving Average
            </td>
            <td>
              Buy (4)
            </td>
            <td>
              Sell (10)
            </td>
          </tr>
          <tr>
            <td>
              Indicators
            </td>
            <td>
              Buy (0)
            </td>
            <td>
              Sell (5)
            </td>
          </tr>
        </table>
      </div>
      <div class="pivot-table">
        <table>
          <tr>
            <td>
              S3
            </td>
            <td>
              S1
            </td>
            <td>
              S1
            </td>
            <td>
              <a href="#">Pivot Points</a>
            </td>
            <td>
              R1
            </td>
            <td>
              R2
            </td>
            <td>
              R3
            </td>

          </tr>
        </table>
      </div>
      <div class="timeframe">

      </div>
    </div>
  </div>


  </body>

</html>
