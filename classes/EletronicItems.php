<?php

namespace App;

use App\ElectronicItem;
use App\EletronicTypesEnum;

class ElectronicItems
{
	/**
	 * @var array
	 */
	private $items = [];

	/**
	 * @param ElectronicItem $item
	 * @return void
	 */
	function addItem(ElectronicItem $item): void
	{
		$this->items[] = $item;
	}

	/**
	 * @return array
	 */
	function getItems(): array
	{
		return $this->items;
	}

	/**
	 * @return integer
	 */
	function getNumberOfItems(): int
	{
		return count($this->items);
	}

	/**
	 * @return float
	 */
	function getTotal(): float
	{
		$total = 0;
		foreach ($this->items as $EletronicItem) {
			$total += $EletronicItem->getTotalWithExtra();
		}

		return $total;
	}

	/**
	 * @param EletronicTypesEnum $type
	 * @return array
	 */
	function getItemsByType(EletronicTypesEnum $type): array
	{
		$callback = function ($item) use ($type) {
			return $item->getType() == $type->__toString();
		};
		return array_filter($this->items, $callback);
	}

	/**
	 * Get an array of sorted items by price (ASC)
	 * 
	 * @return array
	 */
	function getSortedItems(): array
	{
		$sorted = $this->getItems();
		usort($sorted, function ($EletronicA, $EletronicB) {
			return $EletronicA->getTotalWithExtra() > $EletronicB->getTotalWithExtra();
		});

		return $sorted;
	}

	/**
	 * @return array
	 */
	function toArray(): array
	{
		$retArray = [];

		$retArray['itemsNbr']   = $this->getNumberOfItems();
		$retArray['orderTotal'] = $this->getTotal();
		$retArray['items']      = [];

		$items = $this->getSortedItems();
		foreach ($items as $eletronicItem) {
			$retArray['items'][] = $eletronicItem->toArray();
		}

		return $retArray;
	}
}
