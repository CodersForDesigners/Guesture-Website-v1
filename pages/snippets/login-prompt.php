<?php
?>
<!-- Phone Trap form -->
<form class="js_phone_form" style="display: none">
	<div class="columns small-12 _medium-6 space-min-bottom" style="position: relative">
		<label><span class="label inline text-neutral-1 text-uppercase">Mobile Number</span></label>
		<div class="phone-trap minimal phone-number">
			<div class="block prefix-group" style="position: relative">
				<select class="js_phone_country_code" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0">
					<?php include __ROOT__ . '/pages/snippets/phone-country-codes.php' ?>
				</select>
				<input class="prefix js_phone_country_code_label button" value="+91" style="pointer-events: none; width: 100%;">
			</div>
			<input class="phone block" type="text" name="phone-number">
			<label class="submit block">
				<span class="hidden label inline text-neutral-1 text-uppercase">Submit</span>
				<button class="button block">→</button>
			</label>
		</div>
	</div>
</form>
<!-- OTP form -->
<form class="js_otp_form" style="display: none;">
	<div class="columns small-12 _medium-6">
		<div class="otp-trap minimal">
			<label class="block">
				<span class="label inline text-neutral-1 text-uppercase">Enter the OTP</span>
				<input class="otp block" type="text" name="otp">
			</label>
			<label class="submit block">
				<span class="invisible label inline text-neutral-1 text-uppercase">Submit</span>
				<button class="button block">→</button>
			</label>
		</div>
	</div>
	<br>
	<div class="columns small-12 clearfix hidden">
		<div class="label strong text-neutral-1 opacity-50 text-uppercase inline-middle cursor-pointer float-left" tabindex="-1">Re-send OTP</div>
		<div class="label strong text-neutral-1 opacity-50 text-uppercase inline-middle cursor-pointer float-right" tabindex="-1">Enter different number</div>
	</div>
</form>
