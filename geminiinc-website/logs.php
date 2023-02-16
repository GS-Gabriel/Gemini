<?php

include "inc/init.php";
include "inc/redis.php";

$page->title = "Logs";

$presets->setActive("pdflogs"); // we highlith the home link

include 'header.php';

echo "
<div class=\"container\">
<div class=\"hero-unit\">
<h1>PDF Logs</h1>
<p></p>";

$pdfList = $redis->lrange("pdf", 0, -1);
$pdfList = array_reverse($pdfList, TRUE);
$i=1;
foreach ( $pdfList as $pdfLog) {
		echo "<p>" . $i . ": " . $pdfLog ."<br></p>";
		$i = $i + 1;
	}
echo "</div></div> <!-- /container -->";
include 'footer.php';

?>
