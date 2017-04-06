<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	
	include '../config.php';

	$mensaje = "";// Mensaje de respuesta
	$date =	date('Y-m-d'); // Fecha actual
	
	//Arranca con la sincronización
  // Crea la conexión con la Base de Datos de Prestashop
  $connPresta = new mysqli($dbhostpresta, $dbuserpresta, $dbpasswordpresta, $dbnamepresta);
  if ($connPresta->connect_error) {
     die("Connection failed: " . $connPresta->connect_error);
  }
      
  $idparent=2;
	$idshop=1;
	
  //id_shop_default (por defecto en la base de datos tiene 1);level_depth (por defecto tiene 0);nleft, nright (tienen por defecto 0)
  //position (tiene 0 por defecto);is_root_category ( 0 por defecto)
	$idlang=1;
	$active=1;


  /*TRABAJO CON LAS CATEGORIAS*/
  

	//Busca los datos de la tabla categorias de fragancias
  $result = $mysqli->query("select * from cats");
  if ($result->num_rows > 0) {

      //Marca las categorias a eliminar de Prestashop
      $result_campo = $connPresta->query("SHOW COLUMNS FROM ps_category LIKE 'delete_record'");
      if ($result_campo->num_rows == 1) {
          $action_query = $connPresta->query("UPDATE ps_category SET delete_record = 1 WHERE id_category > 0 and is_extra_product = 0");
          $action_query = $connPresta->query("UPDATE ps_category SET delete_record = 1 WHERE is_extra_product is null");
      } else{
          $action_query = $connPresta->query("ALTER TABLE ps_category ADD delete_record TINYINT NULL");
          $action_query = $connPresta->query("UPDATE ps_category SET delete_record = 1 WHERE id_category > and is_extra_product = 0 ");
          $action_query = $connPresta->query("UPDATE ps_category SET delete_record = 1 WHERE is_extra_product is null ");
      }
      //Hasta aqui marca las categorias para eliminación
      //Para saber si es extra product o no agrega un campo
      $result_campo = $connPresta->query("SHOW COLUMNS FROM ps_category LIKE 'is_extra_product'");
      if ($result_campo->num_rows == 1 ) {
          //$action_query = $connPresta->query("UPDATE ps_product SET delete_record = 1 WHERE id_product > 0 and is_extra_product = 0");
      } else{
          $action_query = $connPresta->query("ALTER TABLE ps_category ADD is_extra_product TINYINT NULL");
      }


     $date_add=date('Y-m-d H:i:s');
     while($row = $result->fetch_assoc()) {
          //Busca en la base de datos ps_category_lang de Prestashop si la categoria existe
			    $presta_query = "select * from ps_category_lang where id_category = ". $row["ps_id_category"];
			    $data = mysqli_query($connPresta,$presta_query);
          $numResults = mysqli_num_rows($data);
          if ($numResults == 0) { //hace el insert porque la categoria no existe

              //Inserta en la tabla ps_category de prestashop
	            $date_add=date('Y-m-d H:i:s');
	            $sql_insert = "INSERT INTO ps_category (id_parent, active, date_add,delete_record,is_extra_product) VALUES (".$idparent.",".$active.",'".$date_add."',0,0)";
              /*hace el insert y obtiene el id que se inserto en la categoria*/
				      $action_query = $connPresta->query($sql_insert);
			        $last_id = null;
					    $last_id = $connPresta->insert_id;

              /*actualiaza el id de prestashop en la tabla cats de fragancias*/
              $sql_update = "UPDATE cats SET ps_id_category =".$last_id." WHERE id = ".$row["id"];
              $action_query = $mysqli->query($sql_update);

					    /*inserta en la tabla ps_category_group*/
              $sql_insert = "INSERT INTO ps_category_group (id_category, id_group) SELECT ". $last_id .", id_group from ps_group";
				      $action_query = $connPresta->query($sql_insert);

              /*inserta en la tabla ps_category_shop*/
              $sql_insert = "INSERT INTO ps_category_shop (id_category, id_shop, position) VALUES(".$last_id.",".$idshop.",0)";
				      $action_query = $connPresta->query($sql_insert);

              $friendly_url = str_replace(" ","-",trim(strtolower($row["cat"])));
              $friendly_url = str_replace(".","",$friendly_url);
              $friendly_url = str_replace("&","",$friendly_url);

				      /*inserta en la tabla ps_category_lang*/
              $sql_insert = "INSERT INTO ps_category_lang (id_category, id_shop, id_lang, name, link_rewrite)
              VALUES (".$last_id.",".$idshop.",".$idlang.",'".$row["cat"]."','".$friendly_url."')";
				      $action_query = $connPresta->query($sql_insert);
               
			    }
			    else //Hace el update de los datos de las categorias
			    {
            $friendly_url = str_replace(" ","-",trim(strtolower($row["cat"])));
            $friendly_url = str_replace(".","",$friendly_url);
            $friendly_url = str_replace("&","",$friendly_url);
                  
			      $sql_update = "UPDATE ps_category_lang SET name ='".$row["cat"]."', link_rewrite = '".$friendly_url."', delete_record = 0 WHERE id_category = ".$row["ps_id_category"];
            $action_query = $connPresta->query($sql_update);

            $sql_update = "UPDATE ps_category SET is_extra_product = 0, delete_record = 0 WHERE id_category = ".$row["ps_id_category"];
            $action_query = $connPresta->query($sql_update);

			    }
     } //Hasta aca el while de recorrer las categorias

     $mensaje = 0;

  }


  //Borra las Categorias marcadas para eliminación de la tabla ps_category
  $sql_delete = "DELETE from ps_category WHERE delete_record = 1 and id_category >= 0 and is_extra_product = 0";
  $action_query = $connPresta->query($sql_delete);
  
  //De las tablas donde se encuentre la categoria borra los registros
  $result = $mysqli->query("select * from information_schema.columns where column_name = 'id_category' and table_name <> 'ps_category'");
  if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
         $sql_delete = "Delete from ".$row["TABLE_NAME"]." where not exists (select * from ps_category t2 where t2.id_category = ".$row["TABLE_NAME"].".id_category) and ".$row["TABLE_NAME"].".id_category >=0";
         $action_query = $connPresta->query($sql_delete);
     }
   }
   

 //HASTA AQUI TRABAJA CON LAS CATEGORIAS


 /*DATOS DE LOS PRODUCTOS*/

  //Variables para Productos
  $id_supplier = 1;
  $id_manufacturer = 1;
  $id_tax_rules_group=1;
  $prod_active=1; 
        
        
	      //Busca los datos de la tabla product de fragancias
        $result = $mysqli->query("select * from product where type = 1 and is_extraproduct = 0");
        if ($result->num_rows > 0) {

            //Marca los productos a eliminar de Prestashop
            $result_campo = $connPresta->query("SHOW COLUMNS FROM ps_product LIKE 'delete_record'");
            if ($result_campo->num_rows == 1) {
               $action_query = $connPresta->query("UPDATE ps_product SET delete_record = 1 WHERE id_product > 0 and is_extra_product <> 1");
            } else{
               $action_query = $connPresta->query("ALTER TABLE ps_product ADD delete_record TINYINT NULL");
               $action_query = $connPresta->query("UPDATE ps_product SET delete_record = 1 WHERE id_product > 0 and is_extra_product <> 1");
            }
            //Hasta aqui marca los productos para eliminacion

            //Para indetificar que no es extra product
            $result_campo = $connPresta->query("SHOW COLUMNS FROM ps_product LIKE 'is_extra_product'");
            if ($result_campo->num_rows == 1 ) {
               //$action_query = $connPresta->query("UPDATE ps_product SET delete_record = 1 WHERE id_product > 0 and is_extra_product = 0");
            } else{
               $action_query = $connPresta->query("ALTER TABLE ps_product ADD is_extra_product TINYINT NULL");
            }


           $date_add=date('Y-m-d H:i:s');
           while($row = $result->fetch_assoc()) { //Recorre la tabla product de fragancias
               
               //Busca el id de la categoria en prestashop
               $id_category=0;
               $data_categ = $connPresta->query("select id_category,name from ps_category_lang where name = '".trim($row["category"])."'");
               $numResultsCat = mysqli_num_rows($data_categ);
			         
               if ($numResultsCat > 0) {
                  $categ = $data_categ->fetch_assoc(); //Lee los datos de la Categoria en prestashop
                  $id_category = $categ["id_category"];
               }


               $data = $connPresta->query("select * from ps_product where upc = '".trim($row["upc_code"])."'");
               $numResults = mysqli_num_rows($data);
               if ($numResults == 0) { //hace el insert de products si no existe
                                    
			            // en la tabla ps_product
			            $sql_insert = "INSERT INTO ps_product (id_supplier,id_manufacturer,id_category_default,id_tax_rules_group,upc,active,date_add,delete_record,is_extra_product,quantity,price) 
			            VALUES (".$id_supplier.",".$id_manufacturer.",".$id_category.",".$id_tax_rules_group.",'".$row["upc_code"]."',".$prod_active.",'".$date_add."',0,0,".$row["quantity"].",".$row["retail_price"].")";
			            $action_query = $connPresta->query($sql_insert);
			            $prod_id = null;
                  $prod_id = $connPresta->insert_id;

                  //en la tabla ps_product_shop
					        $sql_insert = "INSERT INTO ps_product_shop (id_product,id_shop,id_category_default,id_tax_rules_group,active,date_add,price) 
			            VALUES (".$prod_id.",".$idshop.",".$id_category.",".$id_tax_rules_group.",".$prod_active.",'".$date_add."',".$row["retail_price"].")";
			            $action_query = null;
			            $action_query = $connPresta->query($sql_insert);

			            //En la tabla ps_category_product
                  $sql_insert = "INSERT INTO ps_category_product (id_category, id_product, position)
                  SELECT ". $id_category .",".$prod_id.", max(position+1) from ps_category_product where id_category=".$id_category;
				          $action_query = $connPresta->query($sql_insert);

                  $friendly_url = str_replace(" ","-",trim(strtolower($row["description"])));
                  $friendly_url = str_replace(".","",$friendly_url);
                  $friendly_url = str_replace("&","",$friendly_url);

				          //en la tabla ps_product_lang
					        $sql_insert = "INSERT INTO ps_product_lang (id_product,id_shop,id_lang,description_short,link_rewrite,name) 
			            VALUES (".$prod_id.",".$idshop.",".$idlang.",'".$row["long_description"]."','".$friendly_url."','".$row["description"]."')";
			            $action_query = $connPresta->query($sql_insert);

                  //en la tabla ps_stock_available
					        $sql_insert = "INSERT INTO ps_stock_available (id_product,id_product_attribute, id_shop, id_shop_group, quantity, depends_on_stock, out_of_stock) 
			            VALUES (".$prod_id.",0,".$idshop.",0,".$row["quantity"].",0,0)";
			            $action_query = $connPresta->query($sql_insert);

			            $mensaje=0;
			        
			          }else{ //Hace el update del producto en prestashop
             
                   $prod = $data->fetch_assoc(); //Lee los datos del Producto en prestashop
                   $prod_id = $prod["id_product"];

                   $sql_update = "UPDATE ps_product SET id_category_default =".$id_category.", delete_record = 0, is_extra_product = 0, quantity=".$row["quantity"].", price=".$row["retail_price"]."
                                   WHERE id_product = ".$prod["id_product"];
                   $action_query = $connPresta->query($sql_update);

                   $friendly_url = str_replace(" ","-",trim(strtolower($row["description"])));
                   $friendly_url = str_replace(".","",$friendly_url);
                   $friendly_url = str_replace("&","",$friendly_url);

			             $sql_update = "UPDATE ps_product_lang SET name ='".$row["description"]."', link_rewrite = '".$friendly_url."',description_short='".$row["long_description"]."' WHERE id_product = ".$prod["id_product"];
                   $action_query = $connPresta->query($sql_update);

                   $sql_update = "UPDATE ps_category_product SET id_category =".$id_category." WHERE id_product = ".$prod["id_product"];
                   $action_query = $connPresta->query($sql_update);
                   
                   $sql_update = "UPDATE ps_product_shop SET id_category_default = ".$id_category.", price = ".$row["retail_price"]." WHERE id_product = ".$prod["id_product"];
                   $action_query = $connPresta->query($sql_update);

                   $sql_update = "UPDATE ps_stock_available SET quantity = ".$row["quantity"]." WHERE id_product = ".$prod["id_product"];
                   $action_query = $connPresta->query($sql_update);

                   $mensaje=0;
			              
			          }

                //TRABAJA LA IMAGEN DEL PRODUCTO
                $content = null;
                $content = @file_get_contents($row["image"]); //Ruta donde esta la imagen en la tabla Product
                $link_image = $row["image"];
                if ($content){ //Si el archivo existe se procede a copiarlo (El producto tiene imagen)

                    //Busca en la base de datos ps_image de Prestashop para saber si el producto ya tiene imagen
	                  $imagenPresta=null;
			              $imagenPresta = $connPresta->query("select * from ps_image where id_product =". $prod_id);
			              $numImage = mysqli_num_rows($imagenPresta);
                    if($numImage > 0){ //Si ya existe
                               
                       $dataimg = $imagenPresta->fetch_assoc(); //Lee los datos de la imagen
                       $imagen_id = $dataimg["id_image"];

                    }else{ //No existe la crea en Base de Datos

                       	 // en la tabla ps_imagen
			                   $sql_insert = "INSERT INTO ps_image (id_product,position,cover) VALUES (".$prod_id.",1,1)";
			                   $action_query = $connPresta->query($sql_insert);
			                   $imagen_id = null;
                         $imagen_id = $connPresta->insert_id; //Obtiene el Id de la imagen

                         $sql_insert = "INSERT INTO ps_image_shop (id_product,id_image,id_shop,cover) VALUES (".$prod_id.",".$imagen_id. ",1,1)";
			                   $action_query = $connPresta->query($sql_insert);

                         $sql_insert = "INSERT INTO ps_image_lang (id_image,id_lang) VALUES (".$imagen_id. ",1)";
			                   $action_query = $connPresta->query($sql_insert);

                    }

                    $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
                    $ftp_login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
                    $directorio_raiz = "web/img/p";
                    $directorio_copia = $directorio_raiz;
                    $arbol_directorio = null;
                    @ftp_chdir($ftp_conn, $directorio_raiz ); //Se mueve al directorio de las imagenes

                    for ($i = 0; $i <= strlen($imagen_id)-1; $i++) {
                                     
                        $arbol_directorio = substr($imagen_id, $i, 1);
                        if(!@ftp_chdir($ftp_conn, $arbol_directorio)) {
                           	ftp_mkdir($ftp_conn, $arbol_directorio);
                        }

                        $directorio_copia = $directorio_copia ."/". substr($imagen_id, $i, 1);

                    }

                    $mensaje = $directorio_copia;
                               
                    ftp_close($ftp_conn);

                    unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$imagen_id.".jpg");
                    copy($link_image, 'ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$imagen_id.".jpg");
                    unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$imagen_id."-cart_default.jpg");
                    copy($link_image, 'ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$imagen_id."-cart_default.jpg");
                    unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$imagen_id."-home_default.jpg");
                    copy($link_image, 'ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$imagen_id."-home_default.jpg");
                    unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$imagen_id."-large_default.jpg");
                    copy($link_image, 'ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$imagen_id."-large_default.jpg");
                    unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$imagen_id."-medium_default.jpg");
                    copy($link_image, 'ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$imagen_id."-medium_default.jpg");
                    unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$imagen_id."-small_default.jpg");
                    copy($link_image, 'ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$imagen_id."-small_default.jpg");
                    unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$imagen_id."-thickbox_default.jpg");
                    copy($link_image, 'ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$imagen_id."-thickbox_default.jpg");


                    unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/web/img/tmp/product_mini_".$prod_id."_1.jpg");
                    unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/web/img/tmp/product_mini_".$imagen_id."_1.jpg");
                    copy($link_image, 'ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/web/img/tmp/product_mini_".$imagen_id."_1.jpg");

                } //hasta aqui trabajo con la imagen

           } //Hasta aca el while de recorrer las productos


          //Borra los productos marcados para eliminación de la tabla ps_products
          $sql_delete = "DELETE from ps_product WHERE delete_record = 1 and is_extra_product = 0";
          $action_query = $connPresta->query($sql_delete);

          $sql_delete = "DELETE from ps_product WHERE delete_record = 1 and is_extra_product is null";
          $action_query = $connPresta->query($sql_delete);
  

          //De las tablas donde se encuentre la categoria borra los registros
          $result = $mysqli->query("select * from information_schema.columns where column_name = 'id_product' and table_name <> 'ps_product'");
          if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
     
                $sql_delete = "Delete from ".$row["TABLE_NAME"]." where not exists (select * from ps_product t2 where t2.id_product = ".$row["TABLE_NAME"].".id_product) and ".$row["TABLE_NAME"].".id_product >=0";
                $action_query = $connPresta->query($sql_delete);

             }
          }
          //Hasta aqui borra los productos

           $mensaje = 0;

        } 

  

	mysql_close($con); // Cierro la Base de datos
	$mysqli->close();
	$connPresta->close();


	header("Location: ../dashboard.php?p=prestashop&type=1&message=".$mensaje."&last_sync=".date('Y-m-d H:i:s'));
	
?>