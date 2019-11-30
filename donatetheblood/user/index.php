
<?php 
	include 'include/header.php'; 
	if(isset($_POST['date']))
	{
		$showform ='	<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Do you want to delete this record?</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form target="" method="post">
                <br>
                <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'">
                <button type="submit" name="updatesave" class="btn btn-danger">Yes</button>

                <button type="button" class="btn btn-info" data-dismiss="alert">
                <span aria-hidden="true">Oops! No </span>
                </button>      
            </form>
     </div>
  ';
	}
	if(isset($_POST['user_id']))
	{
		$user_id=$_POST['user_id'];
                               
                 $currentdate= date_create();
                 $currentdate=date_format($currentdate,'y-m-d');
		
		$sql="update donor set save_life_date='$currentdate' where id ='$user_id'";
		if(mysqli_query($connec,$sql))
		{   $_SESSION['save_life_date']=$currentdate;
           header("location:index.php");
		}else
		{
              $currenterror ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>something error occurred</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
		}
	}
?>


<style>
	h1,h3{
		display: inline-block;
		padding: 10px;
	}
</style>

			<div class="container" style="padding: 60px 0;">
			<div class="row">
				<div class="col-md-12 col-md-push-1">
					<div class="panel panel-default" style="padding: 20px;">
						<div class="panel-body">
							<?php  if(isset($currenterror))
							{
								echo $currenterror;
							}         ?>
								<div class="alert alert-danger alert-dismissable" style="font-size: 18px; display: none;">
    						
    								<strong>Warning!</strong> Are you sure you want a save the life if you press yes, then you will not be able to show before 3 months.
    							
    							<div class="buttons" style="padding: 20px 10px;">
    								<input type="text" value="" hidden="true" name="today">
    								<button class="btn btn-primary" id="yes" name="yes" type="submit">Yes</button>
    								<button class="btn btn-info" id="no" name="no">No</button>
    							</div>
  							</div>
							<div class="heading text-center">
								<h1>Welcome </h1> <h1> <?php  if(isset($_SESSION['name']))
          echo $_SESSION['name']; 
          ?></h1>
							</div>
							<p class="text-center">Here you can manage your account update your profile</p>
									<div class="test-success text-center" id="data" style="margin-top: 20px;"><?php   if(isset($showform))   echo $showform;     ?><!-- Display Message here--></div>
							<?php
                             $safedate=$_SESSION['save_life_date'];

                              

                             if($safedate=='0')
                             {
                             	echo '<form target="" method="POST">
									<button style="margin-top: 20px;" name="date" id="save_the_life" type="submit" class="btn btn-lg btn-danger center-aligned ">Save The Life</button>
							</form>
                          ';
                             }
                             else
                             { $start=date_create("$safedate");
                               $end=date_create();
                               $diff=date_diff($start,$end);
                               
                                $diffstart=$diff->y;
                                $diffmonth=$diff->m;
                                $diffdays=$diff->d;
                                 
                                 echo  $diffstart."<strong>year </strong> " ;
                                 echo  $diffmonth."<strong>month and </strong>" ;
                                 echo  $diffdays." <strong>days have been passed since u donated the blood</strong>";

                                   if($diffmonth>=3)
                                   {
                                      	echo '<form target="" method="POST">
									<button style="margin-top: 20px;" name="date" id="save_the_life" type="submit" class="btn btn-lg btn-danger center-aligned ">Save The Life</button>
						         	</form>
                                        ';
                                   }
                                   else
                                   {
                                   		echo '	<div class ="donors_data">
								<span class="name center-aligned" ><i><strong>Congratulations!</strong></i></span>
								<span class="center-aligned"><i><strong>You have saved a life.You can donate again after 3 months.We are vey thankful to you</strong></i></span>
							</div>';
                             }
                             }
							?>
					

					
	
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
<?php

include 'include/footer.php'; 
?>