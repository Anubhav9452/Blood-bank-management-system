<?php 

	//include header file
	include ('include/header.php');
if(isset($_POST['SignIn']))
{
	       if(isset($_POST['email']) && !empty($_POST['email']) )
{
  $email=$_POST['email'];
}
else
{
  $emailerror ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>only plzz fill email id</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
   </div>'; 
}
if(isset($_POST['password']) && !empty($_POST['password']) )
{
  $password=$_POST['password'];
  
}
else
{
  $passworderror ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>only plzz fill your password</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
   </div>'; 
}


//login query
if(isset($email) && isset($password))
{
	$sql="select * from donor where password='$password' and email='$email' ";
	$result=mysqli_query($connec,$sql);
		if(mysqli_num_rows($result)>0)
		{
			while($row=mysqli_fetch_assoc($result))
			{
                 $_SESSION['user_id']=$row['id'];
                  $_SESSION['name']=$row['name'];
                   $_SESSION['save_life_date']=$row['save_life_date'];
                   header("location: user/index.php");
			}
		}
		else
		{

  $submiterror ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>sorry no record found</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
   </div>'; 

		}
	}
}

?>

<style>
	.size{
		min-height: 0px;
		padding: 60px 0 60px 0;

	}
	h1{
		color: white;
	}
	.form-group{
		text-align: left;
	}
	h3{
		color: #e74c3c;
		text-align: center;
	}
	.red-bar{
		width: 25%;
	}
	.form-container{
		background-color: white;
		border: .5px solid #eee;
		border-radius: 5px;
		padding: 20px 10px 20px 30px;
		-webkit-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
-moz-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
	}
</style>
 <div class="container-fluid red-background size">
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<h1 class="text-center">SignIn</h1>
			<hr class="white-bar">
		</div>
	</div>
</div>
<div class="conatiner size ">
	<div class="row">
		<div class="col-md-6 offset-md-3 form-container">
		<h3>SignIn</h3>
		<hr class="red-bar">
					<?php 
		if(isset($submiterror))
		{
			echo $submiterror;
		}
		?>
		
		<!-- Erorr Messages -->

			<form action="" method="post" >
				<div class="form-group">
					<label for="email">Email/Phone no.</label>
					<input type="text" name="email" class="form-control" placeholder="Email" required>
					<?php 
		if(isset($emailerror))
		{
			echo $emailerror;
		}
		?>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" placeholder="Password" required class="form-control">
					<?php 
		if(isset($passworderror))
		{
			echo $passworderror;
		}
		?>
				</div>
				<div class="form-group">
					<button class="btn btn-danger btn-lg center-aligned" type="submit" name="SignIn">SignIn</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include 'include/footer.php' ?>
