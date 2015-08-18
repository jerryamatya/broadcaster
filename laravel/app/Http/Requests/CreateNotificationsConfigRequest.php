<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateNotificationsConfigRequest  extends Request {

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
			//'broadcaster_id'=>'required',
			'config.parse_keys.appId'=>'required',
			'config.parse_keys.clientId'=>'required',
			'config.parse_keys.restId'=>'required',
		];
	}

}
