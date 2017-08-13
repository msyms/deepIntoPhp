<?php
class ShopProduct {
	public $playLength;
	public $title;
	public $producerMainName;
	public $producerFirstName;
	public $price;

	function __construct($title, $firstName, $mainName, $price,
						$numPages=0, $playLength=0) {
		$this->title = $title;
		$this->producerFirstName = $firstName;
		$this->producerMainName = $mainName;
		$this->price = $price;
		$this->numPages = $numPages;
		$this->playLength = $playLength;
	}
}