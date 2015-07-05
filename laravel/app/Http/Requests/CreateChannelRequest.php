<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateChannelRequest extends Request {

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
			'local_source'=>'required_without:cdn_source',
			'country_id'=>'required'
		];
	}
	public function messages()
	{
		return [
		'broadcaster_id.required'=>'The broadcaster field is required',
		'local_source.required_without'=>'local url or cdn url is required'
		];
	}

}
