<form method="post" class="form-block " action="{{ $form_action }}">
	{!!Form::token()!!}
	<input name="email" type="email" value="" placeholder="Email" id="email" />
	<span class="help-inline help-inline-out"><label for="email" class="error"><i class="fa fa-exclamation-circle"></i>&nbsp;Please enter your email</label></span>
	<button class="col-sm-6 btn btn-customer-submit">Submit</button>
	<span class="col-sm-6 link"><a href="{{$sign_up_url}}">Join Now !</a></span>
</form>