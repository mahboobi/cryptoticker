<?php

$config['expiry']['2015'] = array('29JAN2015', '26FEB2015', '26MAR2015', '30APR2015', '28MAY2015', '25JUN2015', '23JUL2015', '27AUG2015', '24SEP2015', '22OCT2015', '26NOV2015', '31DEC2015');

$config['expiry']['2017'] = array('23FEB2017', '30MAR2017', '27APR2017');


$config['list'] = array(
	'ALBK', 'ANDHRABANK', 'AXISBANK', 'BANKBARODA', 'BANKINDIA', 'CANBK', 'FEDERALBNK', 'HDFCBANK', 'ICICIBANK', 'IDBI', 
	'INDUSINDBK', 'IOB', 'KOTAKBANK', 'KTKBANK', 'PNB', 'ORIENTBANK', 'SBIN',  'SYNDIBANK', 'UCOBANK', 'UNIONBANK', 'YESBANK',

	'INFY', 'HCLTECH', 'MINDTREE', 'TCS', 'TECHM', 'WIPRO', 

	'AMTEKAUTO', 'APOLLOTYRE', 'ASHOKLEY', 'BAJAJ-AUTO',  'HEROMOTOCO', 'M&M', 'MARUTI', 'MRF', 'TVSMOTOR', 'TATAMOTORS',

	'AUROPHARMA', 'BIOCON', 'CIPLA', 'DABUR', 'DIVISLAB', 'DRREDDY', 'GLENMARK', 'LUPIN', 'RANBAXY', 'STAR', 'SUNPHARMA', 'WOCKPHARMA',

	'BHARTIARTL', 'IDEA', 'RCOM', 'TATACOMM',

	'BPCL', 'HINDPETRO', 'IOC', 'ONGC', 'PETRONET', 'RELIANCE', 

	'DLF', 'ADANIENT', 'JSWENERGY', 'IBREALEST', 'ITC',
	'EXIDEIND', 'JUSTDIAL', 'HAVELLS',  'TATASTEEL', 'APOLLOHOSP',
	'LT', 'VOLTAS', 'JINDALSTEL', 'BHEL', 'HINDALCO', 'HINDUNILVR',
	'CESC',  'COALINDIA', 'COLPAL', 'CROMPGREAV', 
	'DISHTV' 
	);

$config['list1'] = array(
	'ABIRLANUVO', 'ACC', 'ADANIPORTS', 'ADANIPOWER',  'AMBUJACEM',  
	'ARVIND',  'ASIANPAINT', 
	'BATAINDIA', 'BHARATFORG', 'BOSCHLTD', 'CAIRN',
	'CENTURYTEX',  
	'EICHERMOT', 'ENGINERSIN', 'GAIL', 'GMRINFRA', 'GODREJIND', 'GRASIM', 
	'HDFC', 'HDIL', 'HEXAWARE', 'HINDZINC', 
	'IBULHSGFIN', 'IDFC', 'IFCI', 'IGL', 'INDIACEM', 
	'IRB',   'JISLJALEQS', 'JPASSOCIAT', 'JPPOWER', 'JSWSTEEL', 'JUBLFOOD', 'L&TFH',
	'LICHSGFIN', 'M&MFIN', 'MCLEODRUSS',  'MOTHERSUMI', 
	'NHPC', 'NMDC', 'NTPC', 'OFSS', 'PFC',  'POWERGRID', 'PTC',  
	'RECLTD', 'RELCAPITAL', 'RELINFRA', 'RPOWER', 'SAIL', 'SIEMENS', 'SRTRANSFIN', // 'SKSMICRO' 'SSLT', 
	'SUNTV', 'TATACHEM', 'TATAGLOBAL',  'TATAMTRDVR', 'TATAPOWER', 
	'TITAN', 'UBL', 'ULTRACEMCO', 'UNITECH', 
	'UPL',
	'ZEEL'

	);

$config['urls']['nse'] = 'http://www.nse-india.com/charts/webtame/tame_intraday_getQuote_closing_redgreen.jsp?CDSymbol={symbol}&Segment=CM&Series=EQ&CDExpiryMonth=&FOExpiryMonth=&IRFExpiryMonth=&CDDate1=&CDDate2=&PeriodType=2&Periodicity=1&Template=tame_intraday_getQuote_closing_redgreen.jsp';
$config['urls']['nse_nifty'] = 'http://www.nseindia.com/charts/webtame/tame_intraday_home_indices_closing_redgreen.jsp?CDSymbol=CNX%20NIFTY&Segment=OI&Series=EQ&CDExpiryMonth=&FOExpiryMonth=&IRFExpiryMonth=&CDDate1=&CDDate2=&PeriodType=2&Periodicity=1&Template=tame_intraday_home_indices_closing_redgreen.jsp';
$config['urls']['nse_bank'] = 'http://www.nseindia.com/charts/webtame/tame_intraday_home_indices_closing_redgreen.jsp?CDSymbol=BANK%20NIFTY&Segment=OI&Series=EQ&CDExpiryMonth=&FOExpiryMonth=&IRFExpiryMonth=&CDDate1=&CDDate2=&PeriodType=2&Periodicity=1&Template=tame_intraday_home_indices_closing_redgreen.jsp';
$config['urls']['nse_option_chain'] = 'http://nseindia.com/live_market/dynaContent/live_watch/option_chain/optionKeys.jsp?segmentLink=17&rand='.rand(1000,9999); // &instrument=OPTIDX&symbol=NIFTY&date=26FEB2015
$config['urls']['nse_live'] = 'http://nseindia.com/live_market/dynaContent/live_analysis/changePercentage.json?rand='.rand(1000,9999); // http://nseindia.com/live_market/dynaContent/live_market.htm';
//$config['urls']['historic'] = 'http://nseindia.com/products/dynaContent/equities/equities/histscrip.jsp?symbolCode=2622&segmentLink=3&symbolCount=2&series=EQ&dateRange=+&dataType=PRICEVOLUMEDELIVERABLE'; // fromDate=01-02-2015&toDate=09-02-2015&symbol=DLF
$config['urls']['nse_historic_eq'] = 'http://nseindia.com/products/dynaContent/common/productsSymbolMapping.jsp?segmentLink=3&symbolCount=2&series=ALL&dateRange=+&dataType=PRICEVOLUMEDELIVERABLE'; // &fromDate=01-02-2015&toDate=09-02-2015&symbol=dlf
$config['urls']['nse_historic_index'] = 'http://nseindia.com/products/dynaContent/equities/indices/historicalindices.jsp?'; // indexType=CNX%20BANK&fromDate=01-02-2015&toDate=10-02-2015

$config['ticks']['dlf'] = '';


$config['option_chain_col_map'] = array(1 => 'ce_oi', 'ce_oi_chg', 'ce_vol', 'ce_iv', 'ce_ltp', 'ce_net_chg', 'ce_bid_qty', 'ce_bid_p', 'ce_ask_p', 'ce_ask_qty', 'sp', 
	'pe_bid_qty', 'pe_bid_p', 'pe_ask_p', 'pe_ask_qty', 'pe_net_chg', 'pe_ltp', 'pe_iv', 'pe_vol', 'pe_oi_chg', 'pe_oi');

$config['eq_historic_col_map'] = array(0=>'symbol', 2=>'date', 4=>'open', 'high', 'low', 'last', 'close', 'vwap', 'traded_qty', 'turnover', 'trades', 'delivery_qty', 'per_dly_traded_qty');

$config['index_historic_col_map'] = array('date', 'open', 'high', 'low', 'close', 'traded_qty', 'turnover');
//$config['eq_index_list'] = array('NIFTY', 'BANKNIFTY', 'AUTO', 'ENERGY', 'FINANCE', 'FMCG', 'IT', 'MEDIA', 'METAL', 'PHARMA', 'PSU BANK', 'REALTY', 'MIDCAP', 'SMALLCAP', 'COMMODITIES', 'CONSUMPTION', 'INFRA', 'MNC', 'PSE', 'SERVICE');

$config['eq_index_list'] = array('NIFTY', 'BANKNIFTY', 'AUTO', 'ENERGY', 'FIN SERVICE', 'FMCG', 'IT', 'MEDIA', 'METAL', 'PHARMA', 'PVT BANK', 'PSU BANK', 'REALTY', 'MIDCAP 50', 'COMMODITIES', 'CONSUMPTION', 'INFRA', 'MNC', 'PSE', 'SERV SECTOR');

