<!-- Dashboard -->
<div class="container-fluid section">
	<div class="container">
		<div class="row">

      <!-- Left -->
      <div class="col-lg-7 col-12">
        <div class="container-fluid form">
          <div class="form-title mb-lg-3 mb-3">Postează un nou model de subiect</div>
          <div class="form-text mb-lg-5 mb-5">Asigură-te că datele subiectului postat sunt valide. Mai multe precizări despre modelul de examen se vor face în secțiunea de descriere.</div>
          <form action="<?php echo URL; ?>subiect/post" method="post" enctype="multipart/form-data" class="pr-lg-5">
            <div class="form-group">
              <label>Specializare</label>
              <select name="specializare_id" id="postSpecializare" class="form-control">
                <option disabled selected>Specializare</option>
                <?php if(count($specializari) > 0): ?>
                  <?php foreach($specializari as $specializare): ?>
                    <option value="<?php echo $specializare->id; ?>"><?php echo $specializare->title; ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Anul</label>
              <select name="anul" id="postAnul" class="form-control">
                <option disabled selected>Anul</option>
                <option value="1">Anul 1</option>
								<option value="2">Anul 2</option>
								<option value="3">Anul 3</option>
								<option value="4">Anul 4</option>
								<option value="5">Master</option>
              </select>
            </div>
            <div class="form-group">
              <label>Semestrul</label>
              <select name="semestrul" id="postSemestrul" class="form-control">
                <option disabled selected>Semestrul</option>
                <option value="1">Semestrul 1</option>
								<option value="2">Semestrul 2</option>
              </select>
            </div>
            <div class="form-group">
              <label>Materie</label>
              <select name="materie_id" id="postMaterie" class="form-control">
                <option disabled selected>Materie</option>
              </select>
            </div>
            <div class="form-group">
              <label>Descriere</label>
              <textarea name="description" placeholder="Descriere" class="form-control textarea-post-subiect"></textarea>
            </div>
            <div class="form-group">
              <div class="post-subiect-input text-center">
                <div class="post-subiect-image">
                  <img src="" id="postSubiectInputPreview">
                </div>
                <input type="file" name="image" id="postSubiectInput">
                <span class="lnr lnr-plus-circle" id="postSubiectInputSpan"></span>
              </div>
            </div>
            <button type="submit" name="submit_post" class="btn btn-primary mt-lg-2 mb-lg-5 mt-2">Postează subiectul</button>
          </form>
        </div>
      </div>

      <!-- Right -->
      <div class="col-lg-5 col-12 mt-5 mt-lg-0">
        <div class="box box-primary box-margin p-lg-4 p-4">
          <div class="box-icon mb-lg-4 mb-4"><span class="lnr lnr-heart"></span></div>
          <div class="box-title mb-lg-2 mb-2">Îți mulțumim pentru contributia ta la arhivă!</div>
          <div class="box-text">Când postezi un model de examen in arhivă, acesta ramâne disponibil pentru generațiile viitoare.</div>
        </div>
      </div>

		</div>
	</div>
</div>
