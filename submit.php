<!doctype html>
<html lang="en">
	<head>
		<title>Form Submission</title>
		<meta charset="utf-8">
	</head>
	<body>
		<table>
<?php 
    foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo htmlspecialchars($key);
        echo "</td>";
        echo "<td>";
	if (is_array($value))
		echo htmlspecialchars(join($value, ", "));
	else
		echo htmlspecialchars($value);
        echo "</td>";
        echo "</tr>";
    }
?>
		</table>
	</body>
</html>

