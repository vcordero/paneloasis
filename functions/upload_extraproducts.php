<?php

	

	session_start();

	if ($_SESSION['user'] == "") {

		

		header("Location: index.php");

	}

	

	include '../config.php';





    // Crea la conexión con la Base de Datos de Prestashop DEBO MOverlo de aca

    $connPresta = new mysqli($dbhostpresta, $dbuserpresta, $dbpasswordpresta, $dbnamepresta);

    if ($connPresta->connect_error) {

        die("Connection failed: " . $connPresta->connect_error);

    }



    $mensaje 	=	"";// Mensaje de respuesta

	$date 		=	date('Y-m-d H:i:s'); // Fecha actual

	$dateFile = str_replace(":","-", $date);



	$upload_dir = "";

	$upload_file="";

	$delete_file = "";

	$ejecutar_prestashop=0;





	// Verifica que se selecciono un archivo excel

    if(!empty($_FILES['file_xls']['name'])){

        $upload_dir = '../xlsextra/';

        $delete_file = $dateFile . "_" . basename($_FILES['file_xls']['name']);

        $upload_file = $upload_dir . $dateFile . "_" . basename($_FILES['file_xls']['name']);

        if (move_uploaded_file($_FILES['file_xls']['tmp_name'], $upload_file)) { //El archivo es válido y se subió con éxito

			

			$ejecutar_prestashop=1;



        }		

	}else{


		//OPCION DE ELIMINAR

		if (isset($_GET['p'])) {

            $xls_search = $_GET['p'];

            $result = $mysqli->query("select * from sync_products where xlsfile='" .$xls_search. "'"); //Estos son los productos sincronizados

            if ($result->num_rows > 0) {

               while($row = $result->fetch_assoc()) {



                  //Busca el producto en Prestashop y lo elimina

                  $prod_result = $connPresta->query("select * from ps_product where id_product=".$row["id_product"]);

                  if ($prod_result->num_rows > 0) {

                      //Las tablas de las categorias
                  	  $sql_del = "DELETE t1 FROM ps_category AS t1 INNER JOIN ps_product AS t2 ON t1.id_category = t2.id_category_default where t2.id_product = " .$row["id_product"];
                  	  $action_query = $connPresta->query($sql_del);
                      
                      $sql_del = "DELETE t1 FROM ps_category_lang AS t1 INNER JOIN ps_product AS t2 ON t1.id_category = t2.id_category_default where t2.id_product = " .$row["id_product"];
                  	  $action_query = $connPresta->query($sql_del);
                      
                      $sql_del = "DELETE t1 FROM ps_category_group AS t1 INNER JOIN ps_product AS t2 ON t1.id_category = t2.id_category_default where t2.id_product = " .$row["id_product"];
                  	  $action_query = $connPresta->query($sql_del);

                  	  $sql_del = "DELETE t1 FROM ps_category_product AS t1 INNER JOIN ps_product AS t2 ON t1.id_category = t2.id_category_default where t2.id_product = " .$row["id_product"];
                  	  $action_query = $connPresta->query($sql_del);

                  	  $sql_del = "DELETE t1 FROM ps_category_shop AS t1 INNER JOIN ps_product AS t2 ON t1.id_category = t2.id_category_default where t2.id_product = " .$row["id_product"];
                  	  $action_query = $connPresta->query($sql_del);

                      //******************************************************************************************


	         	      $sql_del = "DELETE FROM ps_product_shop where  id_product = " . $row["id_product"];
				      $action_query = $connPresta->query($sql_del);


				      $sql_del = "DELETE FROM ps_category_product where  id_product = " . $row["id_product"];
				      $action_query = $connPresta->query($sql_del);


				      $sql_del = "DELETE FROM ps_product_lang where  id_product = " . $row["id_product"];
				      $action_query = $connPresta->query($sql_del);


				      $sql_del = "DELETE FROM ps_stock_available where  id_product = " . $row["id_product"];
				      $action_query = $connPresta->query($sql_del);


				      $sql_del = "DELETE FROM ps_product where  id_product = " . $row["id_product"];
				      $action_query = $connPresta->query($sql_del);





                      //Eliminar las imagenes de los directorios
	                  $prod_img = $connPresta->query("select * from ps_image where id_product = ".$row["id_product"]);
	                  if ($prod_img->num_rows > 0) {

                          $directorio_raiz = "web/img/p";
	                      $directorio_copia = $directorio_raiz;

		               	   while($row_img = $prod_img->fetch_assoc()) {

		               	    	for ($i = 0; $i <= strlen($row_img["id_image"])-1; $i++) {         

		                            $directorio_copia = $directorio_copia ."/". substr($row_img["id_image"], $i, 1);

		                         }



		                         unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$row_img["id_image"].".jpg");

		                         unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$row_img["id_image"]."-cart_default.jpg");

		                         unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$row_img["id_image"]."-home_default.jpg");

		                         unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$row_img["id_image"]."-large_default.jpg");

		                         unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$row_img["id_image"]."-medium_default.jpg");

		                         unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$row_img["id_image"]."-small_default.jpg");

		                         unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/".$directorio_copia."/".$row_img["id_image"]."-thickbox_default.jpg");



		                         unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/web/img/tmp/product_mini_".$row["id_product"]."_1.jpg");

		                         unlink('ftp://'.$ftp_username.':'.$ftp_userpass.'@'.$ftp_server."/web/img/tmp/product_mini_".$row_img["id_image"]."_1.jpg");

		               	   }

	                  

	                   } //Fin de si de busqueda de imagen

                             

	                   //Elimnarlo de las tablas de imagenes

	                   $sql_del = "DELETE FROM ps_image where  id_product = " . $row["id_product"];

				       $action_query = $connPresta->query($sql_del);



				       $sql_del = "DELETE FROM ps_image_lang where  id_product = " . $row["id_product"];

				       $action_query = $connPresta->query($sql_del);



				       $sql_del = "DELETE FROM ps_image_shop where  id_product = " . $row["id_product"];

				       $action_query = $connPresta->query($sql_del);



		            }//Fin del si hay productos en prestashop


                    //Elimina el producto de la tabla product en Oasis
                    $sql_del = "DELETE FROM product where upc_code = '".$row["upc_code"]."'";
				    $action_query = $mysqli->query($sql_del);		            


                    //Elimina la Categoria en Oasis
                    $sql_del = "DELETE FROM cats where cat = '".$row["cat"]."'"; //Nuevo agregado
				    $action_query = $mysqli->query($sql_del);		            


		            //Elimina el producto de la tabla sync_product en Oasis
                    $sql_del = "DELETE FROM sync_products where id_product = " . $row["id_product"];
				    $action_query = $mysqli->query($sql_del);



               } //Fin del While de los productos sincronizados de Oasis

               

               //Aqui elimina el xls

               unlink('../xlsextra/'.$xls_search);

               

               $mensaje=2;



           }

           else{

           	 //Aqui elimina el xls

             unlink('../xlsextra/'.$xls_search);

             $mensaje=2;

           }



        } 



	}



    //AQUI EJECUTA PROCESO DE CARGAR A PRESTASHOP	

  if ($ejecutar_prestashop == 1){

      require_once('../Classes/PHPExcel.php'); //Carga de la Libreria para trabaja con excel

      $objPHPExcel = PHPExcel_IOFactory::load($upload_file); //Aca lee el archivo excel que se subio o el sample

            

			//Variables para capturar los valores del excel

			$category_name='';

			$prod_description = '';

			$link_image ='';

			//Hasta aqui

                  

            //Variables para Productos

            $id_supplier = 1;

            $id_manufacturer = 1;

            $id_tax_rules_group=1;

            $prod_active=1;



            //Conexion por FTP

            $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");

            $ftp_login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

            //Hasta aqui

          

            

            //Para saber si es extra product o no

            $result_campo = $connPresta->query("SHOW COLUMNS FROM ps_category LIKE 'is_extra_product'");

            if ($result_campo->num_rows == 1 ) {

               //$action_query = $connPresta->query("UPDATE ps_product SET delete_record = 1 WHERE id_product > 0 and is_extra_product = 0");

            } else{

              $action_query = $connPresta->query("ALTER TABLE ps_category ADD is_extra_product TINYINT NULL");

            }



            $result_campo = $connPresta->query("SHOW COLUMNS FROM ps_product LIKE 'is_extra_product'");

            if ($result_campo->num_rows == 1 ) {

               //$action_query = $connPresta->query("UPDATE ps_product SET delete_record = 1 WHERE id_product > 0 and is_extra_product = 0");

            } else{

              $action_query = $connPresta->query("ALTER TABLE ps_product ADD is_extra_product TINYINT NULL");

            }


            //Recorre el archivo excel con los productos

			foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {



			    //Si la fila es visible (no esta filtrada)

                if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible() == true

                	and $objPHPExcel-> getActiveSheet()->getCell('D'.$row->getRowIndex())->getValue() != ''){



                    $idparent=2;

	                $idshop=1; //id_shop_default (por defecto en la base de datos tiene 1)

	                //level_depth (por defecto tiene 0);nleft, nright (tienen por defecto 0)

	                $idlang=1;

	                $active=1;

	                $prod_id=null;



                    $upccode=null;

			        $upccode = trim($objPHPExcel->getActiveSheet()->getCell('A'.$row->getRowIndex())->getValue());

			        $description = $objPHPExcel->getActiveSheet()->getCell('B'.$row->getRowIndex())->getValue();

			        $link_image = $objPHPExcel->getActiveSheet()->getCell('C'.$row->getRowIndex())->getValue();

			        $quantity = $objPHPExcel->getActiveSheet()->getCell('E'.$row->getRowIndex())->getValue();

			        $value_retail_price = str_replace(",",".",$objPHPExcel->getActiveSheet()->getCell('F'.$row->getRowIndex())->getValue());

			        $long_description = $objPHPExcel->getActiveSheet()->getCell('G'.$row->getRowIndex())->getValue();

			        $category_panel = $objPHPExcel->getActiveSheet()->getCell('H'.$row->getRowIndex())->getValue();

			        $value_wholesale_price = 0;

			        $type_price = 1;

			        $value_synchronized = 0;

			        $is_extraproduct = 1;

			        $category_name = trim($objPHPExcel->getActiveSheet()->getCell('D'.$row->getRowIndex())->getValue()); //Columna que tiene la categoria en excel





                    ///////////////////AQUI AGREGA LOS DATOS EN BD OASIS///////////////////////////////////////////////////

                    

                    //Busca en oasis si la categoria existe

			        $oasis_query=$mysqli->query("select * from cats where cat='". $category_name ."'") or die($mysqli->error);

			        $data=mysqli_fetch_assoc($oasis_query);

			        //Si no existe hace el insert

			        if (!$data) {

			               

			            $sql_insert = "INSERT INTO cats (cat) VALUES ('". $category_name."')";

			               $action_query = $mysqli->query($sql_insert);

			        }

			        
			        $xls_wholesale_price =	array('I','J','K'); //contien las tres columnas de precios
                    $type_price = 1; //para la equivalencia de los tipos de precios (1:A 2:B 3:C) fungira como contador

                   //Recorrido por las tres comulna de precios (aprice,bprice,cprice)
			       for ($type_price=1; $type_price <= 3; $type_price++) { 

                       $value_retail_price = str_replace(",",".",$objPHPExcel->getActiveSheet()->getCell('F'.$row->getRowIndex())->getValue());
			           $value_wholesale_price = $objPHPExcel->getActiveSheet()->getCell($xls_wholesale_price[$type_price-1] . $row->getRowIndex())->getValue();

	                    //Busca en oasis si el producto existe por defecto precio 1
				       $oasis_query=$mysqli->query("select * from product where upc_code='". $value_upccode ."' AND type=" . $type_price) or die($mysqli->error);

				        $data=mysqli_fetch_assoc($oasis_query);

				        //Si no existe hace el insert

				        if (!$data) {

				           $sql_insert = "INSERT INTO product (image, description, retail_price, wholesale_price, type,upc_code, synchronized, category, is_extraproduct, quantity,long_description, category_panel ) 

				           VALUES ('".$link_image."','".$description."',".$value_retail_price.",".$value_wholesale_price.",".$type_price.",'".$upccode."',".$value_synchronized.",'".$category_name."',".$is_extraproduct.",".$quantity.",'".$long_description."','".$category_panel."')";

				           $action_query = $mysqli->query($sql_insert);

				        }

				        else

				        {

	                       $sql_update = "UPDATE product SET image ='".$link_image."', description ='" .$description."',retail_price = ".$value_retail_price.",

				           wholesale_price = ". $value_wholesale_price.",type = ".$type_price.",synchronized = ".$value_synchronized.",category='".$category_name."'

				           ,is_extraproduct=".$is_extraproduct.", quantity = ".$quantity.", long_description ='".$long_description."', category_panel = '".$category_panel."' WHERE upc_code='". $upccode ."' AND type=" . $type_price;

				           $action_query = $mysqli->query($sql_update);

				        }

                    }

                    /////////////////////////HASTA AQUI OASIS//////////////////////////////////////////////////////////////





                   //////////////////////AQUI ARRANCA PRESTASHOP//////////////////////////////////////////////////////////



                   //Busca en la base de datos ps_category_lang de Prestashop si la categoria existe (por nombre)

	               $dataPresta=null;

                   $dataPresta = $connPresta->query("select * from ps_category_lang where name ='". $category_name ."'");		      

                   $numCat = mysqli_num_rows($dataPresta);

                   if($numCat > 0){ //Si ya la categoria existe inserta solo los productos



                   	 $catego = $dataPresta->fetch_assoc(); //Lee los datos de la categoria

                     $date_add=date('Y-m-d H:i:s');



                     $sql_update = "UPDATE ps_category SET is_extra_product=1 WHERE id_category = ".$catego["id_category"];

                     $action_query = $connPresta->query($sql_update);





				     ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                     /*aca agrega los productos en prestashop*/

                       

			            //Busca en la tabla ps_product segun el upc_code

			           //Si no existe hace el insert

			            $data = $connPresta->query("select * from ps_product where upc='". $upccode ."'");

                        //$data = mysqli_query($connPresta,$product_query);

                        $numResults = mysqli_num_rows($data);

                        if ($numResults == 0) {

			               

			               // en la tabla ps_product

			               $sql_insert = "INSERT INTO ps_product (id_supplier,id_manufacturer,id_category_default,id_tax_rules_group,upc,active,date_add,is_extra_product,quantity,price) 

			               VALUES (".$id_supplier.",".$id_manufacturer.",".$catego["id_category"].",".$id_tax_rules_group.",'".$upccode."',".$prod_active.",'".$date_add."',1,".$quantity.",".$value_retail_price.")";

			               $action_query = $connPresta->query($sql_insert);

			               $prod_id = null;

                           $prod_id = $connPresta->insert_id;



                           //en la tabla ps_product_shop

						   $sql_insert = "INSERT INTO ps_product_shop (id_product,id_shop,id_category_default,id_tax_rules_group,active,date_add,price) 

			               VALUES (".$prod_id.",".$idshop.",".$catego["id_category"].",".$id_tax_rules_group.",".$prod_active.",'".$date_add."',".$value_retail_price.")";

			               $action_query = null;

			               $action_query = $connPresta->query($sql_insert);



			               //En la tabla ps_category_product

                           $sql_insert = "INSERT INTO ps_category_product (id_category, id_product, position)

                           SELECT ". $catego["id_category"] .",".$prod_id.", max(position+1) from ps_category_product where id_category=".$catego["id_category"];

				           $action_query = $connPresta->query($sql_insert);



				           $friendly_url = str_replace(" ","-",trim(strtolower($description)));

                           $friendly_url = str_replace(".","",$friendly_url);

                           $friendly_url = str_replace("&","",$friendly_url);



				           //en la tabla ps_product_lang

						   $sql_insert = "INSERT INTO ps_product_lang (id_product,id_shop,id_lang,description_short,link_rewrite,name) 

			               VALUES (".$prod_id.",".$idshop.",".$idlang.",'".$long_description."','".strtolower($friendly_url)."','".$description."')";

			               $action_query = $connPresta->query($sql_insert);



                           //en la tabla ps_stock_available

						   $sql_insert = "INSERT INTO ps_stock_available (id_product,id_product_attribute, id_shop, id_shop_group, quantity, depends_on_stock, out_of_stock) 

			               VALUES (".$prod_id.",0,".$idshop.",0,".$quantity.",0,0)";

			               $action_query = $connPresta->query($sql_insert);



			               //*********************************************************************************************************************

			               //Agrega los productos para el control de la sincrnizacion y poderlos eliminar posteriormente y la categoria

						   $sql_insert = "INSERT INTO sync_products (id_product,upc_code,xlsfile,cat) 

			               VALUES (".$prod_id.",'".$upccode."','".$delete_file."','".$category_name."')";

			               //$action_query = null;

			               $action_query = $mysqli->query($sql_insert);

			               //*********************************************************************************************************************



                           $mensaje=0;



			            } else{ //Si el producto existe actualiza sus datos



                           $product = $data->fetch_assoc(); //Lee los datos del producto

                           $prod_id = $product["id_product"];



                           $friendly_url = str_replace(" ","-",trim(strtolower($description)));

                           $friendly_url = str_replace(".","",$friendly_url);

                           $friendly_url = str_replace("&","",$friendly_url);



                           $sql_update = "UPDATE ps_product SET is_extra_product = 1 WHERE id_product = ".$prod_id;

                           $action_query = $connPresta->query($sql_update);



			               $sql_update = "UPDATE ps_product_lang SET name ='".$description."', link_rewrite = '".$friendly_url."', description_short='".$long_description."' WHERE id_product = ".$prod_id;

                           $action_query = $connPresta->query($sql_update);



                           $mensaje=0;



			            }

                     

 

                        //Trabaja la imagen

                        $content=null;

                        $content = @file_get_contents($link_image); //Ruta de la la tabla Products u hoja extra products

                        if ($content){ //Si el archivo existe se procede a copiarlo (El producto tiene imagen)



                            //Busca en la base de datos ps_image de Prestashop para saber si el producto ya tiene imagen

	                        $imagenPresta=null;

			                $imagenPresta = $connPresta->query("select * from ps_image where id_product =". $prod_id);

			                $numImage = mysqli_num_rows($imagenPresta);

                            if($numImage > 0){ //Si ya la categoria existe

                               

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



                        } //Hasta aqui la imagen


				   } else { //Si la categoria no existe la agrega

                        

                        //Inserta en la tabla ps_category de prestashop

	                    $date_add=date('Y-m-d H:i:s');

	                    //position (tiene 0 por defecto);is_root_category ( 0 por defecto)

				        $sql_insert = "INSERT INTO ps_category (id_parent, active, date_add, is_extra_product) VALUES (".$idparent.",".$active.",'".$date_add."',1)";

                        /*hace el insert y obtiene el id que se inserto en la categoria*/

				        $action_query = $connPresta->query($sql_insert);

			            $last_id = null;

						$last_id = $connPresta->insert_id;

						

                        /*inserta en la tabla ps_category_group*/

                        $sql_insert = "INSERT INTO ps_category_group (id_category, id_group) SELECT ". $last_id .", id_group from ps_group";

				        $action_query = $connPresta->query($sql_insert);

                        /*inserta en la tabla ps_category_shop*/

                        $sql_insert = "INSERT INTO ps_category_shop (id_category, id_shop, position) VALUES(".$last_id.",".$idshop.",0)";

				        $action_query = $connPresta->query($sql_insert);



				        $friendly_url = str_replace(" ","-",trim(strtolower($category_name)));

                        $friendly_url = str_replace(".","",$friendly_url);

                        $friendly_url = str_replace("&","",$friendly_url);



				        /*inserta en la tabla ps_category_lang*/

                        $sql_insert = "INSERT INTO ps_category_lang (id_category, id_shop, id_lang, name, link_rewrite)

                        VALUES (".$last_id.",".$idshop.",".$idlang.",'".$category_name."','".$friendly_url."')";

				        $action_query = $connPresta->query($sql_insert);

                        


                        ////////////////////////////////////////////////////////////////////////////////////////////////

                        /*aca agrega los productos en prestashop*/

                        $upccode=null;

			        	$upccode = trim($objPHPExcel->getActiveSheet()->getCell('A'.$row->getRowIndex())->getValue());

			        	$description = $objPHPExcel->getActiveSheet()->getCell('B'.$row->getRowIndex())->getValue();

			            $link_image = $objPHPExcel->getActiveSheet()->getCell('C'.$row->getRowIndex())->getFormattedValue();

			            //Busca en la tabla ps_product segun el upc_code

			        	$product_query="select * from ps_product where upc='". $upccode ."'";

			        	//Si no existe hace el insert

                        $data = mysqli_query($connPresta,$product_query);

                        $numResults = mysqli_num_rows($data);

                        if ($numResults == 0) {

			          			               

			               // en la tabla ps_product

			               $sql_insert = "INSERT INTO ps_product (id_supplier,id_manufacturer,id_category_default,id_tax_rules_group,upc,active,date_add, is_extra_product,quantity,price) 

			               VALUES (".$id_supplier.",".$id_manufacturer.",".$last_id.",".$id_tax_rules_group.",'".$upccode."',".$prod_active.",'".$date_add."',1,".$quantity.",".$value_retail_price.")";

			               $action_query = $connPresta->query($sql_insert);

			               $prod_id = null;

                           $prod_id = $connPresta->insert_id;



                           //en la tabla ps_product_shop

						   $sql_insert = "INSERT INTO ps_product_shop (id_product,id_shop,id_category_default,id_tax_rules_group,active,date_add) 

			               VALUES (".$prod_id.",".$idshop.",".$last_id.",".$id_tax_rules_group.",".$prod_active.",'".$date_add."')";

			               $action_query = null;

			               $action_query = $connPresta->query($sql_insert);



			               //En la tabla ps_category_product

                           $sql_insert = "INSERT INTO ps_category_product (id_category, id_product, position)

                           SELECT ".$last_id.",".$prod_id.", max(position+1) from ps_category_product where id_category=".$last_id;

				           $action_query = $connPresta->query($sql_insert);



				           $friendly_url = str_replace(" ","-",trim(strtolower($description)));

                           $friendly_url = str_replace(".","",$friendly_url);

                           $friendly_url = str_replace("&","",$friendly_url);



				           //en la tabla ps_product_lang

						   $sql_insert = "INSERT INTO ps_product_lang (id_product,id_shop,id_lang,description_short,link_rewrite,name) 

			               VALUES (".$prod_id.",".$idshop.",".$idlang.",'".$long_description."','".$friendly_url."','".$description."')";

			               $action_query = $connPresta->query($sql_insert);



                           //en la tabla ps_stock_available

						   $sql_insert = "INSERT INTO ps_stock_available (id_product,id_product_attribute, id_shop, id_shop_group, quantity, depends_on_stock, out_of_stock) 

			               VALUES (".$prod_id.",0,".$idshop.",0,".$quantity.",0,0)";

			               $action_query = $connPresta->query($sql_insert);



                           //*********************************************************************************************************************

			               //Agrega los productos para el control de la sincrnizacion y poderlos eliminar

						   $sql_insert = "INSERT INTO sync_products (id_product,upc_code,xlsfile,cat) 

			               VALUES (".$prod_id.",'".$upccode."','".$delete_file."','".$category_name."')";

			               //$action_query = null;

			               $action_query = $mysqli->query($sql_insert);

			               //*********************************************************************************************************************

                           

                           $mensaje=0;



			            }else{



			               $product = $data->fetch_assoc(); //Lee los datos del producto

                           $prod_id = $product["id_product"];



                           $friendly_url = str_replace(" ","-",trim(strtolower($description)));

                           $friendly_url = str_replace(".","",$friendly_url);

                           $friendly_url = str_replace("&","",$friendly_url);



			               $sql_update = "UPDATE ps_product_lang SET name ='".$description."', link_rewrite = '".$friendly_url."', description_short = '".$long_description."' WHERE id_product = ".$prod_id;

                           $action_query = $connPresta->query($sql_update);



                           $sql_update = "UPDATE ps_product SET is_extra_product = 1 WHERE id_product = ".$prod_id;

                           $action_query = $connPresta->query($sql_update);

                          

                           $mensaje=0;

			            }


                        //Trabaja la imagen

                        $content=null;

                        $content = @file_get_contents($link_image); //Ruta de la la tabla Products u hoja extra products

                        if ($content){ //Si el archivo existe se procede a copiarlo (El producto tiene imagen)



                            //Busca en la base de datos ps_image de Prestashop para saber si el producto ya tiene imagen

	                        $imagenPresta=null;

			                $imagenPresta = $connPresta->query("select * from ps_image where id_product =". $prod_id);

			                $numImage = mysqli_num_rows($imagenPresta);

                            if($numImage > 0){ //Si ya la categoria existe

                               

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



                        } //Hasta aqui la imagen





				   }



                }//fin del if si no es fila filtrada



			}//Aqui termina el for de recorrer el archivo excel



            unset($objPHPExcel);



  }

    

            

            //$mensaje = 1;

            //$connPresta->commit();

			$connPresta->close();





	mysql_close($con); // Cierro la Base de datos que esta en el Config.php



	header("Location: ../dashboard.php?p=extraproducts&type=1&message=".$mensaje."");



?>