<!-- Sign up -->
<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-3 p-lg-0 d-none d-lg-block">
      <div class="form-left p-lg-5">
        <a href="<?php echo URL; ?>">
          <div class="form-logo mb-lg-5">
            <img src="<?php echo URL; ?>public/img/logo-black.svg">
          </div>
        </a>
        <div class="form-list mt-lg-5">
          <ul class="pl-lg-0">
            <li class="mb-lg-4">
              <div class="form-list-icon text-center mr-lg-3">
                <span class="lnr lnr-arrow-right vm"></span>
              </div>
              SUBIECTE EXAMENE
            </li>
            <li class="mb-lg-4">
              <div class="form-list-icon text-center mr-lg-3">
                <span class="lnr lnr-arrow-right vm"></span>
              </div>
              DISCUȚII STUDENȚI
            </li>
            <li class="mb-lg-4">
              <div class="form-list-icon text-center mr-lg-3">
                <span class="lnr lnr-arrow-right vm"></span>
              </div>
              SFATURI MATERII
            </li>
            <li>
              <div class="form-list-icon text-center mr-lg-3">
                <span class="lnr lnr-arrow-right vm"></span>
              </div>
              MULTE ALTELE
            </li>
          </ul>
        </div>
        <div class="form-text mt-lg-5 pt-lg-5">Adresa ta de e-mail va fi encriptată, astfel fiecare acțiune personală pe platformă va fi complet anonimă.</div>
        <div class="form-contact form-text pl-lg-5 pr-lg-5">Ai nevoie de mai multe detalii? <a href="<?php echo URL; ?>support">Contactează-ne</a></div>
      </div>
    </div>
    <div class="col-lg-9 p-lg-0 col-12">
      <div class="form-right p-lg-5 pt-5 pb-5 pl-3 pr-3">
        <div class="container p-lg-5">
          <div class="form-title mb-lg-3 mb-3">Înregistrează-te în platformă</div>
          <div class="form-text mb-lg-5 mb-5">Dacă optezi pentru un cont în platformă vei beneficea de multiple avantaje în rândul studenților ULBS.</div>
          <form action="<?php echo URL; ?>signup/signupaccount" method="post" class="pr-lg-5">
            <div class="row">
              <div class="col-lg-5 col-12">
                <div class="form-group">
                  <label>Cod invitație</label>
                  <input type="text" name="invitation_code" class="form-control" placeholder="Cod invitație">
                </div>
              </div>
              <div class="col-lg-7 col-12">
                <div class="form-group">
                  <label>Nume de utilizator (NU numele tău personal)</label>
                  <input type="text" name="username" class="form-control" placeholder="Nume de utilizator">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Adresa de e-mail</label>
              <input type="email" name="email" class="form-control" placeholder="Adresa de e-mail">
            </div>
            <div class="form-group">
              <label>Parolă</label>
              <input type="password" name="password" class="form-control" placeholder="Parolă">
            </div>
            <button type="submit" name="submit_signup" class="btn btn-primary mt-lg-2 mt-2">Înregistrează-te</button>
            <div class="form-text mt-lg-5 mt-5">Ai deja un cont? <a href="<?php echo URL; ?>login">Loghează-te</a></div>
            <div class="form-text mt-lg-2 mt-2">Nu ai primit o invitație? <a href="<?php echo URL; ?>support">Contactează-ne</a></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
