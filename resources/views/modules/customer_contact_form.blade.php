				<form method="post" class="form-contact-us" action="{{$form_action}}">
					{!!Form::token()!!}
				    <label class="col-sm-11 no-padding">{{trans('form.text_email')}}</label>
				    <div class="col-sm-11 no-padding">
						<input value="{{$email}}" type="email" name="email" class="form-control" />
				    </div>
				    @if ($errors->has('email'))
					<span class="help-inline"><label for="email" class="error"><i class="fa fa-exclamation-circle"></i>&nbsp;{{$errors->first('email', ':message')}}</label></span>
					@endif
				    <label class="col-sm-11 no-padding">{{trans('form.text_title')}}</label>
				    <div class="col-sm-11 no-padding">
						<input type="text" name="title" class="form-control" />
				    </div>
				    @if ($errors->has('title'))
					<span class="help-inline"><label for="title" class="error"><i class="fa fa-exclamation-circle"></i>&nbsp;{{$errors->first('title', ':message')}}</label></span>
					@endif
				    <label class="col-sm-11 no-padding">{{trans('form.text_message')}}</label>
				    <div class="col-sm-11 no-padding">
				    	<textarea name="message" class="form-control" rows="5"></textarea>
				    </div>
				    @if ($errors->has('message'))
					<span class="help-inline"><label for="message" class="error"><i class="fa fa-exclamation-circle"></i>&nbsp;{{$errors->first('message', ':message')}}</label></span>
					@endif
				    <div class="col-sm-11 no-padding">
				    	<button type="submit" class="btn btn-customer-submit">{{trans('form.button_send')}}</button>
				    </div>
				</form>