<?php

use AspectMock\Test;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
		$app = require __DIR__.'/../bootstrap/app.php';

		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

		return $app;
	}

	public function setUp()
	{
		parent::setUp();

		// disabling csrf protection in test mode
		Test::double(VerifyCsrfToken::class, [
			'tokensMatch' => true
		]);
	}

	public function tearDown()
	{
		parent::tearDown();

		Test::clean();
	}
}
