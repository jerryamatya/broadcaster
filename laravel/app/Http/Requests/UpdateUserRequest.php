<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'=>'required',
			'password'=>'required_with:changepass|min:6|same:password_confirmation'
		];
	}
	public function messages()
	{
		return [
			'password.required_with'=>"The password field is required"
		];
	}

}
