<?php global $body_class; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home page</title>
	<?php loadCSS("bootstrap-grid.min.css"); ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
	<?php loadCSS("style.css"); ?>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</head>
<body class="<?= isset($body_class) ? $body_class : '' ?>">
