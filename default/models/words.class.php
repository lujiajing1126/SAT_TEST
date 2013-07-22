<?php

class words{
   static function patition($org_words){
        $after_p_words=  str_ireplace(";", "<br/>", $org_words);
        return $after_p_words;
    }
}
?>
