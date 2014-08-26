<!-- This file can be modified and placed in your theme directory, The plugin will search for a file with this name there first and use it if it exists -->
<div class="B24_searchbox">
<div class="B24_searchbox_inner">

<div class="B24_searchitem B24_searchitem2">
<div class="B24checkintext"><?php echo $translate['Check In']; ?></div>
<div class="B24checkinselect">
<input type="hidden" id="fdate_lang" name="lang" value="<?php echo $lang ?>">
<input type="hidden" id="datepicker">

<select id="fdate_date" class="B24checkin_day" name="fdate_date">
<option value="0" class="B24checkin_day_text"><?php echo $translate['Day']; ?></option>
<?php for ($i=1; $i<=31; $i++) { ?>
<option <?php echo (isset($_REQUEST['fdate_date']) && $_REQUEST['fdate_date']==$i)?'selected="selected"':''; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
</select>

<select id="fdate_monthyear" class="B24checkin_month" name="fdate_monthyear">
<option value="0" class="B24checkin_month_text"><?php echo $translate['Month']; ?></option>
<?php $thismonthyear = date('Y-m-01'); ?>
<?php for ($i=0; $i<24; $i++) { ?>
<option <?php echo (isset($_REQUEST['fdate_monthyear']) && $_REQUEST['fdate_monthyear']==date('Y-m', strtotime('+ '.$i.' months')))?'selected="selected"':''; ?> value="<?php echo date('Y-m', strtotime($thismonthyear.' + '.$i.' months')) ?>"><?php echo $translate['month'.date('n', strtotime($thismonthyear.' + '.$i.' months'))] ?> <?php echo date('Y', strtotime($thismonthyear.' + '.$i.' months')) ?></option>
<?php } ?>
</select>
</div>
</div>

<div class="B24_searchitem B24_searchitem3">
<div class="B24checkouttext"><?php echo $translate['Nights']; ?></div>
<div class="B24checkoutselect">
<select class="B24nights" name="numnight">
<?php for ($i=1; $i<=31; $i++) { ?>
<option <?php echo (isset($_REQUEST['numnight']) && $_REQUEST['numnight']==$i)?'selected="selected"':''; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
</select>
</div>
</div>

<div class="B24_searchitem B24_searchitem4">
<div class="B24guesttext"><?php echo $translate['Guests']; ?></div>
<div class="B24cguestselect">
<select class="B24guest" name="numadult">
<?php for ($i=1; $i<=12; $i++) { ?>
<option <?php echo (isset($_REQUEST['numadult']) && $_REQUEST['numadult']==$i)?'selected="selected"':''; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
</select>
</div>
</div>

<div class="B24buttondiv">
<div class="B24button">
<input type="submit" value="<?php echo $translate['Search']; ?>">
</div>
</div>

<div class="B24clearboth"></div>
</div>			
</div>


