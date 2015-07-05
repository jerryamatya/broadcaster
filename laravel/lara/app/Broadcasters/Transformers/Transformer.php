<<<<<<< HEAD
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
=======
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
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
}