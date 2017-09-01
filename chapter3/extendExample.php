<?php
class ShopProduct {
	public $playLength;
	private $title;
	private $producerMainName;
	private $producerFirstName;
	protected $price;
	private $discount = 0;

	function __construct($title, $firstName, $mainName, $price,
						$numPages=0, $playLength=0) {
		$this->title = $title;
		$this->producerFirstName = $firstName;
		$this->producerMainName = $mainName;
		$this->price = $price;
		$this->numPages = $numPages;
		$this->playLength = $playLength;
	}

	public function getproducerFirstName(){
		return $this->producerFirstName;
	}

	public function getproducerMainName() {
		return $this->producerMainName;
	}

	public function setDiscount($num) {
		$this->discount = $num;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getPrice() {
		return ($this->price - $this->discount);
	}

	function getProducer() {
		return "{$this->producerFirstName} {$this->producerMainName}";
	}

	function getSummaryLine() {
		$base = "$this->title ( {$this->producerMainName},";
		$base .= "{$this->producerFirstName} )";
		return $base;
	}
}

class CdProduct extends ShopProduct {
	function getPlayLength() {
		return $this->playLength;
	}

	function getSummaryLine() {
		$base = parent::getSummaryLine();
		$base .= ": playing time -{$this->playLength}";
		return $base;
	}
}

class BookProduct extends ShopProduct {
	function getNumberOfPages() {
		return $this->numPages;
	}

	function getSummaryLine() {
		$base = parent::getSummaryLine();
		$base .= ": page count -{$this->numPages}";
		return $base;
	}
}