<?php

class InstagramTest extends PHPUnit_Framework_TestCase {

	protected $instagram;

	private $clientId = 'myawesomeclientidentifier';

	private $clientSecret = 'myawesomeclientsecret';

	private $callbackUrl = '/callback/url';

	public function setUp()
	{
		$this->instagram = new Vinkla\Instagram\Instagram(
			$this->clientId,
			$this->clientSecret,
			$this->callbackUrl
		);
	}

	public function testThatInstagramIsInitiated()
	{
		$this->assertInstanceOf('MetzWeb\Instagram\Instagram', $this->instagram);
	}
}
