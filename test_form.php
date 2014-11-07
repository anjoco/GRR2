<?php
include "include/admin.inc.php";
$grr_script_name = "edit_entry.php";
if (isset($_GET["id"]))
{
	$id = $_GET["id"];
	settype($id,"integer");
}
else
	$id = NULL;
$period = isset($_GET["period"]) ? $_GET["period"] : NULL;
if (isset($period))
	settype($period,"integer");
if (isset($period))
	$end_period = $period;
$edit_type = isset($_GET["edit_type"]) ? $_GET["edit_type"] : NULL;
if (!isset($edit_type))
	$edit_type = "";
$page = verif_page();
if (isset($_GET["hour"]))
{
	$hour = $_GET["hour"];
	settype($hour,"integer");
	if ($hour < 10) $hour = "0".$hour;
}
else
	$hour = NULL;
if (isset($_GET["minute"]))
{
	$minute = $_GET["minute"];
	settype($minute,"integer");
	if ($minute < 10)
		$minute = "0".$minute;
}
else
	$minute = NULL;
$beneficiaire   = getUserName();
$sql = "SELECT DISTINCT login, nom, prenom FROM ".TABLE_PREFIX."_utilisateurs WHERE (etat!='inactif' and statut!='visiteur' ) OR (login='".$beneficiaire."') ORDER BY nom, prenom";
$res = grr_sql_query($sql);
for ($i = 0; ($row = grr_sql_row($res, $i)); $i++)
{
	$rows[] = $row[1].' '.$row[2];
}
include "include/formcreate.class.php";
$form = new Form();
?>
<!DOCTYPE html>
<html>
<head>
	<title>test form</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />
</head>
<body>
	<div class="container">
		<form role="form" method="POST" action="#">
			<?= $form->select('', 'beneficiaire', ucfirst(trim(get_vocab("reservation au nom de"))).get_vocab("deux_points"), $rows);?>
			<?= $form->text('name', get_vocab("namebooker"));?>
			<?= $form->textarea('description', get_vocab("fulldescription"));?>
			<?= $form->checkbox('keys', 'y', get_vocab("status_clef").get_vocab("deux_points"), get_vocab("msg_courrier"));?>
			<?= $form->checkbox('courrier', 'y', get_vocab("status_courrier").get_vocab("deux_points"), get_vocab("msg_courrier"));?>
			<?= $form->submit('Envoyer');?>
		</form>
	</div>
</body>
</html>