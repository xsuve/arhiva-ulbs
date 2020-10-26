<!-- Dashboard -->
<div class="container-fluid section">
	<div class="container">
		<div class="row">

      <!-- Left -->
      <div class="col-lg-7 col-12">
				<div class="box box-secondary">
          <div class="box-title mb-lg-2 mb-2">Contribuie la îmbunătățirea platformei!</div>
          <div class="box-text mb-lg-4 mb-4">Platforma se alfă încă în faza de început, iar anumite caracteristici nu sunt disponibile. Astfel, poti contribui la adaugarea acestor caracteristici pentru a dezvolta platforma cât mai eficient. Contactează-ne la adresa: arhiva-ulbs@xsuve.com</div>
					<a href="<?php echo URL; ?>support">
						<button class="btn btn-primary">Contactează-ne</button>
					</a>
        </div>
				<div class="line-divider mt-lg-5 mb-lg-5 mt-5 mb-5"></div>
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
            <div class="box-title mb-lg-2 mb-2">Nu s-au postat subiecte până acum.</div>
            <div class="box-text mb-lg-4 mb-4">Fii tu cel care contribuie cu primul subiect din arhivă și ajută ceilalți utilizatori la examene.</div>
            <a href="<?php echo URL; ?>subiect/post">
              <button class="btn btn-primary">Postează subiect</button>
            </a>
          </div>
        <?php endif; ?>
      </div>

      <!-- Right -->
      <div class="col-lg-5 col-12 mt-5 mt-lg-0">
				<?php if($invitation && $invitation->invitation_used == false): ?>
					<div class="box box-success box-margin p-lg-4 mb-lg-5 p-4 mb-5">
						<div class="box-icon mb-lg-4 mb-4"><span class="lnr lnr-envelope"></span></div>
	          <div class="box-title mb-lg-2 mb-2">Ai o invitație nefolosită!</div>
	          <div class="box-text mb-lg-4 mb-4">Folosește-ți codul de invitație pentru a adăuga un nou utilizator în platformă.</div>
						<div class="badge-c badge-light p-lg-3 p-3 d-block d-lg-block">
							<input type="text" value="<?php echo $invitation->invitation_code; ?>" id="invitationInput" class="invitation-input" readonly="readonly">
							<button class="badge-button" id="copyInvitationBtn">
								<span class="lnr lnr-link"></span>
							</button>
						</div>
	        </div>
				<?php endif; ?>
        <div class="box box-primary box-margin p-lg-4 p-4">
          <div class="box-icon mb-lg-4 mb-4"><span class="lnr lnr-star"></span></div>
          <div class="box-title mb-lg-2 mb-2">Se caută un model de examen la Programare Orientată pe Obiecte!</div>
          <div class="box-text mb-lg-4 mb-4">Mai mulți utilizatori caută un model de subiect la Programare Orientată pe Obiecte. Crezi că poți rezolva această problemă cu un subiect?</div>
          <a href="<?php echo URL; ?>subiect/post">
            <button class="btn btn-light">Postează subiect</button>
          </a>
        </div>
      </div>

		</div>
	</div>
</div>
