<?php
	require_once('../private/initialize.php');

	$page_title = 'Sign up';

	if(isset($_POST['btn-signup'])) {

		$userdata = [];
		$userdata['username'] = trim($_POST['username']);
		$userdata['email'] = trim($_POST['user_email']);
		$userdata['passwd'] = trim($_POST['passwd']);
		$userdata['dup_passwd '] = trim($_POST['dup_passwd']);

		$errors = check_data($userdata);

		if ($errors === Array()) {
			try
			{
				$stmt = $conn->prepare(
						"SELECT username, email FROM users
						WHERE username = :username OR email = :email"
						);

				$stmt->execute(array(':username'=>$userdata['username'], ':email'=>$userdata['email']));
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				if ($row['username'] == $userdata['username']) {
					$error[] = "sorry username already taken !";
				}
				else if ($row['email'] == $userdata['email']) {
					$error[] = "sorry email already taken !";
				}
				else
				{
					if ($user->register($userdata['username'], $userdata['email'], $userdata['passwd']))
					{
						// Нужно сначала отправить письмо на подтверждение
						// Затем только логинить
						$user->login($userdata['username'], $userdata['passwd']);
						redirect(WWW_ROOT . '/index');
					}
				}
					print_r($error);
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	}
?>

<?php include('../private/shared/public_header.php'); ?>

<link rel="stylesheet" href="styles/forms.css">

<main>
	<form id="signup" action="signup.php" method="post" autocomplete="on">
		<div class="centered">
			<h3>sign up & have fun!</h3>
			<div class="put-data">
				<input class="focus-input" type="text" name="username" value="" placeholder="Username" required minlength="6" maxlength="20">
				<input class="focus-input" type="email" name="user_email" value="" placeholder="Email" required>
				<input class="focus-input" type="password" name="passwd" value="" placeholder="Password" required minlength="6" maxlength="20">
				<input class="focus-input" type="password" name="dup_passwd" value="" placeholder="Confirm password" required>
			</div>
			<input type="submit" name="btn-signup" value="Go!">
		</div>
	</form>
</main>

<?php include('../private/shared/footer.php'); ?>
