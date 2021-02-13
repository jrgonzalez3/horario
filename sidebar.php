	<!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar  hidden-print">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<?php
                        $url = $_SERVER['REQUEST_URI'];
                        if (false !== strpos($url, 'cpanel')) {
                            $active_cpanel = 'active';
                        } else {
                            $active_cpanel = '';
                        }
                        if (false !== strpos($url, 'reporte_fechas')) {
                            $active_reporte = 'active';
                        } else {
                            $active_reporte = '';
                        }
                         ?>
						<li><a class="<?php echo $active_cpanel; ?>" href="./cpanel.php"><i class="lnr lnr-dice"></i> <span>Marcaciones</span></a></li>
						<li><a class="<?php echo $active_reporte; ?>"  href="./reporte_fechas.php"><i class="lnr lnr-cog"></i> <span>Reporte</span></a></li>
						
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->