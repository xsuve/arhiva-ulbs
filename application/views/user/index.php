<!-- Dashboard -->
<div class="container-fluid section">
	<div class="container user-container">
		<div class="row">

      <div class="col-lg-2 col-3">
        <div class="user-profile">
          <img src="<?php echo URL; ?>public/img/account.png">
        </div>
      </div>
      <div class="col-lg-7 col-9">
        <div class="vm">
          <div class="user-username"><?php echo $user->username; ?>
						<?php if($user->username == 'xsuve' || $user->username == 'GhostShadow' || $user->username == 'Scay0x' || $user->username == 'ReghelePoo'): ?>
							<div class="user-badge-wrapper d-lg-inline-block d-inline-block ml-lg-3 ml-3 user-rank">
			          <div class="user-badge">ELITĂ</div>
			        </div>
						<?php endif; ?>
					</div>
          <div class="user-text mt-lg-2 mt-2">membru din <?php echo strftime('%e %B, %Y', strtotime($user->signup_date)); ?></div>
        </div>
      </div>
      <div class="col-lg-3 col-12 text-lg-right text-left mt-lg-0 mt-5">
        <div class="user-badge-wrapper vm">
          <div class="user-badge mr-lg-2 mr-2"><?php echo count($user_subiecte); ?></div> <span><?php echo (count($user_subiecte) > 0 ? (count($user_subiecte) > 1 ? 'subiecte postate' : 'subiect postat') : 'subiecte postate'); ?></span>
        </div>
      </div>

		</div>
    <div class="line-divider mt-lg-5 mb-lg-5 mt-5 mb-5"></div>
    <?php if(count($user_subiecte) > 0): ?>
      <div class="row">
        <?php foreach($user_subiecte as $user_subiect): ?>
          <?php
            $materie_data = $subiect_model->getMaterieData($user_subiect->materie_id);
          ?>
          <div class="col-lg-4 col-12 mb-lg-4 mt-4">
            <a href="<?php echo URL; ?>subiect/<?php echo $user_subiect->slug; ?>">
              <div class="user-subiect">
                <div class="user-subiect-image">
                  <img src="<?php echo $user_subiect->image; ?>">
                </div>
                <div class="user-subiect-title mt-lg-3 mt-3">Subiect la <?php echo $materie_data->title; ?>, Anul <?php echo $user_subiect->anul; ?> - Semestrul <?php echo $user_subiect->semestrul; ?></div>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="user-text">Niciun subiect postat.</div>
    <?php endif; ?>
	</div>
</div>
