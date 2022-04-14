<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Brorir</title>
	<link rel="stylesheet" href="<?= base_url('assets/css/uikit.min.css') ?>">
	<!-- <link rel="manifest" href="<?= base_url('manifest.json') ?>"> -->
	<style>
		html,
		body {
			background: url('https://getuikit.com/images/section-background.svg') 50% 17vh no-repeat, linear-gradient(to left top, #28a5f5, #1e87f0) 0 0 no-repeat;
			/* min-height: 695px; */
			min-height: 100vh;
			background-size: contain;
		}

		.uk-card {
			background-color: #EEEEEE;
			position: absolute;
			bottom: 0;
			justify-content: center;
			/* min-height: 65%; */
			border-radius: 2rem 2rem 0 0;
		}

		.uk-card-body {
			padding: 15px 30px;
		}

		.uk-button-light {
			background-color: #FAFAFA;
		}
	</style>
</head>

<body>
	<div class="uk-flex uk-flex-center">
		<img src="<?= base_url('assets/img/logo.png') ?>" width="250" alt="">

		<div class="uk-card uk-card-default uk-width-1-1 uk-width-1-4@s">
			<div class="uk-card-body">
				<?= form_open('login/process') ?>
				<h4 class="uk-text-bold uk-text-center">Login to Your Account</h4>
				<div class="uk-margin-small-bottom">
					<input class="uk-input uk-border-rounded" placeholder="Email / Username" type="text" name="username">
				</div>

				<div class="uk-margin-small-bottom">
					<input class="uk-input uk-border-rounded" placeholder="Password" type="password" name="password">
				</div>

				<div class="uk-margin-bottom">
					<button type="submit" class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded">
						Sign In
					</button>
				</div>

				<div class="uk-margin-bottom">
					<h5 class="uk-text-bold uk-text-center">- Or sign in with -</h5>
				</div>

				<div class="uk-margin-large-bottom uk-child-width-1-3 uk-flex-center uk-grid-small" uk-grid>
					<div>
						<button class="uk-button uk-button-light"><span uk-icon="icon: google"></span></button>
					</div>
					<div>
						<button class="uk-button uk-button-light"><span uk-icon="icon: facebook"></span></button>
					</div>
					<div>
						<button class="uk-button uk-button-light"><span uk-icon="icon: twitter"></span></button>
					</div>
				</div>
				<?= form_close() ?>
				<div class="uk-margin-bottom">
					<p class="uk-text-bold uk-text-center">
						Don't have account? <a href="<?= site_url('register') ?>">Sign Up</a>
					</p>
				</div>
			</div>
		</div>
	</div>

	<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/uikit.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/uikit-icons.min.js') ?>"></script>
	<script>
		// if ('serviceWorker' in navigator) {
		// 	window.addEventListener('load', () => {
		// 		navigator.serviceWorker.register('./sw.js').then(() => {
		// 			console.log('Service worker registered!');
		// 		}).catch((error) => {
		// 			console.warn('Error registering service worker:');
		// 			console.warn(error);
		// 		});
		// 	});
		// }
	</script>
</body>

</html>
