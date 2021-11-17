<?php

namespace ZerosDev\Durianpay\Services;

use ZerosDev\Durianpay\Client;
use ZerosDev\Durianpay\Traits\SetterGetter;
use ZerosDev\Durianpay\Constant;

class Orders
{
	use SetterGetter;
	
	public function __construct(Client $client) {
		$this->client = $client;
	}

	public function create() {

		$this->client->setRequestPayload([
			"amount" => $this->getAmount() ? $this->getAmount().".00" : null,
			"payment_option" => $this->getPaymentOption(),
			"currency" => $this->getCurrency(),
			"order_ref_id" => $this->getOrderRefId(),
			"customer" => $this->getCustomer(Constant::ARRAY),
			"items"	=> $this->getItems(Constant::ARRAY),
			"metadata" => $this->getMetadata(Constant::ARRAY)
		]);
		
		return $this->client->post('orders');
	}
}