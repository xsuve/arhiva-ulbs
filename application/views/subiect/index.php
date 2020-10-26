<!-- Dashboard -->
<div class="container-fluid section">
	<div class="container">
		<div class="row">

      <!-- Left -->
      <div class="col-lg-7 col-12">
				<div class="post">
					<div class="post-title">
						Subiect la <?php echo $materie_data->title; ?>, Anul <?php echo $subiect->anul; ?> - Semestrul <?php echo $subiect->semestrul; ?>
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
						<?php echo nl2br($subiect->description); ?>
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
      </div>

      <!-- Right -->
      <div class="col-lg-5 col-12 mt-5 mt-lg-0">
        <div class="box box-secondary box-margin">
					<a href="<?php echo $subiect->image; ?>" target="_blank">
          	<div class="post-image mb-lg-4 mb-4">
							<img src="<?php echo $subiect->image; ?>">
						</div>
					</a>
					<a href="<?php echo URL; ?>subiect/download/<?php echo $subiect->slug; ?>">
          	<button class="btn btn-primary">Downloadează subiect</button>
					</a>
        </div>
      </div>

		</div>
	</div>
</div>
