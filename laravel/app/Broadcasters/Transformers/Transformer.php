<?php
namespace Broadcasters\Transformers;

/**
* Tranformer abstration
*/
abstract class Transformer
{
	public function transformCollection(array $items, $callback=null)
	{
		$callback = $callback?$callback:"transform";
		return array_map([$this,$callback], $items);
	}
	public abstract function transform($item);
}