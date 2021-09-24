<?php ?>
<html>
<head>
<!-- Skalowanie -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
<!-- Custom CSS -->
<link rel="stylesheet" href="style.css">
<!-- Fontawesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Kwoty dostawy oraz produktu -->
<script>
		let discountjs = 0;
		let total = 115.00;
		let md1 = 10.99;
		let md2 = 18.00;
		let md3 = 22.00;
</script>
</head>

<body>
<section class="main">
	<div class="row">

	<!-- Lewa Strona -->
	<div class="col-lg-4">
		<div class="headtitle col-xl-10 col-10 inputdata"> <p><i class="fas fa-user"></i>1. TWOJE DANE</p> </div>
			<button type="button" class="btn btn-outline-danger logdata col-10" data-bs-target="#loginpop" data-bs-toggle="modal" id="loginpopid">Logowanie</button>
			<p class="asklogin">Masz już konto? <a href="login.php">Kliknij</a> żeby się zalogować.</p>
			<div class="form-check col-10 inputdata">
				<input class="form-check-input" type="checkbox" onclick="openaccount()" form="form1" value="" id="usercheckbox" required>
				<label class="form-check-label" for="usercheckbox">
				  Stwórz nowe konto
				</label>
			</div>
			<!-- Dane do konta -->
			<form id="form1">
				<div id="newaccount">
					<span class="col-10 inputdata"><input class="form-control form-control-sm" type="text" id="login" placeholder="Login" aria-label="default input example" required></span>
					<span class="col-10 inputdata"><input class="form-control form-control-sm" type="password" id="password" placeholder="Hasło" aria-label="default input example" required></span>
					<span class="col-10 inputdata"><input class="form-control form-control-sm" type="password" id="confirmpassword" placeholder="Potwierdź hasło" aria-label="default input example" required></span>
					<span class="col-10 inputdata"><input class="form-control form-control-sm" type="text" id="name" placeholder="Imię *" aria-label="default input example" required></span>
					<span class="col-10 inputdata"><input class="form-control form-control-sm" type="text" id="lastname" placeholder="Nazwisko *" aria-label="default input example" required></span>
					<span class="col-10 inputdata"><select class="form-select form-select-sm" aria-label=".form-select-sm example" id="country" required>
						<option value="Polska">Polska</option>
						<option value="Czechy">Czechy</option>
						<option value="Niemcy">Niemcy</option>
					</select></span>
					<span class="col-10 inputdata"><input class="form-control form-control-sm" type="text" id="adress" placeholder="Adres *" aria-label="default input example" required></span>
					<div class="row col-10 inputdata2">
	  					<div class="col mx-0 ps-0 pe-1"><input class="form-control form-control-sm" type="text" id="post_code" placeholder="Kod Pocztowy [12-123] *" aria-label="default input example" pattern="[0-9]{2}[-][0-9]{3}" required></div>
						<div class="col mx-0 pe-0 ps-1"><input class="form-control form-control-sm" type="text" id="city" placeholder="Miasto *" aria-label="default input example" required></div>
					</div>
					<span class="col-10 inputdata"><input class="form-control form-control-sm" type="tel" id="phone" placeholder="Telefon *" aria-label="default input example" pattern="[0-9]{9}" required></span>
				</div>
			</form>
	</div>

	<!-- Środek -->
	<div class="col-lg-4">

		<!-- Metody dostawy -->
		<div class="headtitle col-xl-10 col-10 inputdata"> <p><i class="fas fa-truck"></i>2. METODA DOSTAWY</p> </div>
			<div class="form-check col-10 inputdata" id="divmd1">
  				<input class="form-check-input" type="radio" name="delivery" onclick="deliveryradio()" id="md1" form="form1" value="1" required>
  				<label class="form-check-label" for="md1">
    				Paczkomaty 24/7
  				</label>
			</div>
			<div class="form-check col-10 inputdata" id="divmd2">
  				<input class="form-check-input" type="radio" name="delivery" onclick="deliveryradio()" id="md2" form="form1" value="2" required>
  				<label class="form-check-label" for="md2">
    				Kurier DPD
  				</label>
			</div>
			<div class="form-check col-10 inputdata" id="divmd3">
  				<input class="form-check-input" type="radio" name="delivery" onclick="deliveryradio()" id="md3" form="form1" value="3" required>
  				<label class="form-check-label" for="md3">
    				Kurier DPD pobranie
  				</label>
			</div>

		<!-- Metody płatności -->
		<div class="headtitle col-xl-10 col-10 inputdata"> <p><i class="fas fa-credit-card"></i>3. METODA PŁATNOŚCI</p> </div>
			<div class="form-check col-10 inputdata" id="divmp1">
  				<input class="form-check-input" type="radio" name="payment" id="mp1" form="form1" value="1" required>
  				<label class="form-check-label" for="mp1">
    				PayU
  				</label>
			</div>
			<div class="form-check col-10 inputdata" id="divmp2">
  				<input class="form-check-input" type="radio" name="payment" id="mp2" form="form1" value="2" required>
  				<label class="form-check-label" for="mp2">
    				Płatność przy odbiorze
  				</label>
			</div>
			<div class="form-check col-10 inputdata" id="divmp3">
  				<input class="form-check-input" type="radio" name="payment" id="mp3" form="form1" value="3" required>
  				<label class="form-check-label" for="mp3">
    				Przelew bankowy - zwykły
  				</label>
			</div>
			<div class="mb-3 col-10 discount">
				<input type="text" class="form-control" placeholder="Kod Rabatowy" id="discount" name="discount" aria-label="discount" aria-describedby="button-addon2">
				<button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="discount()">Aktywuj</button>
			</div>
			<div class="col-10 inputdata error" id="feedback2"></div>
		</div>

		<!-- Prawa Strona -->
	<div class="col-lg-4">
		<div class="headtitle col-xl-10 col-10 inputdata"> <p><i class="far fa-file-alt"></i>4. PODSUMOWANIE</p> </div>
			<div class="row col-10 mx-auto">
				<div class="col"><img src="https://i.imgur.com/2IRKabj_d.webp?maxwidth=760&fidelity=grand" alt="product1"></div>
				<div class="col ">Testowy produkt <br> Ilość: 1</div>
				<div class="col text-end">115,00 zł</div>
			</div>
		<hr class="col-10 inputdata" />
			<div class="row col-10 mx-auto">
				<div class="col-12 inputdata">
					<span class="">Suma częściowa</span>
					<span class="priceend" id="priceend"><script>document.write(total.toFixed(2));</script> zł</span>
				</div>
				<div class="col-12 inputdata">
					<span class="fw-bold">Łącznie</span>
					<span class="priceend fw-bold" id="countdelivery"><script>document.write(total.toFixed(2));</script> zł</span>
				</div>
			</div>
		<hr class="col-10 inputdata" />
			<div class="form-floating col-10 inputdata">
				<textarea class="form-control" id="comment" style="height: 100px" form="form1"></textarea>
				<label for="floatingTextarea2">Komentarz</label>
			</div>
			<div class="form-check col-10 inputdata">
				<input class="form-check-input" type="checkbox" value="1" id="newsletter" form="form1" name="newsletter">
				<label class="form-check-label" for="newsletter">
				  Zapisz się, aby otzymać newsletter
				</label>
			</div>
			<div class="form-check col-10 inputdata">
				<input class="form-check-input" type="checkbox" value="" id="policy" form="form1" required>
				<label class="form-check-label" for="policy">
				  Zapoznałam/em się z <a href="regulamin.php">Regulaminem</a> zakupów.
				</label>
			</div>
			<div id="html_element" class="col-10 inputdata"></div>
			<button type="submit" class="btn btn-danger logdata col-10 confirmpayment fw-bold" form="form1"  id="confirmbytton">POTWIERDŹ ZAKUP</button>
			<div class="col-10 inputdata mt-4" id="feedback"></div>
	</div>

	<!-- PopUp -->
	<div class="modal fade" id="loginpop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Logowanie</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<form id="form2">
			<div class="input-group mb-3">
				<span class="input-group-text" id="inputGroup-sizing-default">Login</span>
				<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
			</div>
			<div class="input-group mb-3">
				<span class="input-group-text" id="inputGroup-sizing-default">Hasło</span>
				<input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
			</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="submit" form="form2" class="btn btn-primary">Zaloguj</button>
		</div>
		</div>
	</div>
	</div>


</div>
</section>
<!-- ReCaptcha -->
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Custom JS -->
<script src="script.js"></script>

</body>
</html>
























