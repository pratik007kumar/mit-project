<style>
 .pagin-width{ width: 100% !important; margin: 0 auto;  }   
.pagination{height:40px;margin:20px auto!important;  width: 100% !important;}
.pagination ul{display:inline-block;*display:inline;margin-bottom:0;margin-left:0;-webkit-border-radius:2px;-moz-border-radius:3px;border-radius:3px;*zoom:1;-webkit-box-shadow:0 1px 2px rgba(0,0,0,0.05);-moz-box-shadow:0 1px 2px rgba(0,0,0,0.05);box-shadow:0 1px 2px rgba(0,0,0,0.05)}.pagination li{display:inline}.pagination a,.pagination span{float:left;padding:0 14px;line-height:38px;text-decoration:none;background-color:#fff;border:1px solid #ddd;border-left-width:0}.pagination a:hover,.pagination .active a,.pagination .active span{background-color:#f5f5f5}.pagination .active a,
.pagination .active span{color:#999;cursor:default}.pagination .disabled span,
.pagination .disabled a,
.pagination .disabled a:hover{color:#999 !important;cursor:default;background-color:transparent}
.pagination li:first-child a,
.pagination li:first-child span{border-left-width:1px;-webkit-border-radius:3px 0 0 3px;-moz-border-radius:3px 0 0 3px;border-radius:3px 0 0 3px}
.pagination li:last-child a,
.pagination li:last-child span{-webkit-border-radius:0 3px 3px 0;-moz-border-radius:0 3px 3px 0;border-radius:0 3px 3px 0}
.pagination-centered{text-align:center}
.pagination-right{text-align:right}
.pager{margin:20px 0;text-align:center;list-style:none;*zoom:1}
.pager:before,.pager:after{display:table;line-height:0;content:""}
.pager:after{clear:both}.pager li{display:inline}
.pager a{display:inline-block;padding:5px 14px;background-color:#fff;border:1px solid #ddd;-webkit-border-radius:15px;-moz-border-radius:15px;border-radius:15px}.pager a:hover{text-decoration:none;background-color:#f5f5f5}.pager .next a{float:right}.pager .previous a{float:left}.pager .disabled a,.pager .disabled a:hover{color:#999;cursor:default;background-color:#fff}
    
    
</style>

<?php

function paginate($reload, $page, $tpages) {
    $adjacents = $tpages;
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $out = "";
    // previous
    if ($page == 1) {
        $out.= "<span>".$prevlabel."</span>\n";
    } elseif ($page == 2) {
        $out.="<li><a href=\"".$reload."\">".$prevlabel."</a>\n</li>";
    } else {
        $out.="<li><a href=\"".$reload."&amp;page=".($page - 1)."\">".$prevlabel."</a>\n</li>";
    }
    $pmin=($page>$adjacents)?($page - $adjacents):1;
    $pmax=($page<($tpages - $adjacents))?($page + $adjacents):$tpages;
    for ($i = $pmin; $i <= $pmax; $i++) {
        if ($i == $page) {
            $out.= "<li class=\"active\"><a href=''>".$i."</a></li>\n";
        } elseif ($i == 1) {
            $out.= "<li><a href=\"".$reload."\">".$i."</a>\n</li>";
        } else {
            $out.= "<li><a href=\"".$reload. "&amp;page=".$i."\">".$i. "</a>\n</li>";
        }
    }
    
    if ($page<($tpages - $adjacents)) {
        $out.= "<a style='font-size:11px' href=\"" . $reload."&amp;page=".$tpages."\">" .$tpages."</a>\n";
    }
    // next
    if ($page < $tpages) {
        $out.= "<li><a href=\"".$reload."&amp;page=".($page + 1)."\">".$nextlabel."</a>\n</li>";
    } else {
        $out.= "<span style='font-size:11px'>".$nextlabel."</span>\n";
    }
    $out.= "";
    return $out;
}