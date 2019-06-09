
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="<?php echo IMAGES_PATH . '/camera-shutter.png'; ?>" type="image/x-icon">
	<title>Camagru | <?php echo $page_title; ?> </title>
	<link rel="stylesheet" href="<?php echo STYLES_PATH . '/style.css'; ?>">
	<link rel="stylesheet" href="<?php echo STYLES_PATH . '/main.css'; ?>">
</head>
<body>
	<header>
		<nav>
			<ul>
				<li>
					<img src="<?php echo IMAGES_PATH . '/camera-shutter.svg'; ?>" alt="logo image" width="25em">
					<a href="<?php echo WWW_ROOT . '/index'; ?>">Camagru</a>
				</li>
				<li <?php if ($page_title === 'Sign in') { echo "style='display: none;'"; } ?> >
					<a href=" <?php echo WWW_ROOT . '/login'; ?> ">Sign in</a>
				</li>
			</ul>
		</nav>
	</header>
