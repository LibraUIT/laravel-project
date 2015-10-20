<form method="post" class="form-block " action="{{ $form_action }}">
	{!!Form::token()!!}
	
	@if (session('success_message'))
	<span class="help-inline"><label for="success_meassage" class="success"><i class="fa fa-exclamation-circle"></i>&nbsp;{{ session('success_message') }}</label></span>
	@endif
	<input name="email" type="text" value="" placeholder="{{ trans('form.text_email') }}" id="username" />
	@if ($errors->has('email'))
	<span class="help-inline"><label for="email" class="error"><i class="fa fa-exclamation-circle"></i>&nbsp;{{$errors->first('email', ':message')}}</label></span>
	@endif
	<input name="password" type="password" value="" placeholder="{{ trans('form.text_password') }}" id="password" />
	@if ($errors->has('password'))
	<span class="help-inline"><label for="password" class="error"><i class="fa fa-exclamation-circle"></i>&nbsp;{{$errors->first('password', ':message')}}</label></span>
	@endif
	<button class="col-sm-6 btn btn-customer-submit">{{ trans('form.button_sign_in')}}</button>
	<span class="col-sm-6 link"><a href="{{$forgot_url}}">{{ trans('form.text_link_forgot')}}</a></span>
</form>