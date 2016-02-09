<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="/assets/styles.css">
	<meta charset="utf-8">
	<title><?= $profile['alias'] ?></title>
</head>
<body>
	<a href="/dashboard"><p>Home</p></a>
	<a href="/logins/logout_user"><p>Logout</p></a>
	<div id="wrapper">
		<h1><?= $profile['alias'] ?>'s Profile</h1>
		<p>Name: <?= $profile['name'] ?></p>
		<p>Email Address: <?= $profile['email'] ?></p>
	</div>
</body>
</html>