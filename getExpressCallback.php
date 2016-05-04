<?php 
      
    //获得参数
    $nu = $_GET['nu'];
    $com = $_GET['com'];
    
    if(isset($nu)&&isset($com)){
        $url="http://www.kuaidi100.com/applyurl?key=1e960d4870110763&com=".$com."&nu=".$nu;
        $html=file_get_contents($url);
        echo $html;
    }

?>