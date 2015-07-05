<<<<<<< HEAD
<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterBroadcastersRequest extends Request {

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
			'company_name'=>'required',
			'display_name'=>'required',
			'email'=>'required|email|unique:users',
			'password'=>'required|min:6|same:password_confirmation',
			''
		];
	}

}
=======
<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterBroadcastersRequest extends Request {

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
			'company_name'=>'required',
			'display_name'=>'required',
			'email'=>'required|email|unique:users',
			'password'=>'required|min:6|same:password_confirmation',
			''
		];
	}

}
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
