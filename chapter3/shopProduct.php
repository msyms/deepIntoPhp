<?php
class ShopProduct {
	public $title = 'default product';
	public $producerMainName = 'main name';
	public $producerFirstName = 'first name';
	public $price = 0;

	function __construct($title,$firstName,$mainName,$price) {
		$this->title = $title;
		$this->producerFirstName = $firstName;
		$this->producerMainName = $mainName;
		$this->price = $price;
	}
	function getProducer() {
		return "{$this->producerFirstName}".
			" {$this->producerMainName}";
	}
}

class ShopProductWriter {
	public function write( $ShopProduct ) {
		$str = "{$ShopProduct->title}: " .
				$ShopProduct->getProducer() .
				" ({$ShopProduct->price})\n";
		print $str;
	}
}
$product = new ShopProduct("my Class", "yin", "zhendong", 1.11);
$writer = new ShopProductWriter();
$writer->write( $product );
