<?php

/**
* change plain number to formatted currency
*
* @param $number
* @param $currency
*/
    function mincount($batasWaktu, $waktuAbsen)
    {
        $datetime1 = strtotime($batasWaktu);
        $datetime2 = strtotime($waktuAbsen);
        $interval  = abs($datetime2 - $datetime1);
        $minutes   = round($interval / 60);

        return $minutes;
    }
    function weekendcount($startDate, $endDate)
    {
        $resultDays = array('Workday' => 0, 
                            'Weekend' => 0); 

        // iterate over start to end date 
        while($startDate <= $endDate ){ 
            // find the timestamp value of start date 
            $timestamp = strtotime($startDate->format('d-m-Y')); 
    
            // find out the day for timestamp and increase particular day 
            $weekDay = date('l', $timestamp); 
            if($weekDay == 'Saturday')
            {
                $resultDays['Weekend']  =   $resultDays['Weekend'] +1;
            }
            elseif($weekDay == 'Sunday')
            {
                $resultDays['Weekend']  =   $resultDays['Weekend'] +1;
            }
            else
            {
                $resultDays['Workday']  =   $resultDays['Workday'] +1;
            }
            //$resultDays[$weekDay] = $resultDays[$weekDay] + 1; 
    
            // increase startDate by 1 
            $startDate->modify('+1 day'); 
        } 
    
        // print the result 
        return $resultDays; 
    }
    
    function formatNumber($number, $currency = 'IDR')
    {
        if($currency == 'USD') {
            return number_format($number, 2, '.', ',');
        }
        return 'Rp. '.number_format($number, 0, '.', '.');
    }

    function Parse_Data($data,$p1,$p2){
        $data=" ".$data;
        $hasil="";
        $awal=strpos($data,$p1);
        if($awal!=""){
            $akhir=strpos(strstr($data,$p1),$p2);
            if($akhir!=""){
                $hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
            }
        }
        return $hasil;	
    }

    function TarikDataAbsen($ip, $key, $port)
    {
        $Connect = fsockopen($ip, $port, $errno, $errstr, 1);
        if($Connect){
            $soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
            $newLine="\r\n";
            fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
            fputs($Connect, "Content-Type: text/xml".$newLine);
            fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
            fputs($Connect, $soap_request.$newLine);
            $buffer="";
            while($Response=fgets($Connect, 1024)){
                $buffer=$buffer.$Response;
            }
        }

        $buffer=Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
        $buffer=explode("\r\n",$buffer);
        $hasil = [];
        for($a=1;$a<(count($buffer)-1);$a++){
            $data=Parse_Data($buffer[$a],"<Row>","</Row>");
            $PIN=Parse_Data($data,"<PIN>","</PIN>");
            $DateTime=Parse_Data($data,"<DateTime>","</DateTime>");
            $Verified=Parse_Data($data,"<Verified>","</Verified>");
            $Status=Parse_Data($data,"<Status>","</Status>");

            $hasil[] = [
                'id_kry'    => $PIN,
                'tgl'       => $DateTime,
                'sta'       => $Status
            ];            
        }     
        return $hasil;
    }

    function TarikDataFinger($ip, $key, $id)
    {
        $Connect = fsockopen($ip, "80", $errno, $errstr, 1);
        if($Connect){
            $soap_request="<GetUserTemplate><ArgComKey xsi:type=\"xsd:integer\">".$key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">".$id."</PIN><FingerID xsi:type=\"xsd:integer\">all</FingerID></Arg></GetUserTemplate>";
            $newLine="\r\n";
            fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
            fputs($Connect, "Content-Type: text/xml".$newLine);
            fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
            fputs($Connect, $soap_request.$newLine);
            $buffer="";
            while($Response=fgets($Connect, 1024)){
                $buffer=$buffer.$Response;
            }
        }

        $buffer=Parse_Data($buffer,"<GetUserTemplateResponse>","</GetUserTemplateResponse>");
        $buffer=explode("\r\n",$buffer);
        $hasil = [];
        for($a=1;$a<(count($buffer)-1);$a++){
            $data=Parse_Data($buffer[$a],"<Row>","</Row>");
            $PIN=Parse_Data($data,"<PIN>","</PIN>");
            $FingerID=Parse_Data($data,"<FingerID>","</FingerID>");
            $Size=Parse_Data($data,"<Size>","</Size>");
            $Valid=Parse_Data($data,"<Valid>","</Valid>");
            $Template=Parse_Data($data,"<Template>","</Template>");

            $hasil[] = [
                'id_kry'        => $PIN,
                'jari'          => $FingerID,
                'sidikjari'     => $Template
            ];
        }
        return $hasil;
    }
    
    function UploadNamaKry($ip, $key, $id, $nama)
    {
        $Connect = fsockopen($ip, "80", $errno, $errstr, 1);
        if($Connect){
            $soap_request="<SetUserInfo><ArgComKey Xsi:type=\"xsd:integer\">".$key."</ArgComKey><Arg><PIN>".$id."</PIN><Name>".$nama."</Name></Arg></SetUserInfo>";
            $newLine="\r\n";
            fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
            fputs($Connect, "Content-Type: text/xml".$newLine);
            fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
            fputs($Connect, $soap_request.$newLine);
            $buffer="";
            while($Response=fgets($Connect, 1024)){
                $buffer=$buffer.$Response;
            }
        }
        $buffer=Parse_Data($buffer,"<Information>","</Information>");        
        return $buffer;
    }

    //Laporan Akhir
    function countIzin()
    {
        
    }
?>