<?php

	// upload
	// $con = mysqli_connect("snaghookcom.domaincommysql.com","fishawk","STONEcrabs469$","snaghook");

	// Local
	$con = mysqli_connect("localhost","root","","snaghook");

	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL".mysqli_connect_error();
	}

/**
 * This function is to display the different states
 */
function getStates(){

	global $con;

	$get_states = "select * from states";
	$run_states = mysqli_query($con, $get_states);

	while($row_states=mysqli_fetch_array($run_states)){

		$state_id = $row_states['state_id'];
		$state_name = $row_states['state_name'];

		echo "<li><a href='index.php?cat=$state_id'>$state_name</a></li>";
	}

}

/**
 * This function is to display the different species of fish
 */
function getSpecies(){

	global $con;

	$get_species = "select * from species order by species_name";
	$run_species = mysqli_query($con, $get_species);

	while($row_species=mysqli_fetch_array($run_species)){

		$species_id = $row_species['species_id'];
		$species_name = $row_species['species_name'];

		echo "<li><a href='index.php?species=$species_id'><label>$species_name</label></a></li>";
	}

}


/**
 * This function is to display all images from the database to select a regulation
 */
function getFish(){

	if(!isset($_GET['species'])){
		if(!isset($_GET['search'])){
			if(!isset($_GET['fish_id'])){
				if(!isset($_GET['page'])){
					global $con;

					$get_fish = "select * from regulations order by fish_sort_name";

					$run_fish = mysqli_query($con, $get_fish);

					while($row_fish = mysqli_fetch_array($run_fish)){

						$fish_id       = $row_fish['fish_id'];
						$fish_name     = $row_fish['fish_name'];
						$fish_sort_name= $row_fish['fish_sort_name'];
						$fish_state    = $row_fish['fish_state'];
						$fish_species  = $row_fish['fish_species'];
						$fish_water    = $row_fish['fish_water'];
						$fish_image    = $row_fish['fish_image'];
						$fish_season   = $row_fish['fish_season'];
						$fish_size     = $row_fish['fish_size'];
						$fish_bag      = $row_fish['fish_bag'];
						$fish_gear     = $row_fish['fish_gear'];
						$fish_edibility= $row_fish['fish_edibility'];
						$fish_comments = $row_fish['fish_comments'];
						$fish_link     = $row_fish['fish_link'];
						$fish_keywords = $row_fish['fish_keywords'];

						// for Medium and large devices
						echo "
							<div class='single_fish_md col-md-3 hidden-sm hidden-xs text-center'>
								<a href='index.php?fish_id=$fish_id'>
								<img class='center-block img-responsive img-rounded' src='admin_area/fish_images/$fish_image'/>
								<h3>$fish_name</h3>
								</a>
							</div>
						";
						// for small devices
						echo "
							<div class='single_fish_sm hidden-lg hidden-md col-sm-6 hidden-xs text-center'>
								<a href='index.php?fish_id=$fish_id'>
								<img class='center-block img-responsive img-rounded' src='admin_area/fish_images/$fish_image'/>
								<h2>$fish_name</h2>
								</a>
							</div>
						";
						// for extra small devices
						echo "
							<div class='single_fish_xs hidden-lg hidden-md hidden-sm col-xs-12 text-center'>
								<a href='index.php?fish_id=$fish_id'>
								<img class='center-block img-responsive img-rounded' src='admin_area/fish_images/$fish_image'/>
								<h1>$fish_name</h1>
								</a>
							</div>
						";
					}
				}
			}
		}
	}
}


/**
 * This function is to display all images from the database to select a regulation
 */
function getFishSpecies(){

	if(!isset($_GET['page'])){
		if(!isset($_GET['search'])){
			if(!isset($_GET['fish_id'])){
				if(isset($_GET['species'])){

					$species_id = $_GET['species'];

					global $con;


					$get_fish = "select * from regulations where fish_species='$species_id' order by fish_sort_name";

					$run_fish = mysqli_query($con, $get_fish);

					while($row_fish = mysqli_fetch_array($run_fish)){

						$fish_id       = $row_fish['fish_id'];
						$fish_name     = $row_fish['fish_name'];
						$fish_sort_name= $row_fish['fish_sort_name'];
						$fish_state    = $row_fish['fish_state'];
						$fish_species  = $row_fish['fish_species'];
						$fish_water    = $row_fish['fish_water'];
						$fish_image    = $row_fish['fish_image'];
						$fish_season   = $row_fish['fish_season'];
						$fish_size     = $row_fish['fish_size'];
						$fish_bag      = $row_fish['fish_bag'];
						$fish_gear     = $row_fish['fish_gear'];
						$fish_edibility= $row_fish['fish_edibility'];
						$fish_comments = $row_fish['fish_comments'];
						$fish_link     = $row_fish['fish_link'];
						$fish_keywords = $row_fish['fish_keywords'];
						
						// for Medium and large devices
						echo "
							<div class='single_fish_md col-md-4 hidden-sm hidden-xs text-center'>
								<a href='index.php?fish_id=$fish_id'>
								<img class='center-block img-responsive img-rounded' src='admin_area/fish_images/$fish_image'/>
								<h3>$fish_name</h3>
								</a>
							</div>
						";
						// for small devices
						echo "
							<div class='single_fish_sm hidden-lg hidden-md col-sm-6 hidden-xs text-center'>
								<a href='index.php?fish_id=$fish_id'>
								<img class='center-block img-responsive img-rounded' src='admin_area/fish_images/$fish_image'/>
								<h2>$fish_name</h2>
								</a>
							</div>
						";
						// for extra small devices
						echo "
							<div class='single_fish_xs hidden-lg hidden-md hidden-sm col-xs-12 text-center'>
								<a href='index.php?fish_id=$fish_id'>
								<img class='center-block img-responsive img-rounded' src='admin_area/fish_images/$fish_image'/>
								<h1>$fish_name</h1>
								</a>
							</div>
						";
					}
				}
			}
		}
	}
}


/*
 * This function is to display fish by page numbers
 */
function getFishByPage(){

	if(!isset($_GET['species'])){
		if(!isset($_GET['search'])){
			if(!isset($_GET['fish_id'])){
				if(isset($_GET['page'])){
					global $con;

					$page = $_GET['page'];
					if( $page == 1)
					{
						$get_fish = "select * from regulations where fish_id between 1 and 18 order by fish_sort_name";
					}
					else if( $page == 2)
					{
						$get_fish = "select * from regulations where fish_id between 19 and 36 order by fish_sort_name";
					}
					else if( $page == 3)
					{
						$get_fish = "select * from regulations where fish_id between 37 and 54 order by fish_sort_name";
					}
					else if( $page == 4)
					{
						$get_fish = "select * from regulations where fish_id between 55 and 72 order by fish_sort_name";
					}
					else if( $page == 5)
					{
						$get_fish = "select * from regulations where fish_id between 73 and 90 order by fish_sort_name";
					}
					else if( $page == 6)
					{
						$get_fish = "select * from regulations where fish_id between 91 and 108 order by fish_sort_name";
					}
					else if( $page == 7)
					{
						$get_fish = "select * from regulations where fish_id between 109 and 126 order by fish_sort_name";
					}
					else if( $page == 8)
					{
						$get_fish = "select * from regulations where fish_id between 127 and 142 order by fish_sort_name";
					}
					$run_fish = mysqli_query($con, $get_fish);

					while($row_fish = mysqli_fetch_array($run_fish)){

						$fish_id       = $row_fish['fish_id'];
						$fish_name     = $row_fish['fish_name'];
						$fish_sort_name= $row_fish['fish_sort_name'];
						$fish_state    = $row_fish['fish_state'];
						$fish_species  = $row_fish['fish_species'];
						$fish_water    = $row_fish['fish_water'];
						$fish_image    = $row_fish['fish_image'];
						$fish_season   = $row_fish['fish_season'];
						$fish_size     = $row_fish['fish_size'];
						$fish_bag      = $row_fish['fish_bag'];
						$fish_gear     = $row_fish['fish_gear'];
						$fish_edibility= $row_fish['fish_edibility'];
						$fish_comments = $row_fish['fish_comments'];
						$fish_link     = $row_fish['fish_link'];
						$fish_keywords = $row_fish['fish_keywords'];

						
						// for Medium and large devices
						echo "
							<div class='single_fish_md col-md-4 hidden-sm hidden-xs text-center'>
								<a href='index.php?fish_id=$fish_id'>
								<img class='center-block img-responsive img-rounded' src='admin_area/fish_images/$fish_image'/>
								<h3>$fish_name</h3>
								</a>
							</div>
						";
						// for small devices
						echo "
							<div class='single_fish_sm hidden-lg hidden-md col-sm-6 hidden-xs text-center'>
								<a href='index.php?fish_id=$fish_id'>
								<img class='center-block img-responsive img-rounded' src='admin_area/fish_images/$fish_image'/>
								<h2>$fish_name</h2>
								</a>
							</div>
						";
						// for extra small devices
						echo "
							<div class='single_fish_xs hidden-lg hidden-md hidden-sm col-xs-12 text-center'>
								<a href='index.php?fish_id=$fish_id'>
								<img class='center-block img-responsive img-rounded' src='admin_area/fish_images/$fish_image'/>
								<h1>$fish_name</h1>
								</a>
							</div>
						";
					}
				}
			}
		}
	}
}

/* 
 * This function is to display all images of fish by a search result. The search
 * result can be either the name, species, or features of a fish.
 */
function getResults(){


	if(!isset($_GET['species'])){
		if(!isset($_GET['page'])){
			if(!isset($_GET['fish_id'])){
				if(isset($_GET['search'])){

					global $con;

					$search_query = trim($_GET['user_query']);

					if((strlen($search_query) > -1 && strlen($search_query) < 3)){
						echo"<h2>The default search is fish. Please, refine your search.</h2>";
						$search_query = 'fish';
					} else if(strlen($search_query) > 2){
						if(!ctype_print($search_query) || ctype_space($search_query) ||
							ctype_digit($search_query) || ctype_punct($search_query)){
							echo"<h4>The default search is fish. Please, refine your search.</h4>";
							$search_query = 'fish';
						}
					}
					$get_fish = "select * from regulations where fish_keywords like '%$search_query%'";

					$run_fish = mysqli_query($con, $get_fish);

					while($row_fish = mysqli_fetch_array($run_fish)){

						$fish_id       = $row_fish['fish_id'];
						$fish_name     = $row_fish['fish_name'];
						$fish_sort_name= $row_fish['fish_sort_name'];
						$fish_state    = $row_fish['fish_state'];
						$fish_species  = $row_fish['fish_species'];
						$fish_water    = $row_fish['fish_water'];
						$fish_image    = $row_fish['fish_image'];
						$fish_season   = $row_fish['fish_season'];
						$fish_size     = $row_fish['fish_size'];
						$fish_bag      = $row_fish['fish_bag'];
						$fish_gear     = $row_fish['fish_gear'];
						$fish_edibility= $row_fish['fish_edibility'];
						$fish_comments = $row_fish['fish_comments'];
						$fish_link     = $row_fish['fish_link'];
						$fish_keywords = $row_fish['fish_keywords'];

						
						// for Medium and large devices
						echo "
							<div class='single_fish_md col-md-4 hidden-sm hidden-xs text-center'>
								<a href='index.php?fish_id=$fish_id'>
								<img class='center-block img-responsive img-rounded' src='admin_area/fish_images/$fish_image'/>
								<h3>$fish_name</h3>
								</a>
							</div>
						";
						// for small devices
						echo "
							<div class='single_fish_sm hidden-lg hidden-md col-sm-6 hidden-xs text-center'>
								<a href='index.php?fish_id=$fish_id'>
								<img class='center-block img-responsive img-rounded' src='admin_area/fish_images/$fish_image'/>
								<h2>$fish_name</h2>
								</a>
							</div>
						";
						// for extra small devices
						echo "
							<div class='single_fish_xs hidden-lg hidden-md hidden-sm col-xs-12 text-center'>
								<a href='index.php?fish_id=$fish_id'>
								<img class='center-block img-responsive img-rounded' src='admin_area/fish_images/$fish_image'/>
								<h1>$fish_name</h1>
								</a>
							</div>
						";
					}
				}
			}
		}
	}
}


/* 
 * This function is to display the regulation of any one fish
 */
function getDetails(){


	if(!isset($_GET['species'])){
		if(!isset($_GET['page'])){
			if(!isset($_GET['search'])){

				if(isset($_GET['fish_id'])){
					global $con;

					$fish_id=$_GET['fish_id'];

					$get_fish = "select * from regulations where fish_id='$fish_id'";

					$run_fish = mysqli_query($con, $get_fish);

					while($row_fish = mysqli_fetch_array($run_fish)){

						//$fish_id       = $row_fish['fish_id'];
						$fish_name     = $row_fish['fish_name'];
						$fish_sort_name= $row_fish['fish_sort_name'];
						$fish_state    = $row_fish['fish_state'];
						$fish_species  = $row_fish['fish_species'];
						$fish_water    = $row_fish['fish_water'];
						$fish_image    = $row_fish['fish_image'];
						$fish_season   = $row_fish['fish_season'];
						$fish_size     = $row_fish['fish_size'];
						$fish_bag      = $row_fish['fish_bag'];
						$fish_gear     = $row_fish['fish_gear'];
						$fish_edibility= $row_fish['fish_edibility'];
						$fish_comments = $row_fish['fish_comments'];
						$fish_link     = $row_fish['fish_link'];
						$fish_keywords = $row_fish['fish_keywords'];

						// date("d-F-Y").

						ini_set('date.timezone', 'EST');
						$this_month = date("F");
						$this_day = date("j");
						$time_of_day = date("j F Y - g:i a",time());
						
						// Large and Medium Devices
						echo  "
							<div class='col-md-offset-3 col-md-6 hidden-sm hidden-xs' id='reg'>
								<table>
									<tr>
										<th>
											<h1>$fish_name</h1>
											<img class='center-block img-responsive img-rounded col-md-offset-3' src='admin_area/fish_images/$fish_image'/>
										</th>
									</tr>

									<tr>
										<td>
											</br>
											<a href='index.php?species=$fish_species' style='float:left;'>Same Species</a>
											</br>
										</td>
									</tr>
								</table>
							</div>
							";

							// Find the closed season and highlight it RED
							if(strpos($fish_season, "-"))
							{
								// get the month to the left of the '-'
								$month = substr($fish_season, (strpos($fish_season, "-") -14), 12);

								// get the day to the left of the '-'
								$close = trim(substr($fish_season, (strpos($fish_season, "-") -3 ), 2));

								// get the day to the right of the '-'
								$open = trim(substr($fish_season, (strpos($fish_season, "-")+1 ), 3));

								// check if the the season or opens in the middle of a month
								if(strpos($month, $this_month) && $close <= $this_day && $this_day <= $open)
								{
									echo  "
									<div class='col-md-offset-3 col-md-6 hidden-sm hidden-xs' id='reg'>
										<table>
											<tr>
												<td>
													<h3 class='season_closed'>Closed Season:</h3>
													$fish_season
												</td>
											</tr>
								</table>
										</div>";
								}
								else if(strpos($month, $this_month))
								{
									// another if else
									echo  "
									<div class='col-md-offset-3 col-md-6 hidden-sm hidden-xs' id='reg'>
										<table>
											<tr>
												<td>
													<h3>Closed Season:</h3>
													$fish_season
												</td>
											</tr>
								</table>
											</div>";
								}
								else if(strpos($fish_season, $this_month)|| strpos($fish_season, "Protected"))
								{
									echo  "
									<div class='col-md-offset-3 col-md-6 hidden-sm hidden-xs' id='reg'>
										<table>
											<tr>
												<td>
													<h3 class='season_closed'>Closed Season:</h3>
													$fish_season
												</td>
											</tr>
								</table>
											</div>";
								}
								else
								{
									echo  "
									<div class='col-md-offset-3 col-md-6 hidden-sm hidden-xs' id='reg'>
										<table>
											<tr>
												<td>
													<h3>Closed Season:</h3>
													$fish_season
												</td>
											</tr>
								</table>
											</div>";
								}

							}
							else if(strpos($fish_season, date("F"))|| strpos($fish_season, "Protected"))
							{
								echo  "
								<div class='col-md-offset-3 col-md-6 hidden-sm hidden-xs' id='reg'>
									<table>
										<tr>
											<td>
												<h3 class='season_closed'>Closed Season:</h3>
												$fish_season
											</td>
										</tr>
								</table>
										</div>";
							}
							else
							{
								echo  "
								<div class='col-md-offset-3 col-md-6 hidden-sm hidden-xs' id='reg'>
									<table>
										<tr>
											<td>
												<h3>Closed Season:</h3>
												$fish_season
											</td>
										</tr>
								</table>
										</div>";
							}
							echo  "
							<div class='col-md-offset-3 col-md-6 hidden-sm hidden-xs' id='reg'>
								<table>
									<tr>
										<td>
											<h3>Size Limit:</h3>
											$fish_size </br>
										</td>
									</tr>
									<tr>
										<td>
											<h3>Possession Limit:</h3>
											$fish_bag </br>
										</td>
									</tr>
									<tr>
										<td>
											<h3>Allowable Gear:</h3>
											<p>$fish_gear</p>
	 </br>
										</td>
									</tr>
									<tr>
										<td>
											<h3>Comments:</h3>
											$fish_comments </br>
										</td>
									</tr>
									<tr>
										<td>
											<h3>Edibility:</h3>
											<p>$fish_edibility </p>
	 </br>
										</td>
									</tr>
									<tr>
										<td>
											<a href='$fish_link' target='_blank'>Additional Details</a>
										</td>
									</tr>
								</table>
							</div>
						";
						
						
						// Small Devices
						echo  "
						<div class='col-sm-offset-2 col-sm-8 hidden-lg hidden-md hidden-xs' id='reg'>
							<table>
								<tr>
									<th>
										<h1>$fish_name</h1>
										<img class='center-block img-responsive img-rounded col-sm-offset-2' src='admin_area/fish_images/$fish_image'/>
									</th>
								</tr>

								<tr>
									<td>
										<a href='index.php?species=$fish_species' style='float:left;'>Same Species</a>
										</br>
									</td>
								</tr>
							</table>
								</div>
							";

							// Find the closed season and highlight it RED
							if(strpos($fish_season, "-"))
							{
								// get the month to the left of the '-'
								$month = substr($fish_season, (strpos($fish_season, "-") -14), 12);

								// get the day to the left of the '-'
								$close = trim(substr($fish_season, (strpos($fish_season, "-") -3 ), 2));

								// get the day to the right of the '-'
								$open = trim(substr($fish_season, (strpos($fish_season, "-")+1 ), 3));

								// check if the the season or opens in the middle of a month
								if(strpos($month, $this_month) && $close <= $this_day && $this_day <= $open)
								{
									echo  "
						<div class='col-sm-offset-2 col-sm-8 hidden-lg hidden-md hidden-xs' id='reg'>
							<table>
											<tr>
												<td>
													<h3 class='season_closed'>Closed Season:</h3>
													$fish_season
												</td>
											</tr>
								</table>
											</div>";
								}
								else if(strpos($month, $this_month))
								{
									// another if else
									echo  "
						<div class='col-sm-offset-2 col-sm-8 hidden-lg hidden-md hidden-xs' id='reg'>
							<table>
											<tr>
												<td>
													<h3>Closed Season:</h3>
													$fish_season
												</td>
											</tr>
								</table>
											</div>";
								}
								else if(strpos($fish_season, $this_month)|| strpos($fish_season, "Protected"))
								{
									echo  "
						<div class='col-sm-offset-2 col-sm-8 hidden-lg hidden-md hidden-xs' id='reg'>
							<table>
											<tr>
												<td>
													<h3 class='season_closed'>Closed Season:</h3>
													$fish_season
												</td>
											</tr>
								</table>
											</div>";
								}
								else
								{
									echo  "
						<div class='col-sm-offset-2 col-sm-8 hidden-lg hidden-md hidden-xs' id='reg'>
							<table>
											<tr>
												<td>
													<h3>Closed Season:</h3>
													$fish_season
												</td>
											</tr>
								</table>
											</div>";
								}

							}
							else if(strpos($fish_season, date("F"))|| strpos($fish_season, "Protected"))
							{
								echo  "
						<div class='col-sm-offset-2 col-sm-8 hidden-lg hidden-md hidden-xs' id='reg'>
							<table>
										<tr>
											<td>
												<h3 class='season_closed'>Closed Season:</h3>
												$fish_season
											</td>
										</tr>
								</table>
										</div>";
							}
							else
							{
								echo  "
						<div class='col-sm-offset-2 col-sm-8 hidden-lg hidden-md hidden-xs' id='reg'>
							<table>
										<tr>
											<td>
												<h3>Closed Season:</h3>
												$fish_season
											</td>
										</tr>
								</table>
										</div>";
							}
							echo  "
						<div class='col-sm-offset-2 col-sm-8 hidden-lg hidden-md hidden-xs' id='reg'>
							<table>
									<tr>
										<td>
											<h3>Size Limit:</h3>
											$fish_size </br>
										</td>
									</tr>
									<tr>
										<td>
											<h3>Possession Limit:</h3>
											$fish_bag </br>
										</td>
									</tr>
									<tr>
										<td>
											<h3>Allowable Gear:</h3>
											<p>$fish_gear</p>
	 </br>
										</td>
									</tr>
									<tr>
										<td>
											<h3>Comments:</h3>
											$fish_comments </br>
										</td>
									</tr>
									<tr>
										<td>
											<h3>Edibility:</h3>
											<p>$fish_edibility </p>
	 </br>
										</td>
									</tr>
									<tr>
										<td>
											<a href='$fish_link' target='_blank'>Additional Details</a>
										</td>
									</tr>
								</table>
							</div>
						";
						
						
						// Extra Small Devices
						echo  "
						<div class='col-xs-offset-1 col-xs-10 hidden-lg hidden-md hidden-sm' id='reg'>
							<table>
								<tr>
									<th>
										<h1>$fish_name</h1>
										<img class='center-block img-responsive img-rounded col-xs-offset-1 col-xs-10' src='admin_area/fish_images/$fish_image'/>
									</th>
								</tr>

								<tr>
									<td>
										<a href='index.php?species=$fish_species' style='float:left;'>Same Species</a>
										</br>
									</td>
								</tr>
							</table>
								</div>
							";

							// Find the closed season and highlight it RED
							if(strpos($fish_season, "-"))
							{
								// get the month to the left of the '-'
								$month = substr($fish_season, (strpos($fish_season, "-") -14), 12);

								// get the day to the left of the '-'
								$close = trim(substr($fish_season, (strpos($fish_season, "-") -3 ), 2));

								// get the day to the right of the '-'
								$open = trim(substr($fish_season, (strpos($fish_season, "-")+1 ), 3));

								// check if the the season or opens in the middle of a month
								if(strpos($month, $this_month) && $close <= $this_day && $this_day <= $open)
								{
									echo  "
						<div class='col-xs-offset-1 col-xs-10 hidden-lg hidden-md hidden-sm' id='reg'>
							<table>
											<tr>
												<td>
													<h3 class='season_closed'>Closed Season:</h3>
													$fish_season
												</td>
											</tr>
											</div>";
								}
								else if(strpos($month, $this_month))
								{
									// another if else
									echo  "
						<div class='col-xs-offset-1 col-xs-10 hidden-lg hidden-md hidden-sm' id='reg'>
							<table>
											<tr>
												<td>
													<h3>Closed Season:</h3>
													$fish_season
												</td>
											</tr>
											</div>";
								}
								else if(strpos($fish_season, $this_month)|| strpos($fish_season, "Protected"))
								{
									echo  "
						<div class='col-xs-offset-1 col-xs-10 hidden-lg hidden-md hidden-sm' id='reg'>
							<table>
											<tr>
												<td>
													<h3 class='season_closed'>Closed Season:</h3>
													$fish_season
												</td>
											</tr>
											</div>";
								}
								else
								{
									echo  "
						<div class='col-xs-offset-1 col-xs-10 hidden-lg hidden-md hidden-sm' id='reg'>
							<table>
											<tr>
												<td>
													<h3>Closed Season:</h3>
													$fish_season
												</td>
											</tr>
											</div>";
								}

							}
							else if(strpos($fish_season, date("F"))|| strpos($fish_season, "Protected"))
							{
								echo  "
						<div class='col-xs-offset-1 col-xs-10 hidden-lg hidden-md hidden-sm' id='reg'>
							<table>
										<tr>
											<td>
												<h3 class='season_closed'>Closed Season:</h3>
												$fish_season
											</td>
										</tr>
										</div>";
							}
							else
							{
								echo  "
						<div class='col-xs-offset-1 col-xs-10 hidden-lg hidden-md hidden-sm' id='reg'>
							<table>
										<tr>
											<td>
												<h3>Closed Season:</h3>
												$fish_season
											</td>
										</tr>
										</div>";
							}
							echo  "
						<div class='col-xs-offset-1 col-xs-10 hidden-lg hidden-md hidden-sm' id='reg'>
							<table>
									<tr>
										<td>
											<h3>Size Limit:</h3>
											$fish_size </br>
										</td>
									</tr>
									<tr>
										<td>
											<h3>Possession Limit:</h3>
											$fish_bag </br>
										</td>
									</tr>
									<tr>
										<td>
											<h3>Allowable Gear:</h3>
											<p>$fish_gear</p>
											</br>
										</td>
									</tr>
									<tr>
										<td>
											<h3>Comments:</h3>
											$fish_comments </br>
										</td>
									</tr>
									<tr>
										<td>
											<h3>Edibility:</h3>
											<p>$fish_edibility </p>
											</br>
										</td>
									</tr>
									<tr>
										<td>
											<a href='$fish_link' target='_blank'>Additional Details</a>
										</td>
									</tr>
								</table>
							</div>
						";
					}
				}
			}
		}
	}
}


/* 
 *
 */
function foot(){
	
	// date("d-F-Y").

	ini_set('date.timezone', 'EST');
	$this_month = date("F");
	$this_day = date("j");
	$time_of_day = date("j F Y - g:i a",time());
	echo "<p id:'text_color'>&copy; www.Snaghook.com from 27 November 2015 to $time_of_day</p>";
						
}

?>
