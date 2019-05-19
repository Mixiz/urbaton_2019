<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $categories = !empty($_POST['categories']) ? $_POST['categories'] : '';
    $dates = !empty($_POST['dates']) ? $_POST['dates'] : '05/19/2019 - 05/25/2019';
    $position_x = !empty($_POST['position_x']) ? $_POST['position_x'] : '56.838011';
    $position_y = !empty($_POST['position_y']) ? $_POST['position_y'] : '60.597465';
    
    $dates = explode(' - ', $dates);
    // стартовая позиция
    $point = "POINT($position_x, $position_y)";
    
    //$cat_str = explode(',', $categories);
    //echo json_encode($cat_str);
    //exit;
    
    try {
      $db_connection = mysqli_connect("127.0.0.1", "root", null, "events_db");
      $db_connection->set_charset("utf8");
      $req_str = "SELECT e.descr "
                . "     ,ST_X(e.coords) as latitude "
                . "     ,ST_y(e.coords) as longitude "
                . "     ,e.url "
                . "     ,e.id "
                . "     ,e.title "
                . "FROM events e "
                . "WHERE e.end_date >= STR_TO_DATE('" . $dates[0] . "','%m/%d/%Y')"
                 . " and e.start_date <= STR_TO_DATE('" . $dates[1] . "','%m/%d/%Y')"
                 . " and ST_Distance(e.coords, $point) < 0.05"
                 . " and e.categories in ($categories)";
      //echo json_encode($req_str);
      //exit;
      $result = mysqli_query($db_connection,$req_str);
      $str = '[';
      while ($row = $result->fetch_object()){
        if (strlen($str) > 5 ) {
            $str = $str .',';
        }
        $str = $str . json_encode($row);
        /*$str = $str . '{"descr":"' . $row->descr .'"';
        $str = $str . '"latitude":"' . $row->latitude .'"';
        $str = $str . '"longitude":"' . $row->longitude .'"';
        $str = $str . '"url":"' . $row->url .'"}';
        $i++;
        echo '<br>res';*/
      }
      $str = $str .']';
      //echo $str;
      echo json_encode('{"result":"ok","data":' .$str.'}');
      
      mysqli_free_result($result);
    }
    catch(Exception $ex) {
        echo json_encode('{result:"error"}');
    }
    
    //echo json_encode('{"result":"ok","data":"' . $req_str. '"}');

?>