<!-- Sign up -->
<div class="container-fluid form">
  <div class="row">
    <div class="col-lg-12 p-lg-0 col-12">
      <div class="form-right p-lg-5 pt-5 pb-5 pl-3 pr-3">
        <div class="container p-lg-5">
          <div class="form-text mb-lg-3 mb-3"><a href="<?php echo URL; ?>"><span class="lnr lnr-arrow-left mr-lg-3 mr-3"></span>Înapoi</a></div>
          <div class="form-title mb-lg-3 mb-3">Raportează subiectul</div>
          <div class="form-text mb-lg-5 mb-5">Subiect la <?php echo $materie_data->title; ?>, Anul <?php echo $subiect->anul; ?> - Semestrul <?php echo $subiect->semestrul; ?></div>
          <div class="form-text mb-lg-5 mb-5">Pentru fiecare raportare, ID-ul contului tău este stocat alături de datele reportării. Astfel, dacă raportarea ta marchează un abuz, riști să fi exclus din platformă.</div>
          <form action="<?php echo URL; ?>subiect/reportsubiect" method="post" class="pr-lg-5">
            <input type="hidden" name="subiect_id" value="<?php echo $subiect->id; ?>">
            <div class="form-group">
              <label>Motivul raportării</label>
              <select name="motiv" class="form-control">
                <option disabled selected>Motivul raportării</option>
                <option value="Postarea nu este relevanta pentru platforma">Postarea nu este relevantă pentru platformă</option>
                <option value="Subiectul este deja postat pe platforma">Subiectul este deja postat pe platformă</option>
                <option value="Postarea contine informatii eronate">Postarea conține informații eronate</option>
                <option value="Altceva">Altceva</option>
              </select>
            </div>
            <div class="form-group">
              <label>Detalii</label>
              <textarea name="details" placeholder="Detalii" class="form-control textarea-post-subiect"></textarea>
            </div>
            <button type="submit" name="submit_report" class="btn btn-primary mt-lg-2 mt-2">Raportează</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
