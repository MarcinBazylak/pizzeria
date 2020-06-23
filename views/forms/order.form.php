<p>Wypełnij poniższy formularz aby dokończyć zamówienie</p>
<form id="orderForm" enctype="multipart/form-data" action="/order/create" method="POST">
   <input type="text" name="name" placeholder="Imię i Nazwisko" value="<?php echo ($_POST['name']) ?? '' ?>" autocomplete="off"><br>
   <input type="text" name="tel" placeholder="Numer telefonu" value="<?php echo ($_POST['tel']) ?? '' ?>" autocomplete="off"><br>
   <input type="text" name="address1" placeholder="Ulica" value="<?php echo ($_POST['address1']) ?? '' ?>" autocomplete="off"><br>
   <input type="text" name="address2" placeholder="Numer budynku/lokalu" value="<?php echo ($_POST['address2']) ?? '' ?>" autocomplete="off"><br>
   
   <select length="20" name="city" required>
				<option value="" hidden>Wybierz Miejscowość</option>
				<option value="elk" selected>Ełk</option>
            <!-- <option value="suwalki">Suwałki</option> -->
	</select><br>

   <textarea name="info" placeholder="Dodatkowe informacje do zamówienia" cols="30" rows="7"><?php echo ($_POST['info']) ?? '' ?></textarea><br>
</form>
<form action="/order/clear" method="POST" id="delete"></form>
<button type="submit" form="orderForm">Przejdź dalej</button> <button type="submit" form="delete">Usuń zamówienie</button>
