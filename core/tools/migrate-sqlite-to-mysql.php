<?
// Conexiones
$sqlite = new PDO('sqlite:' . $sqlitePath);
$mysql = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);

// Lista de tablas Stripe Pad (como tú defines el esquema)
$tables = ['users', 'subscriptions', 'plans', 'invoices', 'events'];

foreach ($tables as $table) {
    $rows = $sqlite->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);

    if (!$rows) {
        continue;
    }

    // Construir INSERT dinámico
    $columns = array_keys($rows[0]);
    $colList = '`' . implode('`,`', $columns) . '`';
    $placeholders = ':' . implode(',:', $columns);

    $stmt = $mysql->prepare("INSERT INTO `$table` ($colList) VALUES ($placeholders)");

    foreach ($rows as $row) {
        $stmt->execute($row);
    }
}

echo "SQLite migrated to Mysql [DONE].\n";
