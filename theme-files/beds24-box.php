<!-- This file can be modified and placed in your theme directory, The plugin will search for a file with this name there first and use it if it exists -->
<div class="B24_searchbox">
<div class="B24_searchbox_inner">

<div class="B24_searchitem B24_searchitem2">
<div class="B24checkintext"><? echo $translate['Check In']; ?></div>
<div class="B24checkinselect">
<input type="hidden" id="fdate_lang" name="lang" value="<?php echo $lang ?>">
<input type="hidden" id="datepicker">

<select id="fdate_date" class="B24checkin_day" name="fdate_date">
<option value="0" class="B24checkin_day_text"><? echo $translate['Day']; ?></option>
<?php for ($i=1; $i<=31; $i++) { ?>
<option <?php echo ($_REQUEST['fdate_date']==$i)?'selected="selected"':''; ?> value="<? echo $i; ?>"><? echo $i; ?></option>
<?php } ?>
</select>

<select id="fdate_monthyear" class="B24checkin_month" name="fdate_monthyear">
<option value="0" class="B24checkin_month_text"><? echo $translate['Month']; ?></option>
<? $thismonthyear = date('Y-m-01'); ?>
<?php for ($i=0; $i<24; $i++) { ?>
<option <?php echo ($_REQUEST['fdate_monthyear']==date('Y-m', strtotime('+ '.$i.' months')))?'selected="selected"':''; ?> value="<? echo date('Y-m', strtotime($thismonthyear.' + '.$i.' months')) ?>"><? echo $translate['month'.date('n', strtotime($thismonthyear.' + '.$i.' months'))] ?> <? echo date('Y', strtotime($thismonthyear.' + '.$i.' months')) ?></option>
<?php } ?>
</select>
</div>
</div>

<div class="B24_searchitem B24_searchitem3">
<div class="B24checkouttext"><? echo $translate['Nights']; ?></div>
<div class="B24checkoutselect">
<select class="B24nights" name="numnight">
<?php for ($i=1; $i<=31; $i++) { ?>
<option <?php echo ($_REQUEST['numnight']==$i)?'selected="selected"':''; ?> value="<? echo $i; ?>"><? echo $i; ?></option>
<?php } ?>
</select>
</div>
</div>

<div class="B24_searchitem B24_searchitem4">
<div class="B24guesttext"><? echo $translate['Guests']; ?></div>
<div class="B24cguestselect">
<select class="B24guest" name="numadult">
<?php for ($i=1; $i<=12; $i++) { ?>
<option <?php echo ($_REQUEST['numadalt']==$i)?'selected="selected"':''; ?> value="<? echo $i; ?>"><? echo $i; ?></option>
<?php } ?>
</select>
</div>
</div>

<div class="B24buttondiv">
<div class="B24button">
<input type="submit" value="<? echo $translate['Search']; ?>">
</div>
</div>

<div class="B24clearboth"></div>
</div>			
</div>


