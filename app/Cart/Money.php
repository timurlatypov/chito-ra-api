<?php

namespace App\Cart;

use NumberFormatter;
use Money\Currency;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;

use Money\Parser\AggregateMoneyParser;
use Money\Parser\IntlMoneyParser;

use Money\Money as BaseMoney;

class Money
{
	protected $money;

	public function __construct ($value)
	{
		$this->money = new BaseMoney($value, new Currency('RUB'));
	}

	public function amount()
	{
		return $this->money->getAmount();
	}

	public function formatted()
	{
		$formatter = new IntlMoneyFormatter(
			new NumberFormatter('ru_RU', NumberFormatter::CURRENCY), new ISOCurrencies()
		);

		return $formatter->format($this->money);
	}

	public function add(Money $money)
	{
		$this->money = $this->money->add($money->instance());

		return $this;
	}

	public function instance()
	{
		return $this->money;
	}
}