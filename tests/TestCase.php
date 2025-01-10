<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Http;

abstract class TestCase extends BaseTestCase
{
    protected $testBaseUrl = 'https://api.channelengine.test/api/v2';

    public function mockHttpResponse(string $path, string $fixture, int $statusCode){
        return Http::fake([
          $this->testBaseUrl .  $path . '*' => Http::response(file_get_contents(__DIR__ . '/fixtures/'. $fixture), $statusCode),
        ]);
    }
}
