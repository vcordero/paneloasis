<?php

if(!isset($_SESSION)): 
        session_start(); 
    endif;
if ($_SESSION['user'] == "") {
    
    header("Location: index.php");
}
$_SESSION['back'] = 'ALL';
//print_r($data['type']);
if($data['type']=='1'){

include 'config.php';
$user=$_SESSION['user'];
$query=$mysqli->query("select * from users");
$data=mysqli_fetch_assoc($query);


    
   
//$SqlStat = "SELECT * FROM order_app JOIN ORDER BY order_date DESC";
$SqlStat = "SELECT  email,name,phone,order_number,order_date FROM order_web WHERE dispenser = 0 group by order_number ORDER BY order_date DESC";

$result = mysql_query($SqlStat);
?>
<div class="row">
    <div class="col-xs-12">
        <?php   if(isset($_GET['message'])):
            $mensaje = $_GET['message'];
            if ($mensaje == "1"): ?>
                <div class="alert alert-success text-center" role="alert">
                    The Customer has been deleted.
                </div>
        <?php       elseif ($mensaje == "2"): ?>
                <div class="alert alert-success text-center" role="alert">
                    The Customer has been updated.
                </div>


        <?php endif; endif; ?>
        <h3 class="header smaller lighter blue">New Web Order List</h3>
        <div class="table-header">
            Orders
        </div>          
        


        <div class="table-responsive" id="pruebatabla">
            <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Order Date</th>
                        <th></th>
                    </tr>
                </thead>
                

                <tbody id="pruebacontenido">
                
                
                <?php while($row = mysql_fetch_array($result)): ?>
                    
                    <tr>
                        <td><?php echo $row[3]; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo $row[4]; ?></td>
                        
                        <td>
                            <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                                
                                <a class="blue" href="dashboard.php?p=detail_order_web&id=<?php echo $row[3]; ?>">
                                    <i class="icon-zoom-in bigger-130"></i>
                                </a>
                                <a class="red" href="dashboard.php?p=delete_order_web&id=<?php echo $row[3]; ?>">
                                    <i class="icon-trash bigger-130"></i>
                                </a>
                                
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
                  null, null,null,null,
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