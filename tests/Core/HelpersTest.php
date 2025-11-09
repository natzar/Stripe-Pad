<?php

use PHPUnit\Framework\TestCase;

final class HelpersTest extends TestCase
{
	public function testFriendlySlugRemovesStopWordsAndPunctuation(): void
	{
		$slug = friendly_slug('The Quick, Brown Fox!');
		$this->assertSame('quick-brown-fox', $slug);
	}

	public function testEncryptAndDecryptRoundTrip(): void
	{
		$secret = 'Súper-Secret-' . microtime(true);
		$encrypted = encrypt($secret);

		$this->assertNotSame($secret, $encrypted, 'Encrypted text should differ from plain text');
		$this->assertNotEmpty($encrypted);

		$this->assertSame($secret, decrypt($encrypted));
	}

	public function testSanitizeRecursivelyCleansArrays(): void
	{
		$input = [
			'name' => '<b>Alice</b>',
			'nested' => [
				'comment' => '<script>alert(1)</script>Hi'
			]
		];

		$result = sanitize($input);

		$this->assertSame('Alice', $result['name']);
		$this->assertSame('Hi', $result['nested']['comment']);
	}
}
