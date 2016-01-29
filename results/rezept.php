<?php foreach ($rezepte as $key => $rezept): ?>
<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="heading-<?php echo $key;?>">
		<h4 class="panel-title">
			<a role="button" data-toggle="collapse" data-parent="#accordion"
				href="#collapse-<?php echo $key;?>"
				aria-expanded="<?php if ($key == 0) {echo "true";}else {echo "false";}?>"
				aria-controls="collapse-<?php echo $key;?>">
                <?php echo $rezept->get('rezept:RezeptName');?>
              </a>
		</h4>
	</div>
	<div id="collapse-<?php echo $key;?>"
		class="panel-collapse collapse <?php if ($key == 0) echo 'in'; ?>"
		role="tabpanel" aria-labelledby="heading-<?php echo $key;?>">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-2">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Bild</h3>
						</div>
						<ul class="list-group">
							<li class="list-group-item">
							<img src="<?php echo $rezept->get('rezept:RezeptBild');?>">
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-5">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Info</h3>
						</div>
						<div class="panel-body">
							<ul class="list-group">
								<li class="list-group-item"><?php echo $rezept->get('rezept:RezeptName2');?></li>
								<li class="list-group-item">Kalorien <span class="badge">140
										kcal</span></li>
								<li class="list-group-item">Fett<span class="badge">10 g</span></li>
								<li class="list-group-item preis">Preis<span class="badge">0</span></li>
							</ul>
						</div>
					</div>

				</div>
				<div class="col-md-5">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Zubereitung</h3>
						</div>
						<div class="panel-body">
							<ul class="list-group">
								<li class="list-group-item">Arbeitszeit: ca. 30 min</li>
								<li class="list-group-item">Schwierigkeit: <?php echo $rezept->get('rezept:rezept_schwierigkeit');?></li>
								<li class="list-group-item">Portionen: <?php echo $rezept->get('rezept:rezept_user_portionen');?></li>
							</ul>
						</div>
					</div>

				</div>
			</div>
			<div class="clearfix">
				<button class="pull-right btn btn-primary" type="button"
					data-toggle="collapse"
					data-target="#collapse-more-<?php echo $key;?>"
					aria-expanded="false"
					aria-controls="collapse-more-<?php echo $key;?>">mehr ...</button>
			</div>
			<div class="row clearfix collapse"
				id="collapse-more-<?php echo $key;?>">
				<div class="row">
					<div class="col-md-6">
						<div class="panel-<?php echo $key;?> panel-default">
							<!-- Default panel contents -->
							<div class="panel-heading">Zutaten</div>
							<!-- Table -->
							<table id="countit-<?php echo $key;?>" class="table">
								<tr>
									<th>Name</th>
									<th>Menge</th>
									<th>Produkt</th>
									<th>Preis</th>
									<th>Alergene</th>
									<th>Kohlenhydrate</th>
								</tr>
                          <?php	include 'results/ingridient.php'; ?>
							</table>
						</div>
					</div>
					<div class="col-md-6">
						<p>
                      <?php echo htmlentities($rezept->get('rezept:rezept_zubereitung'),ENT_QUOTES | ENT_IGNORE, "UTF-8");?>
                        
                      </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endforeach;?>
