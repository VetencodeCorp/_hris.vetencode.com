<div class="navbar-fixed">
	<nav class="red darken-4" role="navigation">
		<div class="nav-wrapper">
			<a id="logo-container" href="<?= base_url();?>dashboard" class="brand-logo">vetencode</a>
			<ul class="right hide-on-med-and-down">
				<li>
					<a href="<?= base_url();?>profile" class="tooltipped" data-tooltip="Profile">
						<?= strtoupper(getUser()->fullname);?>
					</a>
				</li>
				<li>
					<a href="#form-logout" class="modal-trigger">
						<i class="fa fa-sign-out fa-2x tooltipped" data-tooltip="Log Out"></i>
					</a>
				</li>
			</ul>
	
			<ul id="nav-mobile" class="sidenav">
				<li>
					<a href="<?= base_url();?>profile" class="collapsible-header"><i class="fa fa-user-circle-o icon-menu"></i> <?= strtoupper(getUser()->fullname);?></a>
				</li>
				<hr>
				<li>
					<a href="<?= base_url();?>dashboard" class="collapsible-header"><i class="fa fa-th-large icon-menu"></i> Dashboard</a>
				</li>
				<?php
					if(is_access() ==  1){
				?>
				<li>
					<ul class="collapsible collapsible-accordion">
						<li>
							<a class="collapsible-header" tabindex="0"><i class="fa fa-th-list icon-menu"></i> Master Data <i class="fa fa-angle-right right icon-parent-menu"></i></a>
							<div class="collapsible-body">
								<ul>
									<?php
										if(is_access() == 1){
									?>
									<li class="child-menu">
										<a href="<?= base_url();?>akses">Akses</a>
									</li>
									<?php
										}
									?>
									<li class="child-menu">
										<a href="<?= base_url();?>user">User</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</li>

				<li>
					<a href="<?= base_url();?>kehadiran" class="collapsible-header"><i class="fa fa-check-square-o icon-menu"></i> Absen</a>
				</li>

				<li>
					<ul class="collapsible collapsible-accordion">
						<li>
							<a class="collapsible-header" tabindex="0"><i class="fa fa-money icon-menu"></i> Insentif <i class="fa fa-angle-right right icon-parent-menu"></i></a>
							<div class="collapsible-body">
								<ul>
									<li class="child-menu">
										<a href="<?= base_url();?>insentif-mingguan">Mingguan</a>
									</li>
									<?php
										if(is_access() == 1){
									?>
									<li class="child-menu">
										<a href="<?= base_url();?>insentif-gapok">Gaji Pokok</a>
									</li>
									<?php
										}
									?>
								</ul>
							</div>
						</li>
					</ul>
				</li>
				
				<li>
					<ul class="collapsible collapsible-accordion">
						<li>
							<a class="collapsible-header" tabindex="0"><i class="fa fa-info-circle icon-menu"></i> Report <i class="fa fa-angle-right right icon-parent-menu"></i></a>
							<div class="collapsible-body">
								<ul>
									<li class="child-menu">
										<a href="<?= base_url();?>report-absen">Absensi</a>
									</li>
									<li class="child-menu">
										<a href="<?= base_url();?>report-mingguan">Insentif Mingguan</a>
									</li>
									<?php
										if(is_access() == 1){
									?>
									<li class="child-menu">
										<a href="<?= base_url();?>report-gapok">Gaji Pokok</a>
									</li>
									<?php
										}
									?>
								</ul>
							</div>
						</li>
					</ul>
				</li>
				
				<?php
					}
				?>
				
				<?php
		  			if(is_access() == 2){
		  		?>
		  		<li>
					<ul class="collapsible collapsible-accordion">
						<li>
							<a class="collapsible-header" tabindex="0"><i class="fa fa-th-list icon-menu"></i> Master Data <i class="fa fa-angle-right right icon-parent-menu"></i></a>
							<div class="collapsible-body">
								<ul>
									<li class="child-menu">
										<a href="<?= base_url();?>user">User</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</li>
		  		<li>
		    		<a href="<?= base_url();?>kehadiran" class="collapsible-header"><i class="fa fa-check-square-o icon-menu"></i> Absen</a>
		  		</li>
		  		<li>
					<ul class="collapsible collapsible-accordion">
						<li>
							<a class="collapsible-header" tabindex="0"><i class="fa fa-money icon-menu"></i> Insentif <i class="fa fa-angle-right right icon-parent-menu"></i></a>
							<div class="collapsible-body">
								<ul>
									<li class="child-menu">
										<a href="<?= base_url();?>insentif-mingguan">Mingguan</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</li>
				<li>
					<ul class="collapsible collapsible-accordion">
						<li>
							<a class="collapsible-header" tabindex="0"><i class="fa fa-info-circle icon-menu"></i> Report <i class="fa fa-angle-right right icon-parent-menu"></i></a>
							<div class="collapsible-body">
								<ul>
									<li class="child-menu">
										<a href="<?= base_url();?>report-absen">Absensi</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</li>
		  		<?php
		  			}
		  		?>
				
				<!--
				<?php
					if(is_access() == 3){
				?>
				<li>
					<a href="<?= base_url();?>uang-mingguan" class="collapsible-header"><i class="fa fa-calendar-check-o icon-menu"></i> Insentif Mingguan</a>
				</li>
				<?php
					}
				?>
				-->
				<hr>
				<li>
					<a href="#form-logout" class="collapsible-header modal-trigger"><i class="fa fa-sign-out icon-menu"></i> Log Out</a>
				</li>
			</ul>
			<a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="fa fa-bars fa-2x"></i></a>
			<div class="right hide-on-large-only">
				
			</div>
		</div>
	</nav>
</div>

<div id="form-logout" class="modal modal-small">
	<div class="modal-content center">
		<p>
			<i class="fa fa-sign-out fa-5x"></i>
		</p>
		<h5>Apakah anda yakin ?</h5>
		<div class="row padt25">
			<div class="col s12">
				<a href="<?= base_url();?>login/logout" class="btn btn-submit col s12">ok</a>
			</div>
		</div>
	</div>
</div>