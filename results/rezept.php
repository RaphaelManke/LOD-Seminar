<!DOCTYPE html>
<head>
<title>Hungerkiller - Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/page.js" type="text/javascript"></script>
        <style>
            body {
                padding-top: 60px;
                padding-bottom: 20px;
            }
        </style>

</head>
<body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
               <div class="navbar-header">
                  <ul>
                      <li class="pull-left">
                         <a class="navbar-brand" href="#">Hungerkiller</a> 
                      </li>
                  </ul> 
               </div> 
            </div>
        </nav>

	<div class="container">
		<div class="row">
			<div class="panel-group" id="accordion" role="tablist"
				aria-multiselectable="true">

<?php foreach ($rezepte as $key => $rezept): ?>
<div class="panel panel-default">
					<div class="panel-heading" role="tab"
						id="heading-<?php echo $key;?>">
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
											<li class="list-group-item"><img
												src="<?php echo $rezept->get('rezept:RezeptBild');?>"></li>
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
												<li class="list-group-item kalorien">Kalorien <span class="badge"></span></li>
												<li class="list-group-item preis">Preis<span class="badge">0</span></li>
												<li class="list-group-item zucker">Zucker<span class="badge">0</span></li>
												<li class="list-group-item fett">Fett<span class="badge">0</span></li>
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
												<li class="list-group-item">Arbeitszeit: <?php echo $rezept->get('rezept:Minuten');?> min</li>
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
									<div class="col-md-12">
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
													<th>Kohlenhydrate (g)</th>
													<th>Kalorien (kcal)</th>
													<th>Zucker (g)</th>
													<th>Fett (g)</th>
												</tr>
                          <?php	include 'results/ingridient.php'; ?>
							</table>
										</div>
									</div>
									<div class="col-md-12">
										<p>
                      <?php echo htmlentities($rezept->get('rezept:rezept_zubereitung'),ENT_QUOTES | ENT_IGNORE, "UTF-8");?>
                        
                      </p>									
                      <a href="<?php echo $rezept->get('rezept:rezept_frontend_url');?>" role="button" class="btn btn-danger">Auf Chefkoch.de ansehen</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php endforeach;?>
        </div>
		</div>
	</div>
       <div class="footer">
           <footer>LOD-Seminar @ 2016 aifb.kit.edu</footer>
           <a href="<?php echo '/frontend/output/'.$suchbegriff.'.nt';?>">Link</a>
       </div>

</body>
</html>
