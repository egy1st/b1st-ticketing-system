<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DibyaRiaz_encrypt {


    public function encode($id)
       {
               $newid=base64_encode($id);
               $arr=str_split($newid);
               if(!empty($arr))
               {
                   $brr=array();
                   foreach($arr as $v)
                   {
                           $brr[]=ord($v);
                   }
               }
               if(!empty($brr))
               {
                   $c="";
                   foreach($brr as $v)
                   {
                           $letter = chr(65+rand(0,25));
                           $c=$c.$v.$letter;
                   }
                   $c=substr($c,0,-1);
               }
               $newnum=strrev($c);
               $newarr=str_split($newnum);
               $encoded_id=implode("-",$newarr);
               
               return $encoded_id;
       }
       
       public function decode($id)
       {
               $newid=str_replace("-","",$id);
               $revid=strrev($newid);
               $newrev=preg_replace("/[^0-9?! ]/","-",$revid);
               $getarr=explode("-",$newrev);
               if(!empty($getarr))
               {
                   $ch=array();
                   foreach($getarr as $vv)
                   {
                           $ch[]=chr($vv);
                   }
               }
               $rncoded=join($ch);
               $decoded_id=base64_decode($rncoded);
               return $decoded_id;
       }
}

?>