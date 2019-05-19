<?php

	//$segment = new SimpleXMLElement($_POST['filestr']);
	
	//echo $segment->getName();
	if(isset($_POST))
	{
		$segment = new DOMDocument("1.0");
		$newfile = new DOMDocument("1.0");
		$str = "segments/"; 
		$str .=	$_POST['filestr'];
		
		$newfile->formatOutput = true;
		$segment->load($str);
		$segment->preserveWhiteSpace = false;
		$sgt = $segment->documentElement;
		
		//echo "<xmp>".$segment->saveXML()."</xmp>";
		
		foreach($sgt->childNodes as $elem){
			$nname = $elem->nodeName;
			//echo $nname;
			if(strcmp($nname, "#text") != 0){
				$itemMain = $newfile->createElement($nname);
				$newfile->appendChild($itemMain);
				
				foreach($elem->childNodes as $std){
					//echo "wololo2";
					$nname = $std->nodeName;
					//echo $nname;
					if(strcmp($nname, "#text") != 0){
						if(isset($_POST[$nname])){
							$item = $newfile->createElement($nname, $_POST[$nname]);
						}else{
							$item = $newfile->createElement($nname);
						}
						$itemMain->appendChild($item);
					}
					//echo "wololo3";
					
					
				}
			}
		}
		/*
		foreach($sgt->childNodes as $std){
			$nname = $std->nodeName;
			if(isset($_POST[$nname])){
				$item = $newfile->createElement($nname, $_POST[$nname]);
			}else{
				$item = $newfile->createElement($nname);
			}
			$itemMain->appendChild($item);
		}*/
		//echo "<xmp>".$newfile->saveXML()."</xmp>";
		$newfile->save($_POST['filename'] .".xml") or die("xml not created");
		/*header("Content-type: type/xml");
		echo "<?xml version='1.0' encoding = 'UTF-8' ?>";

		echo "<class>";
			echo "<id>{$_POST['stud_id']}</id>";
			echo "<description>{$_POST['name']}</description>";
			echo "<schedule>{$_POST['crs']}</schedule>";
			echo "<room>{$_POST['yr']}</room>";
		echo "</class>";*/
	}
	//header('Location: ' . $_SERVER['HTTP_REFERER']);
?>