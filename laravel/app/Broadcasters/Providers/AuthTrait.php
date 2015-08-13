<?php
namespace Broadcasters\Providers;
trait AuthTrait{

	protected  static $user = null;
	protected static $broadcaster= null;

	public  static function getAuth()
	{
		self::$user = \Auth::user();
		if(self::$user){
			self::$broadcaster =self::$user->broadcaster;
		}
	}

	
}