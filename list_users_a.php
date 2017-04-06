<?php

if(!isset($_SESSION)): 
        session_start(); 
    endif;
if ($_SESSION['user'] == "") {
    
    header("Location: index.php");
}
$_SESSION['back'] = 'A';
//print_r($data['type']);
if($data['type']=='1'){

include 'config.php';
$user=$_SESSION['user'];
$query=$mysqli->query("select * from users where role =1");
$data=mysqli_fetch_assoc($query);


    
   
$SqlStat = "SELECT * FROM users where role = 1 ORDER BY id DESC";
$result = mysql_query($SqlStat);
?>
<div class="row">
    <div class="col-xs-12">
        <?php   if(isset($_GET['Emessage'])):
            $mensaje = $_GET['Emessage'];
            if ($mensaje == "1"): ?>
                <div class="alert alert-success text-center" role="alert">
                    The Customer has been deleted.
                </div>
        <?php       elseif ($mensaje == "2"): ?>
                <div class="alert alert-success text-center" role="alert">
                    The Customer has been updated.
                </div>


        <?php endif; endif; ?>
        <h3 class="header smaller lighter blue">Customers type A</h3>
        <div class="table-header">
            Customers
        </div>          
        


        <div class="table-responsive" id="pruebatabla">
            <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>
                        <i class="icon-user bigger-110 hidden-480"></i>
                        Email </th>
                        <th>
                        <i class="icon-phone bigger-110 hidden-480"></i>
                        Phone</th>
                        <th>
                        <i class="icon-file-text bigger-110 hidden-480"></i>
                        Type</th>
                        <th>
                        <i class="icon-file-text bigger-110 hidden-480"></i>
                        Role</th>

                        <th></th>
                    </tr>
                </thead>


                <tbody id="pruebacontenido">
                 
                <?php while($row = mysql_fetch_array($result)): ?>
                    
                    <tr>
                    
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[3]; ?></td>
                        <td><?php echo $row[4]; ?></td>
                        <td>
                            <?php if($row[7]==1): 
                                    echo "Admin";
                                  else:
                                    echo "User";
                                  endif;
                            ?>
                        </td>
                        <td>
                            <?php if($row[8]==1): 
                                    echo "Customer Type A";
                                  elseif($row[8]==2):
                                    echo "Customer Type B";
                                  else:
                                    echo "Customer Type C";
                                  endif;
                            ?>
                        </td>
                    
                        <td>
                            <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                                
                                <a class="blue" href="dashboard.php?p=view_customer&id=<?php echo $row[0]; ?>">
                                    <i class="icon-zoom-in bigger-130"></i>
                                </a>
                                
                                <a class="green" href="dashboard.php?p=edit_customer&id=<?php echo $row[0]; ?>">
                                    <i class="icon-pencil bigger-130"></i>
                                </a>

                                <a class="red" href="functions/delete_customer.php?id=<?php echo $row[0]; ?>">
                                    <i class="icon-trash bigger-130"></i>
                                </a>
                            </div>

                            <div class="visible-xs visible-sm hidden-md hidden-lg">
                                <div class="inline position-relative">
                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-caret-down icon-only bigger-120"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                        <li>
                                            <a href="dashboard.php?p=view_customer&id=<?php echo $row[0]; ?>" class="tooltip-info" data-rel="tooltip" title="View">
                                                <span class="blue">
                                                    <i class="icon-zoom-in bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="dashboard.php?p=edit_customer&id=<?php echo $row[0]; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                <span class="green">
                                                    <i class="icon-edit bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="functions/delete_customer.php?id=<?php echo $row[0]; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                <span class="red">
                                                    <i class="icon-trash bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                    <?php endwhile; ?> 
       
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php mysql_close($con); ?>
        <!-- basic scripts -->

        <!--[if !IE]> -->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
        </script>

        <!-- <![endif]-->


        <!-- page specific plugin scripts -->

        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/jquery.dataTables.bootstrap.js"></script>


		
		

		
        <script type="text/javascript">

            jQuery(function($) {
                var oTable1 = $('#sample-table-2').dataTable( {
                "aoColumns": [
                  { "bSortable": false },
                  null, null,null, null, null,
                  { "bSortable": false }
                ] } );
                
                
                $('table th input:checkbox').on('click' , function(){
                    var that = this;
                    $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });
                        
                });
            
            
                $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
                function tooltip_placement(context, source) {
                    var $source = $(source);
                    var $parent = $source.closest('table')
                    var off1 = $parent.offset();
                    var w1 = $parent.width();
            
                    var off2 = $source.offset();
                    var w2 = $source.width();
            
                    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                    return 'left';
                }
            })

        </script>
                
      <?php } else {
          
         echo "<h1>You Have No Permission to Access This Page</h1>";
      }?>