<!-- Support -->
<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 p-lg-0 col-12">
      <div class="form-right p-lg-5 pt-5 pb-5 pl-3 pr-3">
        <div class="container p-lg-5">
          <div class="form-text mb-lg-3 mb-3"><a href="<?php echo URL; ?>"><span class="lnr lnr-arrow-left mr-lg-3 mr-3"></span>Înapoi</a></div>
          <div class="form-title mb-lg-3 mb-3">Contactează echipa de suport</div>
          <div class="form-text mb-lg-5 mb-5">Folosește formularul de mai jos pentru a lua legătura cu echipa de suport.</div>
          <form action="<?php echo URL; ?>support/contactsupport" method="post" class="pr-lg-5">
            <div class="form-group">
              <label>Nume de utilizator</label>
              <input type="text" name="username" class="form-control" placeholder="Nume de utilizator">
            </div>
            <div class="form-group">
              <label>Subiect</label>
              <select name="subject" class="form-control">
                <option disabled selected>Subiect</option>
                <option value="Nu am primit invitatie">Nu am primit invitație</option>
                <option value="Vreau sa raportez un bug al platformei">Vreau să raportez un bug al platformei</option>
                <option value="Vreau sa raportez un utilizator al platformei">Vreau să raportez un utilizator al platformei</option>
                <option value="Doresc sa contribui la platforma">Doresc să contribui la platformă</option>
                <option value="Altceva">Altceva</option>
              </select>
            </div>
            <div class="form-group">
              <label>Mesaj</label>
              <textarea name="message" placeholder="Mesajul tău" class="form-control textarea-post-subiect"></textarea>
            </div>
            <button type="submit" name="submit_contact" class="btn btn-primary mt-lg-2 mt-2">Contactează-ne</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
