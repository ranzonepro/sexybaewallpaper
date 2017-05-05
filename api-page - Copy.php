<?php include("includes/connection.php");

  
	if(isset($_GET['cat_id'])&isset($_GET['page']))
	{
				$cat_id=$_GET['cat_id'];			
				
				
			  $query_rec = "SELECT COUNT(*) as num FROM tbl_gallery WHERE cat_id='".$cat_id."'";
				$total_pages = mysql_fetch_array(mysql_query($query_rec));
		
				$limit=($_GET['page']-1) * 1;
				
				 
				$query="SELECT category_name,image FROM tbl_gallery,tbl_category WHERE tbl_gallery.cat_id=tbl_category.cid and tbl_gallery.cat_id='".$cat_id."'  LIMIT $limit, 1";
						 		
				$resouter = mysql_query($query);
     
    $set = array();
     
    $total_records = mysql_numrows($resouter);
    if($total_records >= 1){
     
      while ($link = mysql_fetch_array($resouter, MYSQL_ASSOC)){
	   
		 		$link1=array_merge((array)$total_pages, (array)$link);
		 
        $set['HDwallpaper'][] = $link1;
      }
    }
     
     echo $val= str_replace('\\/', '/', json_encode($set));
			
								
		
	}
	else if(isset($_GET['latest']))
	{
		 
		 
		 
				$limit=$_GET['latest'];	 	
		$query="SELECT tbl_gallery.image,tbl_category.category_name FROM tbl_gallery
		LEFT JOIN tbl_category ON tbl_gallery.cat_id= tbl_category.cid 
		ORDER BY tbl_gallery.id DESC LIMIT $limit";
		
		$resouter = mysql_query($query);
     
    $set = array();
     
    $total_records = mysql_numrows($resouter);
    if($total_records >= 1){
     
      while ($link = mysql_fetch_array($resouter, MYSQL_ASSOC)){
	   
        $set['HDwallpaper'][] = $link;
      }
    }
     
     echo $val= str_replace('\\/', '/', json_encode($set));
		
	}
	else
	{
		
		$query_rec = "SELECT COUNT(*) as num FROM tbl_category";
			$total_pages = mysql_fetch_array(mysql_query($query_rec));
			 
		$limit=($_GET['page']-1) * 1;	 	
			
		$query="SELECT cid,category_name,category_image FROM tbl_category LIMIT $limit, 1";
		
		$resouter = mysql_query($query);
     
    $set = array();
     
    $total_records = mysql_numrows($resouter);
    if($total_records >= 1){
     
      while ($link = mysql_fetch_array($resouter, MYSQL_ASSOC)){
	   
		 		$link1=array_merge((array)$total_pages, (array)$link);
		 
        $set['HDwallpaper'][] = $link1;
      }
    }
     
     echo $val= str_replace('\\/', '/', json_encode($set));
			
	}
	 
?>