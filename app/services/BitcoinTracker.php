<?php

/**
 * Simple helper that talks to CoinGecko so the sample app can display
 * real Bitcoin data (or gracefully degrade if the API is unreachable).
 */
class BitcoinTracker
{
	private const SIMPLE_PRICE_URL = 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=%s&include_24hr_change=true&include_last_updated_at=true';
	private const MARKET_CHART_URL = 'https://api.coingecko.com/api/v3/coins/bitcoin/market_chart?vs_currency=%s&days=%d&interval=hourly';

	private string $currency;
	private int $historyDays;

	public function __construct(string $currency = 'usd', int $historyDays = 7)
	{
		$this->currency = strtolower($currency);
		$this->historyDays = max(1, $historyDays);
	}

	public function getCurrency(): string
	{
		return strtoupper($this->currency);
	}

	public function getSnapshot(): array
	{
		try {
			$current = $this->fetchCurrentPrice();
			$history = $this->fetchHistory();

			return [
				'price' => $current['price'],
				'change_24h' => $current['change_24h'],
				'last_updated' => $current['last_updated'],
				'history' => $history,
				'error' => null,
			];
		} catch (Throwable $e) {
			$fallbackHistory = $this->fallbackHistory();

			return [
				'price' => end($fallbackHistory)['price'],
				'change_24h' => null,
				'last_updated' => null,
				'history' => $fallbackHistory,
				'error' => $e->getMessage(),
			];
		}
	}

	private function fetchCurrentPrice(): array
	{
		$url = sprintf(self::SIMPLE_PRICE_URL, $this->currency);
		$data = $this->requestJson($url);

		if (!isset($data['bitcoin'][$this->currency])) {
			throw new RuntimeException('Unexpected API payload');
		}

		$relative = $data['bitcoin'];
		$timestamp = $relative['last_updated_at'] ?? time();

		return [
			'price' => (float)$relative[$this->currency],
			'change_24h' => $relative[$this->currency . '_24h_change'] ?? null,
			'last_updated' => date('Y-m-d H:i:s', $timestamp),
		];
	}

	private function fetchHistory(): array
	{
		$url = sprintf(self::MARKET_CHART_URL, $this->currency, $this->historyDays);
		$data = $this->requestJson($url);
		if (empty($data['prices']) || !is_array($data['prices'])) {
			throw new RuntimeException('Unable to load history');
		}

		$history = [];
		foreach ($data['prices'] as $point) {
			$timestampMs = $point[0] ?? null;
			$price = $point[1] ?? null;
			if (null === $timestampMs || null === $price) {
				continue;
			}
			$timestamp = (int)round($timestampMs / 1000);
			$history[] = [
				'timestamp' => $timestamp,
				'label' => date('M j, H:i', $timestamp),
				'price' => round((float)$price, 2),
			];
		}

		if (empty($history)) {
			throw new RuntimeException('History data empty');
		}

		return $history;
	}

	private function requestJson(string $url): array
	{
		$response = $this->httpRequest($url);
		$data = json_decode($response, true);
		if (json_last_error() !== JSON_ERROR_NONE) {
			throw new RuntimeException('Invalid JSON response');
		}
		return $data;
	}

	private function httpRequest(string $url): string
	{
		if (function_exists('curl_init')) {
			$ch = curl_init($url);
			curl_setopt_array($ch, [
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_TIMEOUT => 6,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_USERAGENT => 'StripePad Bitcoin Tracker',
			]);
			$response = curl_exec($ch);
			$error = curl_error($ch);
			$code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
			curl_close($ch);
			if ($response === false) {
				throw new RuntimeException('Unable to reach API: ' . $error);
			}
			if ($code >= 400) {
				throw new RuntimeException('API responded with HTTP ' . $code);
			}
			return $response;
		}

		$response = @file_get_contents($url);
		if ($response === false) {
			throw new RuntimeException('Unable to reach API (allow_url_fopen disabled?)');
		}
		return $response;
	}

	private function fallbackHistory(): array
	{
		$history = [];
		$base = 30000;
		for ($i = 6; $i >= 0; $i--) {
			$timestamp = strtotime("-{$i} day");
			$delta = rand(-800, 900);
			$value = round($base + $delta, 2);
			$history[] = [
				'timestamp' => $timestamp,
				'label' => date('M j', $timestamp),
				'price' => $value,
			];
			$base = $value;
		}
		return $history;
	}
}
