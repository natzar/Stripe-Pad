<?
include "cors.php";
include "bd.php";

$q = $bd->prepare("UPDATE leads set confirmed = 1 where leadsId = :id");
$q->bindParam(":id",$_GET['id']);
$q->execute();

header('Content-Type: image/png');
echo base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=');
	