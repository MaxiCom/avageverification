<style>
	.AvAgeVerification-wrapper {
		position: fixed;
		top: 0;
		left: 0;

		display: flex;
		justify-content: center;
		align-items: center;

		width: 100%;
		height: 100%;

        background-color: rgba(0, 0, 0, {$avOverlayOpacity});

        z-index: 1000000;
	}

	.AvAgeVerification-content {
		display: flex;
		flex-direction: column;
		align-items: center;

		padding: 50px 100px;

		border: 1px solid {$avBoxBorderColor};
		border-radius: 10px;

		background-color: {$avBoxBackgroundColor};

		transform: translateY(-100px);

		font-family: 'Arial', serif;
	}

	.AvAgeVerification-content h3 {
		margin-bottom: 15px;

		font-size: {2.5 * $avTextSizeMultiplicator}em;

		color: {$avBoxTextColor};
	}

	.AvAgeVerification-content p {
		margin-bottom: 30px;

		font-size: {1.2 * $avTextSizeMultiplicator}em;

		color: {$avBoxTextColor};
	}

	.AvAgeVerification-content button {
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

	.AvAgeVerification-content h3, .AvAgeVerification-content p, .AvAgeVerification-content button {
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}

	.AvAgeVerification-content button:hover { opacity: 1; }
</style>

<script>
	function AvAgeVerification_SetCookie(name, value, days) {
		let expires = "";
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toUTCString();
		}
		document.cookie = name + "=" + (value || "") + expires + "; path=/";
	}
	function AvAgeVerification_getCookie(name) {
		let nameEQ = name + "=";
		let ca = document.cookie.split(';');
		for (let i = 0; i < ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) === ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
		}
		return null;
	}

	if (AvAgeVerification_getCookie('AvAgeVerification') !== 'true') {
		let div = document.createElement('div');
		div.innerHTML = `
		    <div class="AvAgeVerification-wrapper">
			    <div class="AvAgeVerification-content">
			        <img src="">
			        <h3>{l|escape:'quotes' s='Age Verification' mod='avageverification'}</h3>
			        <p>{l|escape:'quotes' s='This website contains age-restricted content.' mod='avageverification' }<br>
			            {l|escape:'quotes' s='You must be %1$s years old or over to enter.' sprintf=[$avAge] mod='avageverification'}
			        </p>
			        <button onclick="AvAgeVerification_consent()">{l|escape:'quotes' s='I am %1$s or older - Enter' sprintf=[$avAge] mod='avageverification'}</button>
		        </div>
			</div>
        `;

		document.body.prepend(div);
		document.body.style.overflow = 'hidden';
	}

    function AvAgeVerification_consent() {
        AvAgeVerification_SetCookie('AvAgeVerification', 'true', 30);

        location.reload();
    }
</script>
