<?php 
function get_pagging($data,$limit,$page,$url=''){
    $total_data= count($data);
    $total_link= ceil($total_data/$limit);
    $pre_link= '';
    $next_link= '';
    $page_link='';

    if($total_link>6){
            if($page<5){
                for($count=1;$count<=5;$count++){
                    $page_array[]=$count;
                }
                $page_array[]='...';
                $page_array[]=$total_link;
            }
            else
            {
                $end_limit=$total_link-5;
                if($page>$end_limit){
                    $page_array[]=1;
                    $page_array[]='...';
                    for($count=$end_limit;$count<=$total_link;$count++){
                        $page_array[]=$count;
                    }
                }
                else
                {
                    $page_array[]=1;
                    $page_array[]='...';
                    for($count=$page-1;$count<$page+1;$count++){
                        $page_array[]=$count;
                    }
                    $page_array[]='...';
                    $page_array[]=$total_link;
                }
            }
    }
    else
    {
        for($count=1;$count<=$total_link;$count++)
        {
            $page_array[]=$count;
        }
    }
    if(isset($page_array)){
        for($count=0; $count< count($page_array);$count++){
            if($page==$page_array[$count]){
                $page_link .= '
                <li class="active"><a href="'.$url.'/'.$page_array[$count].'">' . $page_array[$count] . '</a> </li>
                ';
                $previous_id = $page_array[$count] - 1;
                if($previous_id>0){
                    $pre_link = '<li><a class="page-link" href="'.$url.'/'.$previous_id.'" data-page_number="' . $previous_id . '">Trước</a></li>';
                }else {
                    $pre_link = ' <li class="disabled"><a class="page-link"  >Trước</a></li> ';
                }
                $next_id = $page_array[$count] + 1;
                    if ($next_id > $total_link) {
                        $next_link = ' <li class="disabled"><a class="page-link" >Sau</a></li> ';
                    } else {
                        $next_link = '<li><a  class="page-link" href="'.$url.'/'.$next_id.'" data-page_number="' . $next_id . '">Sau</a></li>';
                    }
                
            }
            else{
                if ($page_array[$count] == '...') {
                    $page_link .= '<li class="disabled"><a class="page-link" href="#">...</a></li>';
                } else {
                    $page_link .= '<li class="page-item"><a class="page-link" href="'.$url.'/'.$page_array[$count].'" 
                    data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a></li>';
                }
            }
        }
    }
    return  $pre_link.$page_link.$next_link;

}
?>  