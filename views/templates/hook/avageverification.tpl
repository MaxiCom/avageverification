<style type="text/css">
	.av-age-verification-wrapper {
		position: fixed;
		top: 0;
		left: 0;

		display: none;
		justify-content: center;
		align-items: center;

		width: 100%;
		height: 100%;
	}

	.av-age-verification-opacity {
		width: 100%;
		height: 100%;

		background-color: black;

		opacity: 1;

		z-index: 100;
	}

	.av-age-verification-content {
		position: fixed;

		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;

		width: 700px;
		height: 300px;

		border: 1px solid rgb(209, 206, 199);
		border-radius: 10px;

		background-color: black;

		transform: translateY(-100px);

		font-family: 'Arial';

		z-index: 101;
	}

	.av-age-verification-content h3 {
		margin-bottom: 15px;

		font-size: 2.5em;

		color: white;
	}

	.av-age-verification-content p {
		margin-bottom: 30px;

		font-size: 1.2em;

		color: rgb(209, 206, 199);
	}

	.av-age-verification-content button {
		padding: 15px 30px;

		border: none;
		border-radius: 5px;

		font-size: 1.2em;

		color: white;
		background-color: rgb(29, 31, 33);

		cursor: pointer;

		outline: none;

		transition: background-color .2s ease;
	}

	.av-age-verification-content button:hover { background-color: rgb(60, 64, 66); }
</style>


<div class="av-age-verification-wrapper">
	<div class="av-age-verification-opacity"></div>
	<div class="av-age-verification-content">
		<img src="">
		<h3>Age Verification</h3>
		<p>This website contains age-restricted content.<br>
			You must be 18 years old or over to enter.</p>
		<button onclick="ageVerification(true)">I am 18 or older - Enter</button>
	</div>
</div>

<script>
	function setCookie(name, value, days) {
		var expires = "";
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toUTCString();
		}
		document.cookie = name + "=" + (value || "") + expires + "; path=/";
	}
	function getCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
		}
		return null;
	}

	function ageVerification(bool) {
		if (bool === true) {
			var overlay = document.querySelector('.av-age-verification-wrapper');

			overlay.style.display = 'none';
			setCookie('av-age-verification', 'true', 30);
		}
	}

	if (getCookie('av-age-verification') !== 'true') {
		var overlay = document.querySelector('.av-age-verification-wrapper');

		overlay.style.display = 'flex';
	}
</script>