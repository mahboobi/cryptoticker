    <form method="GET" action="" id="form">
        <input type="hidden" name="symbol" id="symbol" value="<?=chk($viewData['symbol'])?>">
        <input type="hidden" name="expiry" id="expiry" value="<?=chk($viewData['expiry'])?>">
        <input type="hidden" name="date" id="date" value="<?=chk($viewData['date'])?>">
        <input type="hidden" name="ts" id="ts" value="<?=chk($viewData['ts'])?>">
        <input type="hidden" name="hide_sp" id="hide_sp" value="<?=@implode(',', chk($viewData['hide_sp']))?>">
        <input type="hidden" name="sp" id="sp" value="<?=chk($viewData['sp'])?>">
    </form>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="/assets/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <link href="/assets/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <script>
    $('#dp .input-group.date').datepicker({ 
        //startDate: "01/05/2015",
        //endDate: "<?=date('m/d/Y')?>",
        format : 'yyyy-mm-dd', 
        autoclose: true, 
        todayHighlight: true
    	})
    .on('changeDate', function(e){
    	//location.href = "/fin/<?=$viewData['page']?>/?date=" + $('#datepicker').val();
        go({date:$('#datepicker').val()});
    });
        //$('#symbolpicker').selectpicker();
        function go(data){
            for(prop in data) $('#'+prop).val(data[prop]);
            $('#form').submit();
        }
    </script>
    <link href="/assets/bootstrap-datepicker/css/datepicker.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/assets/bootstrap-3.3.1-dist/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>