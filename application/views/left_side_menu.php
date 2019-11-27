        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li id="dp"><div style="float:left"><select id="symbolpicker" class="selectpicker" data-style="btn-success" onchange="go({symbol:this.value})" data-width="auto">
            <optgroup label="indices">
<?php 
  foreach($viewData['indices'] as $symbol):
?>
    <option <?php if($viewData['symbol']== $symbol): ?>selected="selected"<?php endif; ?>><?=$symbol?></option>
<?php
  endforeach;
?>
            </optgroup>
            <optgroup label="equities (FNO)">
<?php 
  foreach($viewData['symbols'] as $symbol):
?>
    <option <?php if($viewData['symbol']== $symbol): ?>selected="selected"<?php endif; ?>><?=$symbol?></option>
<?php
  endforeach;
?></optgroup>
    </select></div>
      <div class="input-group date" >
        <input id="datepicker" type="text" class="form-control" value="<?=$viewData['date']?>"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
        </div><div style=""clear:both></div></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li <?php if($viewData['page']=='fin'):?>class="active"<?php endif; ?>><a href="/fin/?date=<?=$viewData['date']?>">Overview <?php if($viewData['page']=='fin'):?><span class="sr-only">(current)</span><?php endif; ?></a></li>
            <li <?php if($viewData['page']=='optionChain'):?>class="active"<?php endif; ?>><a href="/fin/optionChain/?symbol=<?=chk($viewData['symbol'])?>&expiry=<?=chk($viewData['expiry'])?>&date=<?=$viewData['date']?>">Option chain <?php if($viewData['page']=='optionChain'):?><span class="sr-only">(current)</span><?php endif; ?></a></li>
            <li <?php if($viewData['page']=='optionChainTime'):?>class="active"<?php endif; ?>><a href="/fin/optionChainTime/?symbol=<?=chk($viewData['symbol'])?>&expiry=<?=chk($viewData['expiry'])?>&date=<?=$viewData['date']?>">Option chain timeline<?php if($viewData['page']=='optionChainTime'):?><span class="sr-only">(current)</span><?php endif; ?></a></li>
            <li <?php if($viewData['page']=='optionChainAtm'):?>class="active"<?php endif; ?>><a href="/fin/optionChainAtm/?symbol=<?=chk($viewData['symbol'])?>&expiry=<?=chk($viewData['expiry'])?>&date=<?=$viewData['date']?>">Option chain ATM timeline<?php if($viewData['page']=='optionChainAtm'):?><span class="sr-only">(current)</span><?php endif; ?></a></li>
            <li <?php if($viewData['page']=='historic'):?>class="active"<?php endif; ?>><a href="/fin/historic/?symbol=<?=chk($viewData['symbol'])?>">Historic EQ/Indices<?php if($viewData['page']=='historic'):?><span class="sr-only">(current)</span><?php endif; ?></a></li>
            <li <?php if($viewData['page']=='spread'):?>class="active"<?php endif; ?>><a href="/fin/spread">Bn/Nifty spread<?php if($viewData['page']=='spread'):?><span class="sr-only">(current)</span><?php endif; ?></a></li>
          </ul>
        </div>
<?php /*
<input type="text" id="datepicker" size="20" value="<?=$viewData['date']?>" readonly="readonly" />
</div>
<script>
$(function() {
	$( "#datepicker" ).datepicker({
        showOn: "both",
        dateFormat: "yy-mm-dd",
        buttonImage: "<?=$imagePath?>calendar.gif",
        buttonImageOnly: true,
        onSelect: function (dt){
            location.href = "/graph/?p=<?=$viewData['projectCode']?>&t=<?=$viewData['typeCode']?>&dt="+dt;
        }
    });
});
</script> 
*/ ?>