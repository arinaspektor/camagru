<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="<?php echo IMAGES_PATH . '/camera-shutter.png'; ?>" type="image/x-icon">
	<title>Camagru | <?php echo $view_data['page_title']; ?> </title>
	<link rel="stylesheet" href="<?php echo STYLES_PATH . '/style.css'; ?>">
	<link rel="stylesheet" href="<?php echo STYLES_PATH . '/main.css'; ?>">
	<?php if (in_array($view_data['page_title'], ['Sign in', 'Sign up', 'Reset', 'Profile'])) {
		echo '<link rel="stylesheet" href="' . STYLES_PATH . '/forms.css">';
	}?>
	<script type="text/javascript" src="<?php echo SCRIPT_PATH . '/web.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo SCRIPT_PATH . '/main.js'; ?>"></script>
</head>
<body>
	<header>
		<nav>
			<ul>
				<li>
					<img src="<?php echo IMAGES_PATH . '/camera-shutter.svg'; ?>" alt="logo image" width="25em" height="auto">
					<a href="<?php echo WWW_ROOT . '/feed'; ?>">Camagru</a>
				</li>

				<?php if (isset($_SESSION['user_id'])) {?>

				<li><a href="<?php echo WWW_ROOT . '/profile'; ?>"><?php echo htmlentities($_SESSION['username']); ?></a>
					<ul class="dropdown">
						<!-- <li><a href=" <?php echo WWW_ROOT . '/settings'; ?>">settings</a></li> -->
						<li><a href=" <?php echo WWW_ROOT . '/logout'; ?>">logout</a></li>
					</ul>
				</li>

				<?php } else { ?>

					<li <?php if ($view_data['page_title'] === 'Sign in') { echo 'style="display: none;"';} ?>>
						<a href=" <?php echo WWW_ROOT . '/login'; ?> ">Sign in</a>
					</li>

				<?php }; ?>
				
			</ul>
		</nav>
	</header>
