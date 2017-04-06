
							
<div class="row">
	<div class="col-xs-12">
		<h3 class="header smaller lighter blue"></h3>
		<div class="table-header">
			Prestashop: Synchronization - This process may take a few minutes.
		</div>

		<?php if(isset($_GET['message'])):
			if($_GET['message']==0):  ?>
				<div class="alert alert-success text-center" role="alert">
				  Successful synchronization ...
				</div>
		<?php elseif($_GET['message']==1): ?>
				<div class="alert alert-danger text-center" role="alert">
				  Synchronization error ...
				</div>
		<?php endif;endif; ?>
        
		<form role="form" action="functions/syncro_prestashop.php" method="post" enctype="multipart/form-data" parsley-validate>
			
			<div class="col-xs-12" style="margin-bottom:20px;margin-top:20px">
				<div class="col-xs-5">
                    Press to start		
				</div>			
				<div class="col-xs-2">
					<button type="submit" class="btn btn-primary" style="border-radius:9px;padding:0 12px">sync up</button>
				</div>
			</div>
		
		</form>

        <?php

          if(isset($_GET['last_sync'])){
            $sql_sync = "UPDATE sincro_history SET last_date='".$_GET['last_sync']."' WHERE id_sincro > 0";
            $action_q = $mysqli->query($sql_sync);	
          }
          
          $result = $mysqli->query("select * from sincro_history");
          if ($result->num_rows > 0) {
          	 while($row = $result->fetch_assoc()) {
                  $last_date=$row["last_date"];
             }
         ?>
          <div class="alert alert-success text-center" role="alert">
				  Last Synchronization : <?php echo($last_date) ?>
		  </div>
         <?php
          }
        ?>




	</div>
</div>
