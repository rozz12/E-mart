<?php
date_default_timezone_set("Asia/Kathmandu");
include('connection.php');
$orderdate = date('Y-m-d H:i:s');
$included_date = date('Y-m-d H:i:s', strtotime('+24 hour',strtotime($orderdate)));
$weekday = date('l',strtotime($included_date));
$hour = date('H:i:s',strtotime($included_date));
if(strtotime($weekday)==strtotime("Saturday") OR strtotime($weekday)==strtotime("Sunday") OR strtotime($weekday)==strtotime("Monday") OR strtotime($weekday)==strtotime("Tuesday")){                                  
      echo'<form action="" method="POST">
                 <div class="row pb-5">
                 <div class="col-md-5">
                  <label for="collectionslot" class="form-label">
                     Available Collection Day
                    </label>
                    </div>
					<div class="col-md-7">
                    <select class="form-select" name="Collection_day">'; 
               if(strtotime($weekday)==strtotime("Saturday")){        
			           $sql = "Select * from collectionslot where slotid>9";    
			         }
			         else{
			           $sql = "Select * from collectionslot where slotid<10";        
			         }                             
              $res = oci_parse($conn, $sql);
              oci_execute($res);
              while($data=oci_fetch_assoc($res)){          
                if($data['NUMBER_OF_ORDERS']<20){       
                        echo"<option>".$data['DAY']."(".$data['WEEK_COUNT'].")</option>";  
                }  
              } 
              echo'</select>
                    </div>
                    </div>                                   
                    <div class="row pb-5">
                    <div class="col-md-5">
                    <label for="collectionslot" class="form-label">
                    Available Collection Time
                    </label>
                    </div>
                    <div class="col-md-7">
                    <select class="form-select" name="Time_slot">';
                     if(strtotime($weekday)==strtotime("Saturday")){        
			        	        $sql2 = "Select DISTINCT(COLLECTIONTIME) from collectionslot where slotid>9";    
			      	      }
			      	      else{
			        	      $sql2 = "Select DISTINCT(COLLECTIONTIME) from collectionslot where slotid<10";        
			      	      }   
                	$res2 = oci_parse($conn, $sql2);
                	oci_execute($res2);
               		while($data2=oci_fetch_assoc($res2)){          
               			if($data2['NUMBER_OF_ORDERS']<20){       
                   			 echo"<option>".$data2['COLLECTIONTIME']."</option>";  
                		}  
              		}
              echo '</select>
                     </div>
                     </div>
                     <div class="modal-footer d-flex justify-content-md-end justify-content-sm-center collection_buttons">
                     <button  type="Submit" class="btn btn-info" type="button" name="Confirm">Connfirm</button>
                     <button type="button" class="btn btn-danger">Cancel</button>
                      </div>
                      </form>'; 
      /*echo'<form action="" method="POST">
      <select name="day">';
      if(strtotime($weekday)==strtotime("Saturday")){        
        $sql = "Select * from collectionslot where slotid>9";    
      }
      else{
        $sql = "Select * from collectionslot where slotid<10";        
      }      
      $res = oci_parse($conn, $sql);
      oci_execute($res);
      while($data=oci_fetch_assoc($res)){            
          if($data['NUMBER_OF_ORDERS']<20){
            if($data['SLOTID']>9){
                echo'<option value='.$data['SLOTID'].'>'.$data['DAY'].' '.$data['COLLECTIONTIME'].' ('.$data['WEEK_COUNT'].')</option>';          
              }   
              else{
                echo'<option value='.$data['SLOTID'].'>'.$data['DAY'].' '.$data['COLLECTIONTIME'].'</option>';          
              }
          }                           
      }
      echo'</select>              
              <input type="submit" value="Select Slot" name="slotchoose">
              </form>';*/                               
}

//Wednesday
 if(strtotime("Wednesday")==strtotime($weekday)){        
    if(strtotime($hour) < strtotime("10:00:00")){              
      echo'<form action="" method="POST">
                 <div class="row pb-5">
                 <div class="col-md-5">
                  <label for="collectionslot" class="form-label">
                     Available Collection Day
                    </label>
                    </div>
					<div class="col-md-7">
                    <select class="form-select" name="Collection_day">';                             
              $sql = "Select day,week_count from collectionslot where slotid<10";
              $res = oci_parse($conn, $sql);
              oci_execute($res);
              while($data=oci_fetch_assoc($res)){          
                if($data['NUMBER_OF_ORDERS']<20){       
                        echo"<option>".$data['DAY']."(".$data['WEEK_COUNT'].")</option>";  
                }  
              } 
              echo'</select>
                    </div>
                    </div>                                   
                    <div class="row pb-5">
                    <div class="col-md-5">
                    <label for="collectionslot" class="form-label">
                    Available Collection Time
                    </label>
                    </div>
                    <div class="col-md-7">
                    <select class="form-select" name="Time_slot">';
                $sql2 = "Select distinct(collectiontime) from collectionslot where slotid<10";
                $res2 = oci_parse($conn, $sql2);
                oci_execute($res2);
               while($data2=oci_fetch_assoc($res2)){          
               		if($data2['NUMBER_OF_ORDERS']<20){       
                    echo"<option>".$data2['COLLECTIONTIME']."</option>";  
                }  
              }
              echo '</select>
                     </div>
                     </div>
                     <div class="modal-footer d-flex justify-content-md-end justify-content-sm-center collection_buttons">
                     <button  type="Submit" class="btn btn-info" type="button" name="Confirm">Connfirm</button>
                     <button type="button" class="btn btn-danger">Cancel</button>
                      </div>
                      </form>';                                
    }
    else if(strtotime($hour) >= strtotime("10:00:00") AND strtotime($hour) < strtotime("13:00:00")){                  
        echo'<form action="" method="POST">
                 <div class="row pb-5">
                 <div class="col-md-5">
                  <label for="collectionslot" class="form-label">
                     Available Collection Day
                    </label>
                    </div>
					<div class="col-md-7">
                    <select class="form-select" name="Collection_day">';                             
              $sql = "Select day,week_count from collectionslot where slotid!=1 and slotid<10";
              $res = oci_parse($conn, $sql);
              oci_execute($res);
              while($data=oci_fetch_assoc($res)){          
                if($data['NUMBER_OF_ORDERS']<20){       
                        echo"<option>".$data['DAY']."(".$data['WEEK_COUNT'].")</option>";  
                }  
              } 
              echo'</select>
                    </div>
                    </div>                                   
                    <div class="row pb-5">
                    <div class="col-md-5">
                    <label for="collectionslot" class="form-label">
                    Available Collection Time
                    </label>
                    </div>
                    <div class="col-md-7">
                    <select class="form-select" name="Time_slot">';
                $sql2 = "Select distinct(collectiontime) from collectionslot where slotid!=1 and slotid<10";
                $res2 = oci_parse($conn, $sql2);
                oci_execute($res2);
               while($data2=oci_fetch_assoc($res2)){          
               		if($data2['NUMBER_OF_ORDERS']<20){       
                    echo"<option>".$data2['COLLECTIONTIME']."</option>";  
                }  
              }
              echo '</select>
                     </div>
                     </div>
                     <div class="modal-footer d-flex justify-content-md-end justify-content-sm-center collection_buttons">
                     <button  type="Submit" class="btn btn-info" type="button" name="Confirm">Connfirm</button>
                     <button type="button" class="btn btn-danger">Cancel</button>
                      </div>
                      </form>';                
      
    }
    else if(strtotime($hour) >= strtotime("13:00:00") AND strtotime($hour) <= strtotime("16:00:00")){
        echo'<form action="" method="POST">
                 <div class="row pb-5">
                 <div class="col-md-5">
                  <label for="collectionslot" class="form-label">
                     Available Collection Day
                    </label>
                    </div>
					<div class="col-md-7">
                    <select class="form-select" name="Collection_day">';                             
              $sql = "Select day,week_count from collectionslot where slotid>2 and slotid<10";
              $res = oci_parse($conn, $sql);
              oci_execute($res);
              while($data=oci_fetch_assoc($res)){          
                if($data['NUMBER_OF_ORDERS']<20){       
                        echo"<option>".$data['DAY']."(".$data['WEEK_COUNT'].")</option>";  
                }  
              } 
              echo'</select>
                    </div>
                    </div>                                   
                    <div class="row pb-5">
                    <div class="col-md-5">
                    <label for="collectionslot" class="form-label">
                    Available Collection Time
                    </label>
                    </div>
                    <div class="col-md-7">
                    <select class="form-select" name="Time_slot">';
                $sql2 = "Select distinct(collectiontime) from collectionslot where slotid>2 and slotid<10";
                $res2 = oci_parse($conn, $sql2);
                oci_execute($res2);
               while($data2=oci_fetch_assoc($res2)){          
               		if($data2['NUMBER_OF_ORDERS']<20){       
                    echo"<option>".$data2['COLLECTIONTIME']."</option>";  
                }  
              }
              echo '</select>
                     </div>
                     </div>
                     <div class="modal-footer d-flex justify-content-md-end justify-content-sm-center collection_buttons">
                     <button  type="Submit" class="btn btn-info" type="button" name="Confirm">Connfirm</button>
                     <button type="button" class="btn btn-danger">Cancel</button>
                      </div>
                      </form>';                
        
    }
    else{
       echo'<form action="" method="POST">
                 <div class="row pb-5">
                 <div class="col-md-5">
                  <label for="collectionslot" class="form-label">
                     Available Collection Day
                    </label>
                    </div>
					<div class="col-md-7">
                    <select class="form-select" name="Collection_day">';                             
              $sql = "Select day,week_count from collectionslot where slotid>3 and slotid<13";
              $res = oci_parse($conn, $sql);
              oci_execute($res);
              while($data=oci_fetch_assoc($res)){          
                if($data['NUMBER_OF_ORDERS']<20){       
                        echo"<option>".$data['DAY']."(".$data['WEEK_COUNT'].")</option>";  
                }  
              } 
              echo'</select>
                    </div>
                    </div>                                   
                    <div class="row pb-5">
                    <div class="col-md-5">
                    <label for="collectionslot" class="form-label">
                    Available Collection Time
                    </label>
                    </div>
                    <div class="col-md-7">
                    <select class="form-select" name="Time_slot">';
                $sql2 = "Select distinct(collectiontime) from collectionslot where slotid>3 and slotid<13";
                $res2 = oci_parse($conn, $sql2);
                oci_execute($res2);
               while($data2=oci_fetch_assoc($res2)){          
               		if($data2['NUMBER_OF_ORDERS']<20){       
                    echo"<option>".$data2['COLLECTIONTIME']."</option>";  
                }  
              }
              echo '</select>
                     </div>
                     </div>
                     <div class="modal-footer d-flex justify-content-md-end justify-content-sm-center collection_buttons">
                     <button  type="Submit" class="btn btn-info" type="button" name="Confirm">Connfirm</button>
                     <button type="button" class="btn btn-danger">Cancel</button>
                      </div>
                      </form>'; 
              
    }
}
//thursday
if(strtotime("Thursday")==strtotime($weekday)){
    if(strtotime($hour) < strtotime("10:00:00")){
       echo'<form action="" method="POST">
                 <div class="row pb-5">
                 <div class="col-md-5">
                  <label for="collectionslot" class="form-label">
                     Available Collection Day
                    </label>
                    </div>
					<div class="col-md-7">
                    <select class="form-select" name="Collection_day">';                             
              $sql = "Select day,week_count from collectionslot where slotid>3 and slotid<13";
              $res = oci_parse($conn, $sql);
              oci_execute($res);
              while($data=oci_fetch_assoc($res)){          
                if($data['NUMBER_OF_ORDERS']<20){       
                        echo"<option>".$data['DAY']."(".$data['WEEK_COUNT'].")</option>";  
                }  
              } 
              echo'</select>
                    </div>
                    </div>                                   
                    <div class="row pb-5">
                    <div class="col-md-5">
                    <label for="collectionslot" class="form-label">
                    Available Collection Time
                    </label>
                    </div>
                    <div class="col-md-7">
                    <select class="form-select" name="Time_slot">';
                $sql2 = "Select distinct(collectiontime) from collectionslot where slotid>3 and slotid<13";
                $res2 = oci_parse($conn, $sql2);
                oci_execute($res2);
               while($data2=oci_fetch_assoc($res2)){          
               		if($data2['NUMBER_OF_ORDERS']<20){       
                    echo"<option>".$data2['COLLECTIONTIME']."</option>";  
                }  
              }
              echo '</select>
                     </div>
                     </div>
                     <div class="modal-footer d-flex justify-content-md-end justify-content-sm-center collection_buttons">
                     <button  type="Submit" class="btn btn-info" type="button" name="Confirm">Connfirm</button>
                     <button type="button" class="btn btn-danger">Cancel</button>
                      </div>
                      </form>'; 
              
    }
    else if(strtotime($hour) >= strtotime("10:00:00") AND strtotime($hour) < strtotime("13:00:00")){
        echo'<form action="" method="POST">
                 <div class="row pb-5">
                 <div class="col-md-5">
                  <label for="collectionslot" class="form-label">
                     Available Collection Day
                    </label>
                    </div>
					<div class="col-md-7">
                    <select class="form-select" name="Collection_day">';                             
              $sql = "Select day,week_count from collectionslot where slotid>4 and slotid<13";
              $res = oci_parse($conn, $sql);
              oci_execute($res);
              while($data=oci_fetch_assoc($res)){          
                if($data['NUMBER_OF_ORDERS']<20){       
                        echo"<option>".$data['DAY']."(".$data['WEEK_COUNT'].")</option>";  
                }  
              } 
              echo'</select>
                    </div>
                    </div>                                   
                    <div class="row pb-5">
                    <div class="col-md-5">
                    <label for="collectionslot" class="form-label">
                    Available Collection Time
                    </label>
                    </div>
                    <div class="col-md-7">
                    <select class="form-select" name="Time_slot">';
                $sql2 = "Select distinct(collectiontime) from collectionslot where slotid>4 and slotid<13";
                $res2 = oci_parse($conn, $sql2);
                oci_execute($res2);
               while($data2=oci_fetch_assoc($res2)){          
               		if($data2['NUMBER_OF_ORDERS']<20){       
                    echo"<option>".$data2['COLLECTIONTIME']."</option>";  
                }  
              }
              echo '</select>
                     </div>
                     </div>
                     <div class="modal-footer d-flex justify-content-md-end justify-content-sm-center collection_buttons">
                     <button  type="Submit" class="btn btn-info" type="button" name="Confirm">Connfirm</button>
                     <button type="button" class="btn btn-danger">Cancel</button>
                      </div>
                      </form>'; 
    }
    else if(strtotime($hour) >= strtotime("13:00:00") AND strtotime($hour) < strtotime("16:00:00")){
      echo'<form action="" method="POST">
                 <div class="row pb-5">
                 <div class="col-md-5">
                  <label for="collectionslot" class="form-label">
                     Available Collection Day
                    </label>
                    </div>
					<div class="col-md-7">
                    <select class="form-select" name="Collection_day">';                             
              $sql = "Select day,week_count from collectionslot where slotid>5 and slotid<13";
              $res = oci_parse($conn, $sql);
              oci_execute($res);
              while($data=oci_fetch_assoc($res)){          
                if($data['NUMBER_OF_ORDERS']<20){       
                        echo"<option>".$data['DAY']."(".$data['WEEK_COUNT'].")</option>";  
                }  
              } 
              echo'</select>
                    </div>
                    </div>                                   
                    <div class="row pb-5">
                    <div class="col-md-5">
                    <label for="collectionslot" class="form-label">
                    Available Collection Time
                    </label>
                    </div>
                    <div class="col-md-7">
                    <select class="form-select" name="Time_slot">';
                $sql2 = "Select distinct(collectiontime) from collectionslot where slotid>5 and slotid<13";
                $res2 = oci_parse($conn, $sql2);
                oci_execute($res2);
               while($data2=oci_fetch_assoc($res2)){          
               		if($data2['NUMBER_OF_ORDERS']<20){       
                    echo"<option>".$data2['COLLECTIONTIME']."</option>";  
                }  
              }
              echo '</select>
                     </div>
                     </div>
                     <div class="modal-footer d-flex justify-content-md-end justify-content-sm-center collection_buttons">
                     <button  type="Submit" class="btn btn-info" type="button" name="Confirm">Connfirm</button>
                     <button type="button" class="btn btn-danger">Cancel</button>
                      </div>
                      </form>'; 
              
    }
    else{
       echo'<form action="" method="POST">
                 <div class="row pb-5">
                 <div class="col-md-5">
                  <label for="collectionslot" class="form-label">
                     Available Collection Day
                    </label>
                    </div>
					<div class="col-md-7">
                    <select class="form-select" name="Collection_day">';                             
              $sql = "Select day,week_count from collectionslot where slotid>6 and slotid<16";
              $res = oci_parse($conn, $sql);
              oci_execute($res);
              while($data=oci_fetch_assoc($res)){          
                if($data['NUMBER_OF_ORDERS']<20){       
                        echo"<option>".$data['DAY']."(".$data['WEEK_COUNT'].")</option>";  
                }  
              } 
              echo'</select>
                    </div>
                    </div>                                   
                    <div class="row pb-5">
                    <div class="col-md-5">
                    <label for="collectionslot" class="form-label">
                    Available Collection Time
                    </label>
                    </div>
                    <div class="col-md-7">
                    <select class="form-select" name="Time_slot">';
                $sql2 = "Select distinct(collectiontime) from collectionslot where slotid>6 and slotid<16";
                $res2 = oci_parse($conn, $sql2);
                oci_execute($res2);
               while($data2=oci_fetch_assoc($res2)){          
               		if($data2['NUMBER_OF_ORDERS']<20){       
                    echo"<option>".$data2['COLLECTIONTIME']."</option>";  
                }  
              }
              echo '</select>
                     </div>
                     </div>
                     <div class="modal-footer d-flex justify-content-md-end justify-content-sm-center collection_buttons">
                     <button  type="Submit" class="btn btn-info" type="button" name="Confirm">Connfirm</button>
                     <button type="button" class="btn btn-danger">Cancel</button>
                      </div>
                      </form>'; 
              
    }

}
//friday
if(strtotime("Friday")==strtotime($weekday)){
    if(strtotime($hour) < strtotime("10:00:00")){
        echo'<form action="" method="POST">
                 <div class="row pb-5">
                 <div class="col-md-5">
                  <label for="collectionslot" class="form-label">
                     Available Collection Day
                    </label>
                    </div>
					<div class="col-md-7">
                    <select class="form-select" name="Collection_day">';                             
              $sql = "Select day,week_count from collectionslot where slotid>6 and slotid<16";
              $res = oci_parse($conn, $sql);
              oci_execute($res);
              while($data=oci_fetch_assoc($res)){          
                if($data['NUMBER_OF_ORDERS']<20){       
                        echo"<option>".$data['DAY']."(".$data['WEEK_COUNT'].")</option>";  
                }  
              } 
              echo'</select>
                    </div>
                    </div>                                   
                    <div class="row pb-5">
                    <div class="col-md-5">
                    <label for="collectionslot" class="form-label">
                    Available Collection Time
                    </label>
                    </div>
                    <div class="col-md-7">
                    <select class="form-select" name="Time_slot">';
                $sql2 = "Select distinct(collectiontime) from collectionslot where slotid>6 and slotid<16";
                $res2 = oci_parse($conn, $sql2);
                oci_execute($res2);
               while($data2=oci_fetch_assoc($res2)){          
               		if($data2['NUMBER_OF_ORDERS']<20){       
                    echo"<option>".$data2['COLLECTIONTIME']."</option>";  
                }  
              }
              echo '</select>
                     </div>
                     </div>
                     <div class="modal-footer d-flex justify-content-md-end justify-content-sm-center collection_buttons">
                     <button  type="Submit" class="btn btn-info" type="button" name="Confirm">Connfirm</button>
                     <button type="button" class="btn btn-danger">Cancel</button>
                      </div>
                      </form>'; 
              
    }
    else if(strtotime($hour) >= strtotime("10:00:00") AND strtotime($hour) < strtotime("13:00:00")){
       echo'<form action="" method="POST">
                 <div class="row pb-5">
                 <div class="col-md-5">
                  <label for="collectionslot" class="form-label">
                     Available Collection Day
                    </label>
                    </div>
					<div class="col-md-7">
                    <select class="form-select" name="Collection_day">';                             
              $sql = "Select day,week_count from collectionslot where slotid>7 and slotid<16";
              $res = oci_parse($conn, $sql);
              oci_execute($res);
              while($data=oci_fetch_assoc($res)){          
                if($data['NUMBER_OF_ORDERS']<20){       
                        echo"<option>".$data['DAY']."(".$data['WEEK_COUNT'].")</option>";  
                }  
              } 
              echo'</select>
                    </div>
                    </div>                                   
                    <div class="row pb-5">
                    <div class="col-md-5">
                    <label for="collectionslot" class="form-label">
                    Available Collection Time
                    </label>
                    </div>
                    <div class="col-md-7">
                    <select class="form-select" name="Time_slot">';
                $sql2 = "Select distinct(collectiontime) from collectionslot where slotid>7 and slotid<16";
                $res2 = oci_parse($conn, $sql2);
                oci_execute($res2);
               while($data2=oci_fetch_assoc($res2)){          
               		if($data2['NUMBER_OF_ORDERS']<20){       
                    echo"<option>".$data2['COLLECTIONTIME']."</option>";  
                }  
              }
              echo '</select>
                     </div>
                     </div>
                     <div class="modal-footer d-flex justify-content-md-end justify-content-sm-center collection_buttons">
                     <button  type="Submit" class="btn btn-info" type="button" name="Confirm">Connfirm</button>
                     <button type="button" class="btn btn-danger">Cancel</button>
                      </div>
                      </form>'; 
        
    }
    else if(strtotime($hour) >= strtotime("13:00:00") AND strtotime($hour) < strtotime("16:00:00")){
       echo'<form action="" method="POST">
                 <div class="row pb-5">
                 <div class="col-md-5">
                  <label for="collectionslot" class="form-label">
                     Available Collection Day
                    </label>
                    </div>
					<div class="col-md-7">
                    <select class="form-select" name="Collection_day">';                             
              $sql = "Select day,week_count from collectionslot where slotid>8 and slotid<16";
              $res = oci_parse($conn, $sql);
              oci_execute($res);
              while($data=oci_fetch_assoc($res)){          
                if($data['NUMBER_OF_ORDERS']<20){       
                        echo"<option>".$data['DAY']."(".$data['WEEK_COUNT'].")</option>";  
                }  
              } 
              echo'</select>
                    </div>
                    </div>                                   
                    <div class="row pb-5">
                    <div class="col-md-5">
                    <label for="collectionslot" class="form-label">
                    Available Collection Time
                    </label>
                    </div>
                    <div class="col-md-7">
                    <select class="form-select" name="Time_slot">';
                $sql2 = "Select distinct(collectiontime) from collectionslot where slotid>8 and slotid<16";
                $res2 = oci_parse($conn, $sql2);
                oci_execute($res2);
               while($data2=oci_fetch_assoc($res2)){          
               		if($data2['NUMBER_OF_ORDERS']<20){       
                    echo"<option>".$data2['COLLECTIONTIME']."</option>";  
                }  
              }
              echo '</select>
                     </div>
                     </div>
                     <div class="modal-footer d-flex justify-content-md-end justify-content-sm-center collection_buttons">
                     <button  type="Submit" class="btn btn-info" type="button" name="Confirm">Connfirm</button>
                     <button type="button" class="btn btn-danger">Cancel</button>
                      </div>
                      </form>'; 
              
    }
              
    else{
        echo'<form action="" method="POST">
                 <div class="row pb-5">
                 <div class="col-md-5">
                  <label for="collectionslot" class="form-label">
                     Available Collection Day
                    </label>
                    </div>
					<div class="col-md-7">
                    <select class="form-select" name="Collection_day">';                             
              $sql = "Select day,week_count from collectionslot where slotid>9";
              $res = oci_parse($conn, $sql);
              oci_execute($res);
              while($data=oci_fetch_assoc($res)){          
                if($data['NUMBER_OF_ORDERS']<20){       
                        echo"<option>".$data['DAY']."(".$data['WEEK_COUNT'].")</option>";  
                }  
              } 
              echo'</select>
                    </div>
                    </div>                                   
                    <div class="row pb-5">
                    <div class="col-md-5">
                    <label for="collectionslot" class="form-label">
                    Available Collection Time
                    </label>
                    </div>
                    <div class="col-md-7">
                    <select class="form-select" name="Time_slot">';
                $sql2 = "Select distinct(collectiontime) from collectionslot where slotid>9";
                $res2 = oci_parse($conn, $sql2);
                oci_execute($res2);
               while($data2=oci_fetch_assoc($res2)){          
               		if($data2['NUMBER_OF_ORDERS']<20){       
                    echo"<option>".$data2['COLLECTIONTIME']."</option>";  
                }  
              }
              echo '</select>
                     </div>
                     </div>
                     <div class="modal-footer d-flex justify-content-md-end justify-content-sm-center collection_buttons">
                     <button  type="Submit" class="btn btn-info" type="button" name="Confirm">Connfirm</button>
                     <button type="button" class="btn btn-danger">Cancel</button>
                      </div>
                      </form>'; 
              
    }
}

//check if confirm has been clicked or not
if(isset($_POST['Confirm'])){
  $collect_day =  explode('(',$_POST['Collection_day']);
  if ($collect_day[1] == 'Next Week') {
    $day = 'Next '.$collect_day[0];
      $Collection_day =  date('Y-m-d',strtotime($day,strtotime($collect_day[0])));
      $_SESSION['Collection_day']  = $Collection_day;
  }
  else{
    $Collection_day =  date('d-m-Y h:i:s',strtotime($collect_day[0]));
    $_SESSION['Collection_day']  = $Collection_day;
  }
  $_SESSION['Time_slot'] = $_POST['Time_slot'];
}
?>

<!--   echo"<option>".$data['SLOTID'].">".$data['DAY'].">".$data['COLLECTIONTIME'].">".$data['WEEK_COUNT']."</option>";   -->