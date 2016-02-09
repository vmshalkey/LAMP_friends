<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="/assets/styles.css">
	<meta charset="utf-8">
	<title>My Friends</title>
</head>
<body>
	<a href="/logins/logout_user"><p>Logout</p></a>
	<h1>Hello, <?= $user['alias'] ?>!</h1>
	<div>
		<h3>Here is a list of your friends:</h3>
		<div>
			<table>
				<tr>
					<th>Alias</th>
					<th>Action</th>
				</tr>
			<? $count = 0;
			foreach($your_friends as $your_friend) {
				$count++;
				?>
				<tr>
					<td><?= $your_friend['alias'] ?></td>
					<td>
						<a href="/user_profile/<?= $your_friend['friended_id'] ?>">View Profile</a>
						<form action="/logins/remove_friend" method="post">
			        		<input type="hidden" value="<?= $your_friend['friended_id'] ?>" name="friended_id">
			        		<input type="submit" value="Remove as Friend">
			        	</form>
					</td>
    			</tr>
    		<?php } ?>
    		<? if($count === 0) {
    			echo "<p>You don't have friends yet</p>";
    		} ?>
        	</table>
        </div>
	</div>
	<div>
		<h3>Other Users not on your friends list:</h3>
		<div>
			<table>
				<tr>
					<th>Alias</th>
					<th>Action</th>
				</tr>
			<? foreach($other_users as $other_user) { ?>
				<tr>
					<td>
						<a href="/user_profile/<?= $other_user['id'] ?>"><p><?= $other_user['alias'] ?></p></a>
					</td>
					<td>
						<form action="/logins/add_friend" method="post">
			        		<input type="hidden" value="<?= $other_user['id'] ?>" name="friended_id">
			        		<input type="submit" value="Add as Friend">
			        	</form>
					</td>
        		</tr>
        	<?php } ?>
        	</table>
        </div>
	</div>
</body>
</html>