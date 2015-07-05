<<<<<<< HEAD
<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateLiveTvRequest extends Request {

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
			'broadcaster_id'=>'required',
			'name'=>'required',
			'country_id'=>'required'
		];
	}
	public function messages()
	{
		return [
		'broadcaster_id.required'=>'The broadcaster field is required'
		];
	}

}
=======
<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateLiveTvRequest extends Request {

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
			'broadcaster_id'=>'required',
			'name'=>'required',
			'country_id'=>'required'
		];
	}
	public function messages()
	{
		return [
		'broadcaster_id.required'=>'The broadcaster field is required'
		];
	}

}
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
