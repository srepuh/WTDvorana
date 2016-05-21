<?php
//za testiranje/*
	function debug_to_console( $data ) {
		if ( is_array( $data ) )
			$output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
		else
			$output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
		echo $output;
	}//*/
		
	function greska($greska)
	{
		echo '<span id="greska1" style="color:red;text-align:center;">'.$greska.'</span>';	
	}

	//Check if the form has been submitted 	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
		//display the information that was submitted in the form 
		//echo "Greska" , $_POST['username'], " ",  $_POST['pass']; 
		header('Location: ' . $_SERVER['HTTP_REFERER']);     
		//???header("location:javascript://history.go(-1)");
	}else{ 
		//the form has not been submitted so display the form instead. 
	}

	
	session_start();
	$username="";
	$_SESSION['loginFormVisible']='true';

	if(isset($_SESSION['username'])){
		$username=$_SESSION['username'];
		$_SESSION['loginFormVisible']='false';
	}elseif(isset($_REQUEST['username'])){
		getFromFile();
	}
	//print_r($_SESSION);
	function getFromFile(){
		$redovi=file("login.csv");
		foreach($redovi as $r){
			$celije=explode(',',$r);
			if(isset($_REQUEST['username']) && isset($_REQUEST['pass'])){
				$user=$celije[0];
				$pass=$celije[1];
				$passHash=md5($_REQUEST['pass']);
				if($user==$_REQUEST['username'] && $passHash==$pass){
					$_SESSION['loginFormVisible']='false';
					$username=$_REQUEST['username'];
					$_SESSION['username']=$username;						
				}else{
					greska("Pogresan username i sifra!");
				}
			}else{
				greska("Niste unijeli username!");
			}
		}
	}

	if(isset($_REQUEST['odjava'])){
		$_SESSION['loginFormVisible']='true';
		session_destroy();
	}
	
	?>
	
	<?php
		if ($_SESSION['loginFormVisible']==='true')
		{
		?>
			<div id="login">
				<form id="loginForm" action="stranice/login.php" method="POST">
					<div class="ineline">
						<p class="ineline tbprijava">Username:</p>
						<input type="text" name="username" value="">	
					</div>
					<div class="ineline">
						<p class="ineline tbprijava">Sifra:</p>
						<input type="password" name="pass" value="">
					</div>
					<div class="ineline">
						<input class="btnPrijava" type="submit" name="login" value="Prijavi se">
					</div>
				</form>
			</div>
		<?php 
		}else{ 
		?>
		<div id="logout">
			<?php
			
			//ovo ne radi moram popraviti
			$url="$_SERVER[REQUEST_URI]";
			if($url!="/wt" || $url!="/wt/index.php"){
				?>
			<form method="post" action="stranice/login.php">
				<input class="btnPrijava" name="odjava" value="Odjavi se" type="submit"/>
			</form>
			<?php }
			else{ ?>
			<form method="post" action="login.php">
				<input class="btnPrijava" name="odjava" value="Odjavi se" type="submit"/>
			</form>

				<?php
			}
			?>
		</div>
		<?php
		}	
		?>		
		