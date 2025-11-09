<?php

use PHPUnit\Framework\TestCase;

class LogFileOnly extends log
{
	public function __construct()
	{
		// Skip parent constructor to avoid DB connections for these tests
	}

	public function summarize(int $days, int $minutes): array
	{
		return $this->getTrafficSummaryFromFile($days, $minutes);
	}
}

final class LogTest extends TestCase
{
	private string $trafficPath;
	private ?string $trafficBackup = null;

	protected function setUp(): void
	{
		$this->trafficPath = ROOT_PATH . 'logs/traffic.log';
		if (is_file($this->trafficPath)) {
			$this->trafficBackup = file_get_contents($this->trafficPath);
		} else {
			$this->trafficBackup = null;
			if (!is_dir(dirname($this->trafficPath))) {
				mkdir(dirname($this->trafficPath), 0777, true);
			}
		}
	}

	protected function tearDown(): void
	{
		if ($this->trafficBackup !== null) {
			file_put_contents($this->trafficPath, $this->trafficBackup);
		} elseif (is_file($this->trafficPath)) {
			unlink($this->trafficPath);
		}
	}

	public function testTrafficSummaryParsesLogFile(): void
	{
		$now = new DateTimeImmutable('now');
		$lines = [
			sprintf('[%s] [Pageview] https://example.com/login-127.0.0.1', $now->format('Y-m-d H:i:s')),
			sprintf('[%s] [Pageview] https://example.com/home-192.168.1.10', $now->modify('-5 minutes')->format('Y-m-d H:i:s')),
			sprintf('[%s] [Pageview] https://example.com/pricing-192.168.1.10', $now->modify('-1 day')->format('Y-m-d H:i:s')),
		];
		file_put_contents($this->trafficPath, implode(PHP_EOL, $lines) . PHP_EOL);

		$log = new LogFileOnly();
		$summary = $log->summarize(7, 10);

		$this->assertSame(3, $summary['total_pageviews']);
		$this->assertSame(2, $summary['online_visitors']);
		$this->assertNotEmpty($summary['daily_counts']);
		$this->assertCount(count($summary['chart_labels']), $summary['chart_values']);
	}

	public function testTrafficSummaryHandlesEmptyFile(): void
	{
		file_put_contents($this->trafficPath, '');

		$log = new LogFileOnly();
		$summary = $log->summarize(5, 10);

		$this->assertSame(0, $summary['total_pageviews']);
		$this->assertSame(0, $summary['online_visitors']);
		$this->assertSame([], $summary['daily_counts']);
		$this->assertSame([], $summary['chart_labels']);
		$this->assertSame([], $summary['chart_values']);
	}
}
