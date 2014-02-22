 <html><head><title>www.i-onlinemedia.net</title></head><body>
<p align="center">

	<?php

	if (isset($_POST['update'])) {
	$open = fopen("style.inc.css","w+");
	$text = $_POST['update'];
	fwrite($open, $text);
	fclose($open);
	echo '<span style="color: green;">Changes saved successfully!</span><br />';
	}

	else if (isset($_POST['default_value'])) {
	$open = fopen("style.inc.css","w+");
	$text = $_POST['default_value'];
	fwrite($open, $text);
	echo '<span style="color: green;">Defaults saved successfully!</span><br />';
	} ?>

<form action="style_editor.php" method="post">
	<?php
	$file = file("style.inc.css");
	echo "<textarea Name=\"update\" cols=\"56\" rows=\"37\">";
	foreach($file as $text) { echo $text; }
	echo "</textarea>";
	?>
	<input name="1" type="submit" value="Save Changes">
</form>

<form action="style_editor.php" method="post">
	<input type='hidden' name='default_value' value='<?php $file = file("style.inc.defaults.css"); foreach($file as $text) { echo $text; } ?>'>
  <input name="2" type="submit" value="Restore Defaults">
</form>

</p>
</body></html>