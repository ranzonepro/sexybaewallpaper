<?php
require_once("thumbnail_images.class.php");
class k_wallpaper
{

//Category Query	
	function addCategory()
	{
		
	$albumimgnm=rand(0,99999)."_".$_FILES['image']['name'];
			 $pic1=$_FILES['image']['tmp_name'];
			 
			  if(!is_dir('categories/'.$_POST['category_name']))
			   {
			
			   		mkdir('categories/'.$_POST['category_name'], 0777);
			   }
			 
			  $tpath1='images/'.$albumimgnm;
				
				 copy($pic1,$tpath1);
				 
				 
					    $thumbpath='images/thumbs/'.$albumimgnm;
						$obj_img = new thumbnail_images();
						$obj_img->PathImgOld = $tpath1;
						$obj_img->PathImgNew =$thumbpath;
						$obj_img->NewWidth = 72;
						$obj_img->NewHeight = 72;
						if (!$obj_img->create_thumbnail_images()) 
						  {
							echo $_SESSION['msg']="Thumbnail not created... please upload image again";
						    exit;
						  }
						  else
						  {
						  		 
								$cat_result=mysql_query('INSERT INTO `tbl_category` (`category_name` ,`category_image`) VALUES (  \''.addslashes($_POST['category_name']).'\',\''.$albumimgnm.'\')');
		
								
						  }

		
	}
	
	function editCategory()
	{
			 
			 
	if($_FILES['image']['name']=="")
		 {
		
		
				if(!is_dir('categories/'.$_POST['category_name']))
			   {
			
			   		mkdir('categories/'.$_POST['category_name'], 0777);
			   }
		
		$cat_result=mysql_query('UPDATE `tbl_category` SET `category_name`=\''.addslashes($_POST['category_name']).'\' WHERE cid=\''.$_GET['cat_id'].'\'');

		}
		else
		{
		
			if(!is_dir('categories/'.$_POST['category_name']))
			   {
			
			   		mkdir('categories/'.$_POST['category_name'], 0777);
			   }
		
		
			//Image Unlink
			
			$img_res=mysql_query('SELECT * FROM tbl_category WHERE cid=\''.$_GET['cat_id'].'\'');
			$img_row=mysql_fetch_assoc($img_res);
			
			if($img_row['category_image']!="")
			{
				unlink('images/'.$img_row['category_image']);
				unlink('images/thumbs/'.$img_row['category_image']);
			}	
		
			//Image Upload
			$albumimgnm=rand(0,99999)."_".$_FILES['image']['name'];
			 $pic1=$_FILES['image']['tmp_name'];
			   
			
			  $tpath1='images/'.$albumimgnm;
				
				 copy($pic1,$tpath1);
				 
				 
					    $thumbpath='images/thumbs/'.$albumimgnm;
						$obj_img = new thumbnail_images();
						$obj_img->PathImgOld = $tpath1;
						$obj_img->PathImgNew =$thumbpath;
						$obj_img->NewWidth = 72;
						$obj_img->NewHeight = 72;
						if (!$obj_img->create_thumbnail_images()) 
						  {
							echo $_SESSION['msg']="Thumbnail not created... please upload image again";
						    exit;
						  }
						  else
						  {
						  		 
								 $cat_result=mysql_query('UPDATE `tbl_category` SET `category_name`=\''.addslashes($_POST['category_name']).'\',`category_image`=\''.$albumimgnm.'\' WHERE cid=\''.$_GET['cat_id'].'\'');
 	 
						  }
		}

			
	}
	
	function deleteCategory()
	{
		
		
		$cat_img_res=mysql_query('SELECT * FROM tbl_category WHERE cid=\''.$_GET['cat_id'].'\'');
		$cat_img_row=mysql_fetch_assoc($cat_img_res);
		
		 //Images unlink and delete
			
			$img_res=mysql_query('SELECT * FROM tbl_gallery WHERE cat_id=\''.$_GET['cat_id'].'\'');
			
			
			while($img_row=mysql_fetch_array($img_res))
			{	
				 
					unlink('categories/'.$cat_img_row['category_name'].'/'.$img_row['image']);
					 
					
					$img_result=mysql_query('DELETE FROM `tbl_gallery` WHERE cat_id=\''.$_GET['cat_id'].'\'');			 
			}
		
			
			if($cat_img_row['category_image']!="")
			{
				unlink('images/thumbs/'.$cat_img_row['category_image']);
				unlink('images/'.$cat_img_row['category_image']);
				 
			}
		
				if(is_dir('categories/'.$cat_img_row['category_name']))
			   {
			
			   		rmdir('categories/'.$cat_img_row['category_name']);
			   }
		
		
		$cat_result=mysql_query('DELETE FROM `tbl_category` WHERE cid=\''.$_GET['cat_id'].'\'');
		
		
	}

 
//Image Gallery
	function addimage()
	{
		$count = count($_FILES['image']['name']);
		for($i=0;$i<$count;$i++)
		{ 
			$albumimgnm=rand(0,99999)."_".$_FILES['image']['name'][$i];
			 $pic1=$_FILES['image']['tmp_name'][$i];
			   
		
			$cat_img_res=mysql_query('SELECT * FROM tbl_category WHERE cid=\''.$_POST['category_id'].'\'');
		  $cat_img_row=mysql_fetch_assoc($cat_img_res);
		  
				  
			  $tpath1='categories/'.$cat_img_row['category_name'].'/'.$albumimgnm;
				 
				 copy($pic1,$tpath1);
				 
				 
					   
						  		$date=date('Y-m-j');								
							  
						  		$res=mysql_query('INSERT INTO `tbl_gallery` (`cat_id`,`image_date`,`image`) VALUES (\''.$_POST['category_id'].'\',\''.$date.'\',\''.$albumimgnm.'\')');
						   
				}		  
	}
		
	function editimage()
	{
		$date=date('Y-m-j');
		
		 if($_FILES['image']['name']=="")
		 {
		
		$res=mysql_query('UPDATE `tbl_gallery` SET `cat_id`=\''.$_POST['category'].'\',`image_date`=\''.$date.'\' WHERE id=\''.$_GET['img_id'].'\'');
		}
		else
		{
		
			//Image Unlink
			
			$img_res=mysql_query('SELECT * FROM tbl_gallery WHERE id=\''.$_GET['img_id'].'\'');
			$img_row=mysql_fetch_assoc($img_res);
			
			$cat_img_res=mysql_query('SELECT * FROM tbl_category WHERE cid=\''.$img_row['cat_id'].'\'');
			$cat_img_row=mysql_fetch_assoc($cat_img_res);
		
			if($img_row['image']!="")
			{
				 
				unlink('categories/'.$cat_img_row['category_name'].'/'.$img_row['image']);
			}	
		
			//Image Upload
			$albumimgnm=rand(0,99999)."_".$_FILES['image']['name'];
			 $pic1=$_FILES['image']['tmp_name'];
			   
				$tpath1='categories/'.$cat_img_row['category_name'].'/'.$albumimgnm;
				
				 copy($pic1,$tpath1);
				 
				 
					     
						  		$date=date('Y-m-j');
								
							  
						  		$res=mysql_query('UPDATE `tbl_gallery` SET `cat_id`=\''.$_POST['category'].'\',`image_date`=\''.$date.'\',`image`=\''.$albumimgnm.'\' WHERE id=\''.$_GET['img_id'].'\'');
						  
		}
		
	}	
	
	function deleteImage()
	{
		//Image Unlink
			
			$img_res=mysql_query('SELECT * FROM tbl_gallery WHERE id=\''.$_GET['img_id'].'\'');
			$img_row=mysql_fetch_assoc($img_res);
			
			if($img_row['image']!="")
			{
				
				$cat_img_res=mysql_query('SELECT * FROM tbl_category WHERE cid=\''.$img_row['cat_id'].'\'');
				$cat_img_row=mysql_fetch_assoc($cat_img_res);
				
				unlink('categories/'.$cat_img_row['category_name'].'/'.$img_row['image']);
			}	
			
			$img_result=mysql_query('DELETE FROM `tbl_gallery` WHERE id=\''.$_GET['img_id'].'\'');
	}	
	
	function editProfile()
	{
		  
			$res=mysql_query('UPDATE `tbl_admin` SET `username`=\''.$_POST['username'].'\',`password`=\''.$_POST['password'].'\',`email`=\''.$_POST['email'].'\' WHERE id=\''.$_SESSION['id'].'\'');
	}	
}

?>