<?php

use PHPUnit\Framework\TestCase;

class TestModelBaseStub extends ModelBase
{
	public function __construct()
	{
		parent::__construct('test_items');
	}
}

final class ModelBaseTest extends TestCase
{
	private ?PDO $pdo = null;

	protected function setUp(): void
	{
		if (!in_array('sqlite', PDO::getAvailableDrivers(), true)) {
			$this->markTestSkipped('PDO SQLite driver is not available in this PHP build.');
		}

		$this->pdo = SPDO_sqlite::singleton();
		$this->pdo->exec('DROP TABLE IF EXISTS test_items');
		$this->pdo->exec(
			'CREATE TABLE test_items (
				test_itemsId INTEGER PRIMARY KEY AUTOINCREMENT,
				title TEXT NOT NULL,
				amount REAL DEFAULT 0,
				visible INTEGER NOT NULL DEFAULT 0,
				created TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
			)'
		);
	}

	protected function tearDown(): void
	{
		if ($this->pdo instanceof PDO) {
			$this->pdo->exec('DROP TABLE IF EXISTS test_items');
		}
	}

	public function testGetOrmDescriptionDetectsColumns(): void
	{
		$model = new TestModelBaseStub();
		$description = $model->getOrmDescription('test_items');

		$this->assertSame(['title', 'amount', 'visible'], $description['fields']);
		$this->assertSame('test_itemsId DESC', $description['default_order']);

		$fieldTypes = array_combine($description['fields'], $description['fields_types']);
		$this->assertSame('text', $fieldTypes['title']);
		$this->assertSame('number', $fieldTypes['amount']);
		$this->assertSame('number', $fieldTypes['visible']);
	}
}
