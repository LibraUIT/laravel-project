<form method="post" class="form-block " action="{{ $form_action }}">
	{!!Form::token()!!}

	@if(isset($error_message))
	<span class="help-inline"><label for="error_message" class="error"><i class="fa fa-exclamation-circle"></i>&nbsp;{{$error_message}}</label></span>
	@endif

	<input name="fullname" type="text" value="" placeholder="{{ trans('form.text_fullname') }}" />
	@if ($errors->has('fullname'))
	<span class="help-inline"><label for="fullname" class="error"><i class="fa fa-exclamation-circle"></i>&nbsp;{{$errors->first('fullname', ':message')}}</label></span>
	@endif
	<input name="email" type="text" value="" placeholder="{{ trans('form.text_email') }}" />
	@if ($errors->has('email'))
	<span class="help-inline"><label for="email" class="error"><i class="fa fa-exclamation-circle"></i>&nbsp;{{$errors->first('email', ':message')}}</label></span>
	@endif
	<input name="password" type="password" value="" placeholder="{{ trans('form.text_password') }}" />
	@if ($errors->has('password'))
	<span class="help-inline"><label for="password" class="error"><i class="fa fa-exclamation-circle"></i>&nbsp;{{$errors->first('password', ':message')}}</label></span>
	@endif
	<input name="password_confirmation" type="password" value="" placeholder="{{ trans('form.text_password_confirmation') }}" />
	@if ($errors->has('password_confirmation'))
	<span class="help-inline"><label for="password_confirmation" class="error"><i class="fa fa-exclamation-circle"></i>&nbsp;{{$errors->first('password_confirmation', ':message')}}</label></span>
	@endif
	<button class="col-sm-6 btn btn-customer-submit">{{ trans('form.button_sign_up') }}</button>
	<span class="col-sm-6 link"><a href="{{$sign_in_url}}">{{ trans('form.button_sign_up') }}</a></span>
</form>