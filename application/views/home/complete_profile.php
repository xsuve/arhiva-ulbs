<!-- Complete Profile -->
<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-3 p-lg-0 d-none d-lg-block">
      <div class="form-left p-lg-5">
        <a href="<?php echo URL; ?>">
          <div class="form-logo mb-lg-5">
            <img src="<?php echo URL; ?>public/img/logo-black.svg">
          </div>
        </a>
				<div class="form-text mt-lg-5 pt-lg-5">Dacă deți subiecte din anii precedenți, ajută-i pe cei din anii respectivi cu un model de examen.</div>
				<div class="form-text mt-lg-5">La rândul tău, cei din anii mai mari, vor oferi subiecte pentru tine.</div>
				<div class="form-text mt-lg-5">Îți mulțumim!</div>
        <div class="form-contact form-text pl-lg-5 pr-lg-5">Ai nevoie de mai multe detalii? <a href="<?php echo URL; ?>support">Contactează-ne</a></div>
      </div>
    </div>
    <div class="col-lg-9 p-lg-0 col-12">
      <div class="form-right p-lg-5 pt-5 pb-5 pl-3 pr-3">
        <div class="container p-lg-5">
          <div class="form-title mb-lg-3 mb-3">Completează-ți profilul pentru a începe</div>
          <div class="form-text mb-lg-5 mb-3">Aceste date ne ajută să identificăm secțiunile potrivite pentru tine în platformă.</div>
          <form action="<?php echo URL; ?>login/completeprofile" method="post" class="pr-lg-5">
            <div class="form-group">
              <label>Specializarea ta</label>
              <select name="specializare" class="form-control">
                <option disabled selected>Specializarea ta</option>
                <?php if(count($specializari) > 0): ?>
									<?php foreach($specializari as $specializare): ?>
										<option value="<?php echo $specializare->id; ?>"><?php echo $specializare->title; ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Anul curent</label>
							<select name="anul" class="form-control">
                <option disabled selected>Anul curent</option>
                <option value="1">Anul 1</option>
								<option value="2">Anul 2</option>
								<option value="3">Anul 3</option>
								<option value="4">Anul 4</option>
								<option value="5">Master</option>
              </select>
            </div>
            <button type="submit" name="submit_complete_profile" class="btn btn-primary mt-lg-2 mt-2">Începe acum</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
