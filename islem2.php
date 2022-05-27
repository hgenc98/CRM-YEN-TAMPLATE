
<?php
function sayfalar($dizi){
   
    $html = "";
    $html.='<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'8\' height=\'8\'%3E%3Cpath d=\'M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z\' fill=\'currentColor\'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">';
    $html.='<ol class="breadcrumb ">';
    $html.='<li class="breadcrumb-item active"><a href="anasayfa.php">Anasayfa</a></li>';
    // $html.='<li class="breadcrumb-item"><a href="#">'.$_SERVER['REQUEST_URI'].'</a></li>';
    foreach($dizi as $sayfa){
             $html.='<li class="breadcrumb-item active"><a href="#">'. $sayfa.'</a></li>';

    }
    $html.='</ol>';
    $html.='</nav>';
    return ($html) ;
}
?>