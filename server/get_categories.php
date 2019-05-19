<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    try {
      $db_connection = mysqli_connect("127.0.0.1", "root", null, "events_db");
      $db_connection->set_charset("utf8");
      //echo 'connected';
      $req_str = "SELECT distinct e.categories "
                . "FROM events e ";
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