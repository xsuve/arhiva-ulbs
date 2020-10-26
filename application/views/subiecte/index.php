<!-- Dashboard -->
<div class="container-fluid section">
	<div class="container">
		<div class="row">

      <!-- Left -->
      <div class="col-lg-5 col-12">
        <div class="box box-margin-right">
          <div class="container-fluid form form-no-height">
            <div class="form-title mb-lg-3 mb-3">Caută subiecte</div>
            <div class="form-text mb-lg-5 mb-5">Folosește filtrele de mai jos pentru căutarea specifică de subiecte.</div>
            <form action="<?php echo URL; ?>subiecte/search" method="post">
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
              <button type="submit" name="submit_search" class="btn btn-primary mt-lg-2 mt-2">Caută subiecte</button>
            </form>
          </div>
        </div>

        <div class="line-divider line-divider-margin-right mt-lg-5 mb-lg-5 mt-5 mb-5"></div>

        <div class="box box-primary box-margin-right p-lg-4 p-4 mt-lg-5 mt-5">
          <div class="box-icon mb-lg-4 mb-4"><span class="lnr lnr-star"></span></div>
          <div class="box-title mb-lg-4 mb-4">Ai un model de examen și nu se află deja în platformă?</div>
          <a href="<?php echo URL; ?>subiect/post">
            <button class="btn btn-light">Postează subiect</button>
          </a>
        </div>
      </div>

      <div class="line-divider mt-5 mb-5 d-lg-none d-block"></div>

      <!-- Right -->
      <div class="col-lg-7 col-12">
        <?php if(count($subiecte) > 0): ?>
					<?php $i = 0; ?>
          <?php foreach($subiecte as $subiect): ?>
						<?php
							$materie_data = $subiect_model->getMaterieData($subiect->materie_id);
							$account_data = $subiect_model->getAccountData($subiect->account_id);
							$time = $subiect_model->formatSubiectTime($subiect->date_time);
							$subiect_thanks = count($subiect_model->getSubiectThanks($subiect->id));
							$subiect_thanked = $subiect_model->subiectThanked($account->id, $subiect->id);
						?>
            <div class="post">
              <div class="post-title">
                <a href="<?php echo URL; ?>subiect/<?php echo $subiect->slug; ?>">
                  Subiect la <?php echo $materie_data->title; ?>, Anul <?php echo $subiect->anul; ?> - Semestrul <?php echo $subiect->semestrul; ?>
                </a>
              </div>
              <div class="post-user mt-lg-4 mb-lg-4 mt-4 mb-4">
                <div class="row">
                  <div class="col-lg-1 col-2 pr-lg-0 pr-0">
                    <div class="post-user-avatar vm">
											<a href="<?php echo URL; ?>user/<?php echo $account_data->username; ?>">
                        <img src="<?php echo URL; ?>public/img/account.png">
											</a>
                    </div>
                  </div>
                  <div class="col-lg-11 col-10">
                    <div class="vm">
                      <a href="<?php echo URL; ?>user/<?php echo $account_data->username; ?>">
                        <div class="post-user-username mb-lg-2 pl-lg-2 mb-2 pl-2"><?php echo $account_data->username; ?></div>
                        <div class="post-user-time pl-lg-2 pl-2"><?php echo $time; ?></div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="post-text">
                <a href="<?php echo URL; ?>subiect/<?php echo $subiect->slug; ?>">
                  <?php echo nl2br($subiect->description); ?>
                </a>
              </div>
              <div class="row mt-lg-4 mt-4">
                <div class="col-lg-6 col-6">
									<div class="post-thank">
										<div class="post-thank-icon thanks-btn <?php echo ($subiect_thanked == true ? 'subiect-thanked' : ''); ?> text-center" data-subiect-id="<?php echo $subiect->id; ?>" data-subiect-thanks="<?php echo $subiect_thanks; ?>">
											<span class="lnr lnr-heart vm"></span>
										</div>
										<div class="post-thank-text subiect-thanks ml-lg-2 ml-2" data-subiect-id="<?php echo $subiect->id; ?>"><span><?php echo $subiect_thanks; ?></span> <?php echo ($subiect_thanks > 0 ? ($subiect_thanks > 1 ? 'mulțumiri' : 'mulțumire') : 'mulțumiri'); ?></div>
									</div>
                </div>
                <div class="col-lg-6 col-6 text-right">
                  <div class="post-report">
                    <a href="<?php echo URL; ?>subiect/report/<?php echo $subiect->slug; ?>">
                      <div class="post-report-icon text-center">
                        <span class="lnr lnr-flag vm"></span>
                      </div>
                      <div class="post-report-text ml-lg-2 ml-2">Raportează</div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
						<?php $i++; ?>
						<?php if($i != count($subiecte)): ?>
							<div class="line-divider mt-lg-5 mb-lg-5 mt-5 mb-5"></div>
						<?php endif; ?>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="box">
            <div class="box-title mb-lg-2 mb-2">Nu s-au găsit subiecte pentru căutarea aceasta.</div>
            <div class="box-text mb-lg-4 mb-4">Fii tu cel care contribuie cu subiectul căutat și ajută ceilalți utilizatori la examene.</div>
            <a href="<?php echo URL; ?>subiect/post">
              <button class="btn btn-primary">Postează subiect</button>
            </a>
          </div>
        <?php endif; ?>
      </div>

		</div>
	</div>
</div>
