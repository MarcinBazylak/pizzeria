<form action="/contact/send" method="post" id="contactForm"">
      <div class=" kontakt">
         <p>
         Jeżeli chciałbyś skontaktować się z nami w sprawie swojego zamówienia, lub w jakiejkolwiek innej sprawie, to jesteśmy do Twojej dyspozycji codziennie
         w godzinach 10:00 - 17:00.
         </p>
         <div class="form_field">
            <input placeholder="Twoje imię" id="name" type="text" name="name" class="contact" maxlength="80" autocomplete="off" required>
         </div>
         <div class="form_field">
            <input placeholder="Twój adres email" id="email" type="email" name="email" class="contact" maxlength="80" autocomplete="off" required>
         </div>
         <div class="form_field">
            <textarea placeholder="Twoja wiadomość" class="contact" id="txtInput" name="text" oninput="this.style.height = '' ;this.style.height = this.scrollHeight + 'px'" required></textarea>
            <input type="checkbox" name="tick" value="123" style="display: none;">
         </div>
         <div class="form_field">
            <button type="submit" class="contact" name="button" value="send">Wyślij wiadomość</button>
         </div>
      </div>
   </form>