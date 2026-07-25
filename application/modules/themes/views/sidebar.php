<div class="hide-on-med-and-down">
	<ul id="slide-out" class="sidenav sidenav-fixed">
		<li>
    		<a href="<?= base_url();?>dashboard" class="collapsible-header"><i class="fa fa-th-large icon-menu"></i> Dashboard</a>
  		</li>
  		<?php
  			if(is_access() == 1){
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
	</ul>
</div>
