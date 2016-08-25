<!DOCTYPE>
<!-- Connect to the database -->
<?php
	include("includes/db.php");
?>

<!-- This page is for administration to add new fish regulations to the database -->
<html>
	<head>
		<title>Inserting New Regulation</title>
		
		<!-- used for text editor to add new regulation -->
		<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
		<script>tinymce.init({selector:'textarea'});</script>
	</head>
	
	<body bgcolor="#00FF80">

		<form action="insert_new_reg.php" method="post" enctype="multipart/form-data">
		
			<table align="center" width= "700px" border="2px" bgcolor="gold">
			
				<tr align="center">
					<td colspan="2"><h2>Add a Regulation</h2></td>
				</tr>
				
				<tr>
					<td align="right"><b>Fish Name:</b></td>
					<td><input type="text" name="fish_name" size="60" required /></td>
				</tr>
				
				<tr>
					<td align="right"><b>Fish Sort Name:</b></td>
					<td><input type="text" name="fish_sort_name" size="60" required /></td>
				</tr>
				
				<tr>
					<td align="right"><b>State of Regulation:</b></td>
					<td>
						<select name="fish_state" required >
							<option>Select a State</option>
							<?php
								
								$get_states = "select * from states";
								$run_states = mysqli_query($con, $get_states);
								
								while($row_states=mysqli_fetch_array($run_states)){
								
									$state_id = $row_states['state_id'];
									$state_name = $row_states['state_name'];
									
									echo "<option value='$state_id'>$state_name</option>";
								}
								
							?>
						</select>
					</td>
				</tr>
				
				<tr>
					<td align="right"><b>Fish Species:</b></td>
					<td>
						<select name="fish_species" required >
							<option>Select a Species</option>
							<?php
	
								$get_species = "select * from species";
								$run_species = mysqli_query($con, $get_species);
								
								while($row_species=mysqli_fetch_array($run_species)){
								
									$species_id = $row_species['species_id'];
									$species_name = $row_species['species_name'];
									
									echo "<option value='$species_id'>$species_name</option>";
								}
							?>
						</select>
					</td>
				</tr>
				
				<tr>
					<td align="right"><b>Water Type:</b></td>
					<td>
						<select name="fish_water" required >
							<option>Select a water</option>
							<?php
	
								$get_water = "select * from water";
								$run_water = mysqli_query($con, $get_water);
								
								while($row_water=mysqli_fetch_array($run_water)){
								
									$water_id = $row_water['water_id'];
									$water_type = $row_water['water_type'];
									
									echo "<option value='$water_id'>$water_type</option>";
								}
							?>
						</select>
					</td>
				</tr>
				
				<tr>
					<td align="right"><b>Fish Image:</b></td>
					<td><input type="file" name="fish_image" required /></td>
				</tr>
				
				<tr>
					<td align="right"><b>Closed Season:</b></td>
					<td><textarea name="fish_season" cols="20" rows="5" ></textarea></td>
				</tr>
				
				<tr>
					<td align="right"><b>Size Limit:</b></td>
					<td><textarea name="fish_size" cols="20" rows="5" ></textarea></td>
				</tr>
				
				<tr>
					<td align="right"><b>Bag Limit:</b></td>
					<td><textarea name="fish_bag" cols="20" rows="5" ></textarea></td>
				</tr>
				
				<tr>
					<td align="right"><b>Comments:</b></td>
					<td><textarea name="fish_comments" cols="20" rows="5" ></textarea></td>
				</tr>
				
				<tr>
					<td align="right"><b>Legal Gear:</b></td>
					<td><input type="text" name="fish_gear" size="60" required /></td>
				</tr>
				
				<tr>
					<td align="right"><b>Edibility:</b></td>
					<td><input type="text" name="fish_edibility" size="60" required /></td>
				</tr>
				
				<tr>
					<td align="right"><b>Wildlife Link:</b></td>
					<td><input type="text" name="fish_link" size="60" required /></td>
				</tr>
				
				<tr>
					<td align="right"><b>Keywords:</b></td>
					<td><input type="text" name="fish_keywords" size="60" required /></td>
				</tr>
				
				<tr align="center">
					<td colspan="2"><input type="submit" name="insert_reg" value="Insert New Regulation" /></td>
				</tr>
				
			</table>
		
		</form>


	</body>
</html>


<!-- This will insert the fish regulations into the database -->
<?php 

	if(isset($_POST['insert_reg'])){
		
		// getting the text data from the fields
		$fish_name     = $_POST['fish_name'];
		$fish_sort_name= $_POST['fish_sort_name'];
		$fish_state    = $_POST['fish_state'];
		$fish_species  = $_POST['fish_species'];
		$fish_water  = $_POST['fish_water'];
		$fish_season   = $_POST['fish_season'];
		$fish_size     = $_POST['fish_size'];
		$fish_bag      = $_POST['fish_bag'];
		$fish_gear     = $_POST['fish_gear'];
		$fish_edibility= $_POST['fish_edibility'];
		$fish_comments = $_POST['fish_comments'];
		$fish_link     = $_POST['fish_link'];
		$fish_keywords = $_POST['fish_keywords'];
		
		
		// getting the image from the fields
		$fish_image = $_FILES['fish_image']['name'];
		$fish_image_tmp = $_FILES['fish_image']['tmp_name'];
		
		
		// move image to a file in an image folder within the administrator folder
		move_uploaded_file($fish_image_tmp,"fish_images/$fish_image");
		
		
		// build a variable with all of the information of a new fish regulation
		$insert_product = "insert into regulations (fish_name, fish_sort_name, fish_state, fish_species, fish_water, fish_image, fish_season, fish_size, fish_bag, fish_gear, fish_edibility, fish_comments, fish_link, fish_keywords) values ('$fish_name', '$fish_sort_name', '$fish_state', '$fish_species', '$fish_water', '$fish_image', '$fish_season', '$fish_size', '$fish_bag', '$fish_gear', '$fish_edibility', '$fish_comments', '$fish_link', '$fish_keywords')";
		
		
		// insert product into the database
		$insert_pro = mysqli_query($con, $insert_product);
		
		// inform the user the product has been added to the database
		if($insert_pro){
			echo "<script>alert('Product Has Been Inserted!')</script>";
			echo "<script>window.open('insert_new_reg.php','_self')</script>";
		}
	}















?>
