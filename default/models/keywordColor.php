<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class keywordColor 
{
    /*
     * @param  $result
     * @param  $keyword
     */
    static  function setKeywordColor($result,$keyword){
        $rep_keyword="<font  style=\"color:red;font-size:15px;font-weight:bold;\">".$keyword."</font>";
        $after_replace=str_replace($keyword,"$rep_keyword",$result);
        return $after_replace;
    }
}
?>
