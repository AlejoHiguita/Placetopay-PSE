<?php

class Pagos{
	

	public function vistaPagos(){
		include "vistas/PagoV.php";
	}

	public function getBankList(){
		ini_set('soap.wsdl_cache_enabled',0);
		ini_set('soap.wsdl_cache_ttl',0);

		$seed = date('c');
		$login = "6dd490faf9cb87a9862245da41170ff2";
		$hashString = sha1($seed."024h1IlD", false);
		$browser_id = "Mozilla/5.0 (Windows; U; Windows NT 5.1; es-ES; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3";
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pse="https://api.placetopay.com/soap/pse">
				   <soapenv:Header/>
				   <soapenv:Body>
				      <pse:getBankList>
				         <auth>
				            <login>'.$login.'</login>
				            <tranKey>'.$hashString.'</tranKey>
				            <seed>'.$seed.'</seed>
				            <additional>
					            <item>
				                  <name></name>
				                  <value></value>
				               </item>
				            </additional>
				         </auth>
				      </pse:getBankList>
				   </soapenv:Body>
				</soapenv:Envelope>';
		$headers=array("Content-Type: text/xml;charset=UTF-8",
			"SOAPAction: https://api.placetopay.com/soap/pse#getBankList",
			"Content-Length:".strlen($xml));

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://test.placetopay.com/soap/pse/?wsdl");  
		curl_setopt($curl, CURLOPT_USERAGENT, $browser_id);      
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); 
		curl_setopt($curl, CURLOPT_VERBOSE, 1);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$resultx = curl_exec($curl);
		$errorx = curl_error($curl);
		$http_statusx = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		if( $http_statusx != "200" ) {
		  echo  "Error al enviar ".$http_statusx." -- ".$resultx;
		}else {    
		  $data=print_r($resultx,true);
		     $data=str_replace("<getBankListResult>","|",$data);
		     $data=str_replace("</getBankListResult>","|",$data);
		     $partir=explode("|",$data);
		     $data=$partir[1];
		     $data=str_replace("<item>","|",$data);
		     $data=str_replace("</item>","|",$data);
		     $partir=explode("|",$data);
		     $bancos=array();
		     for ($i=0; $i <count($partir) ;$i++) { 
		         if ($partir[$i]<>"") {
		             $data=str_replace("<bankCode>","",$partir[$i]);
		             $data=str_replace("</bankCode>",",",$data);
		             $data=str_replace("<bankName>","",$data);
		             $data=str_replace("</bankName>",",",$data);
		             $data=trim($data,",");
		             $partirx=explode(",",$data);
		             $bancos[]=array("idbanco"=>$partirx[0],"banco"=>$partirx[1]);
		         }
		       }  
		}
	}

	public function Transaction(){
		ini_set('soap.wsdl_cache_enabled',0);
		ini_set('soap.wsdl_cache_ttl',0);

		$seed = date('c');
		$login = "6dd490faf9cb87a9862245da41170ff2";
		$hashString = sha1($seed."024h1IlD", false);
		$browser_id = "Mozilla/5.0 (Windows; U; Windows NT 5.1; es-ES; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3";

		$bankCode="1007";
		$bankInterface="0";
		$returnURL="https://www.placetopay.com";
		$reference="23989";
		$description="Placetopay";
		$language="ES";
		$currency="COP";
		$totalAmount=rand(1, 500000);
		$taxAmount=0.32;
		$devolutionBase=0;
		$tipAmount=0;
		$document="102098900";
		$documentType="CC";
		$firstName="Juan";
		$lastName="Higuita";
		$company="S4";
		$emailAddress="ahiguita64@gmail.com";
		$address="Carrera 72";
		$city="Medellin";
		$province="Antioquia";
		$country="CO";
		$phone="4623409";
		$mobile="3138990987";
		$postalCode="080001";
		$ip="191.91.32.235";
		$additionalData="";
		$documentType1="CC";
		$document1="1029003999";
		$firstName1="Alejo";
		$lastName1="Higuita";
		$company1="S.A.S";
		$emailAddress1="joseh@s4ds.com";
		$address1="Calle 18";
		$city1="Medellin";
		$province1="Antioquia";
		$country1="CO";
		$phone1="5772687";
		$mobile1="311733657";
		$postalCode1="123900";
		$documentType2="CC";
		$document2="1232222";
		$firstName2="Esteban";
		$lastName2="Ruiz";
		$company2="Inde";
		$emailAddress2="estebna@hotmail.com";
		$address2="calle 10";
		$city2="Medellin";
		$province2="Antioquia";
		$country2="CO";
		$phone2="32445211";
		$mobile2="1329877777";
		$postalCode2="12343";
		// proceso para generar el envio de la transaccion
		$xml='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pse="https://api.placetopay.com/soap/pse">
		   <soapenv:Header/>
		   <soapenv:Body>
		   
		      <pse:createTransaction>
		         <auth>
		            <login>'.$login.'</login>
		            <tranKey>'.$hashString.'</tranKey>
		            <seed>'.$seed.'</seed>
		            <additional>
		               <!--Zero or more repetitions:-->
		               <item>
		                  <!--You may enter the following 2 items in any order-->
		                  <name></name>
		                  <value></value>
		               </item>
		            </additional>
		         </auth>
		         <transaction>
		            <bankCode>'.$bankCode.'</bankCode>
		            <bankInterface>'.$bankInterface.'</bankInterface>
		            <returnURL>'.$returnURL.'</returnURL>
		            <reference>'.$reference.'</reference>
		            <description>'.$description.'</description>
		            <language>'.$language.'</language>
		            <currency>'.$currency.'</currency>
		            <totalAmount>'.$totalAmount.'</totalAmount>
		            <taxAmount>'.$taxAmount.'</taxAmount>
		            <devolutionBase>'.$devolutionBase.'</devolutionBase>
		            <tipAmount>'.$tipAmount.'</tipAmount>
		            <payer>
		               <!--You may enter the following 12 items in any order-->
		               <documentType>'.$documentType.'</documentType>
		               <document>'.$document.'</document>
		               <firstName>'.$firstName.'</firstName>
		               <lastName>'.$lastName.'</lastName>
		               <company>'.$company.'</company>
		               <emailAddress>'.$emailAddress.'</emailAddress>
		               <address>'.$address.'</address>
		               <city>'.$city.'</city>
		               <province>'.$province.'</province>
		               <country>'.$country.'</country>
		               <phone>'.$phone.'</phone>
		               <mobile>'.$mobile.'</mobile>
		               <postalCode>'.$postalCode.'</postalCode>
		            </payer>
		            <buyer>
		               <documentType>'.$documentType1.'</documentType>
		               <document>'.$document1.'</document>
		               <firstName>'.$firstName1.'</firstName>
		               <lastName>'.$lastName1.'</lastName>
		               <company>'.$company1.'</company>
		               <emailAddress>'.$emailAddress1.'</emailAddress>
		               <address>'.$address1.'</address>
		               <city>'.$city1.'</city>
		               <province>'.$province1.'</province>
		               <country>'.$country1.'</country>
		               <phone>'.$phone1.'</phone>
		               <mobile>'.$mobile1.'</mobile>
		               <postalCode>'.$postalCode1.'</postalCode>
		            </buyer>
		            <shipping>
		               <documentType>'.$documentType2.'</documentType>
		               <document>'.$document2.'</document>
		               <firstName>'.$firstName2.'</firstName>
		               <lastName>'.$lastName2.'</lastName>
		               <company>'.$company2.'</company>
		               <emailAddress>'.$emailAddress2.'</emailAddress>
		               <address>'.$address2.'</address>
		               <city>'.$city2.'</city>
		               <province>'.$province2.'</province>
		               <country>'.$country2.'</country>
		               <phone>'.$phone2.'</phone>
		               <mobile>'.$mobile2.'</mobile>
		               <postalCode>'.$postalCode2.'</postalCode>
		            </shipping>
		            <ipAddress>'.$ip.'</ipAddress>
		            <userAgent>'.$browser_id.'</userAgent>
		            <additionalData>'.$additionalData.'</additionalData>
		         </transaction>
		      </pse:createTransaction>
		   </soapenv:Body>
		</soapenv:Envelope>
		';

		$header=array("Content-Type: text/xml;charset=UTF-8",
			"SOAPAction: https://api.placetopay.com/soap/pse#createTransaction",
			"Content-Length:".strlen($xml));
	
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://test.placetopay.com/soap/pse/?wsdl");
		curl_setopt($curl, CURLOPT_USERAGENT, $browser_id);        
		curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); 
		curl_setopt($curl, CURLOPT_VERBOSE, 1);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$resultx = curl_exec($curl);
		$errorx = curl_error($curl);
		$http_statusx = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		if( $http_statusx != "200" ) {
		  echo  "Error al enviar ".$http_statusx." -- ".$resultx;
		}else {    
		  print_r($resultx);    
		}
		curl_close($curl);
	}


}

?>