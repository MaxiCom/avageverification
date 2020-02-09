<style type="text/css">
	.av-age-verification-wrapper {
		position: absolute;
		top: 0;
		left: 0;

		display: flex;
		justify-content: center;
		align-items: center;

		width: 100%;
		height: 100%;
	}

	.av-age-verification-opacity {
		position: fixed;

		width: 100%;
		height: 100%;

		background-color: black;

		opacity: {$avOverlayOpacity};

		z-index: 1000001;
	}

	.av-age-verification-content {
		position: fixed;

		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;

		width: 700px;
		height: 300px;

		border: 1px solid {$avBoxBorderColor};
		border-radius: 10px;

		background-color: {$avBoxBackgroundColor};

		transform: translateY(-100px);

		font-family: 'Arial';

		z-index: 1000002;
	}

	.av-age-verification-content h3 {
		margin-bottom: 15px;

		font-size: {2.5 * $avTextSizeMultiplicator}em;

		color: {$avBoxTextColor};
	}

	.av-age-verification-content p {
		margin-bottom: 30px;

		font-size: {1.2 * $avTextSizeMultiplicator}em;

		color: {$avBoxTextColor};
	}

	.av-age-verification-content button {
		padding: 15px 30px;

		border: none;
		border-radius: 5px;

		font-size: {1.2 * $avTextSizeMultiplicator}em;

		color: {$avButtonTextColor};
		background-color: {$avButtonBackgroundColor};

		opacity: 0.9;
		
		cursor: pointer;

		outline: none;

		transition: opacity .2s ease;
	}

	.av-age-verification-content h3, .av-age-verification-content p {
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}

	.av-age-verification-content button:hover { opacity: 1; }
</style>


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
			setCookie('av-age-verification', 'true', 30);

			location.reload();
		}
	}

	if (getCookie('av-age-verification') !== 'true') {
		var div = document.createElement('div');

		div.innerHTML = '<div class="av-age-verification-wrapper">\
			<div class="av-age-verification-opacity"></div>\
			<div class="av-age-verification-content">\
			<img src="">\
			<h3>{l s='Age Verification' mod='avageverification'}</h3>\
			<p>{l s='This website contains age-restricted content.' mod='avageverification'}<br>\
			{l s='You must be 18 years old or over to enter.' mod='avageverification'}</p>\
			<button onclick="ageVerification(true)">{l s='I am 18 or older - Enter' mod='avageverification'}</button>\
			</div>\
			</div>';
		document.body.prepend(div);
		document.body.style.overflow = 'hidden';
	}
</script>