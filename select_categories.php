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
$SqlStat = "SELECT  * FROM cats ORDER BY id ASC";

$result = mysql_query($SqlStat);

// Verifica si se quiere eliminar una categoria.
if(isset($_GET['id'])){

    $SqlUpdatetOrder = "DELETE FROM cats WHERE id=".$_GET['id']." ";
    //echo $SqlUpdatetOrder;
    $result_update = mysql_query($SqlUpdatetOrder) or die("Error en: " . mysql_error());
    //echo $result_update;
    header("Location: dashboard.php?p=select_categories");
}

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
        <h3 class="header smaller lighter blue">Category List</h3>
        <div class="table-header">
            Categories
        </div>          
        


        <div class="table-responsive" id="pruebatabla">
            <form method="POST" action="functions/active_deactive_categories.php">

                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                    
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Category</th>
                            <th>Active</th>
                            <th></th>
                        </tr>
                    </thead>
                    

                    <tbody id="pruebacontenido">
                    
                    
                    <?php while($row = mysql_fetch_array($result)): ?>
                        
                        <tr>
                            <td><?php echo $row[0]; ?></td>
                            <td><?php echo $row[1]; ?></td>
                            <td style="text-align:center">
                                <?php if($row[3]=='y'): ?>
                                    <input type="checkbox" name="category[]" value="<?php echo $row[0]; ?>" checked>
                                <?php else: ?>
                                    <input type="checkbox" name="category[]" value="<?php echo $row[0]; ?>">
                                <?php endif; ?>
                            </td>
                            
                            <td>
                                <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                                    
                                    <a class="blue" href="dashboard.php?p=detail_cat_web&id=<?php echo $row[0]; ?>">
                                        <i class="icon-zoom-in bigger-130"></i>
                                    </a>
                                    <a class="red" href="dashboard.php?p=select_categories&id=<?php echo $row[0]; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                        <i class="icon-trash bigger-130"></i>
                                    </a>
                                    
                                </div>

               
                            </td>
                        </tr>
                        
                        <?php endwhile; ?> 
            
                    </tbody>
                </table>
                <div style="text-align:center;margin-top:20px;">
                    
                        
                        <input type="submit" value="Change Categories" name="changecategories" class="btn btn-primary">
                    
                      
                </div>
            </form>
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
                  null, null,
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