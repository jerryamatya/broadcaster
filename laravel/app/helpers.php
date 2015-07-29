<?php
function setActive($path, $active="active")
{
	$prefix = \Auth::user()->role_id==1?"admin":"broadcaster";
	if($path=="/")
		return Request::is($path) ?$active:"";
	$path = $prefix.$path;
	return Request::is($path.'*') ?$active:"";

	
}
function setBroadcasterActive($path, $active="active")
{
	if($path=="/")
		return URL::route('broadcasterHome') === URL::current() ?$active:"";
	$path = "broadcaster".$path;
	return Request::is($path.'*') ?$active:"";

	
}
function getServicesNav($services)
{
	$items = null;
	foreach($services as $service){
		$active = setActive(getServiceSlug($service->name));
		$items .= '<li class="'.$active.'"><a href="'.getServiceLink($service->name).'">'.$service->name.'</a></li>';
	}
	return $items;
}

function getBroadcasterServicesNav($services)
{

	$items = null;
	foreach($services as $service){
		$active = setBroadcasterActive(getBroadcasterServiceSlug($service->name));
		$items .= '<li class="'.$active.'"><a href="'.getServiceLink($service->name).'">'.$service->name.'</a></li>';
	}
	return $items;
}
function getCollapse($services){
	foreach($services as $service){
		$active = setBroadcasterActive(getBroadcasterServiceSlug($service->name));
		if($active)
			return "in";
	}
	return "";
}

function getServiceSlug($name)
{
	$base = '/services/';
	return $base.getSlug($name);

}

function getBroadcasterServiceSlug($name){
	$base = '/services/';
	return $base.getSlug($name);
}
function getSlug($name)
{
	switch ($name) {
		case 'Live Tv':
		return 'channel';
		case 'News App':
		return 'newsapp';
		case 'News Blog':
		return 'news';
		case 'Vod':
		return 'vod';
		case 'profile':
		return 'profile';	
		default:
			# code...
		break;
	}
}

function getServiceLink($name){
	switch ($name) {
		case 'Live Tv':
		return route('bchannelList');
		case 'News App':
		return route('broadcasterHome');
		case 'News Blog':
		return route('newsList');
		case 'Vod':
		return route('bvodList');
		default:
			# code...
		break;
	}
}
function getDay($day)
{

	switch ($day) {
		case '1':
		return 'Sunday';
		case '2':
		return 'Monday';
		case '3':
		return 'Tuesday';
		case '4':
		return 'Wenesday';
		case '5':
		return 'Thrusday';
		case '6':
		return 'Friday';
		case '7':
		return 'Saturday';
		default:
			# code...
		break;
	}	
}
function getUrlSignature($key,$validminutes = 10)
{
	$validminutes = (int)$validminutes;
	$today = gmdate("n/j/Y g:i:s A");
	$ip = $_SERVER['REMOTE_ADDR'];
	$str2hash = $ip . $key . $today . $validminutes;
	$md5raw = md5($str2hash, true);
	$base64hash = base64_encode($md5raw);
	$urlsignature = "server_time=" . $today . "&hash_value=" . $base64hash . "&validminutes=$validminutes";
	return base64_encode($urlsignature);
}

