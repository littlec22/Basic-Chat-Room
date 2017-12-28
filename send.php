<?php 
   

    
    if(mysqli_connect_errno()){
	 echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    
    if(isset($_GET['chatWhat'])){
        session_start();
         $connection = mysqli_connect("localhost", "root" ,"","my chat")or die(mysqli_error());
        $msg= htmlspecialchars($_GET['chatWhat']);
        $msg= mysqli_real_escape_string($connection,$msg);
        
         $user= htmlspecialchars($_SESSION['userName']);
        $user= mysqli_real_escape_string($connection,$user);
        
        try{
                 $insert = mysqli_query($connection,"INSERT INTO `messages`(`chat`,`userName`) VALUES ('$msg','$user')")
                    or die("Err:001:".mysqli_error($connection));
                    if($insert){
                             
                              
                       }else{
                    }
                }catch(Exception $e) {
                    echo "<script>alert('". $e->getMessage()."'')</script>";
                }
    }
    if(isset($_GET['loadChat'])){
        loadChat($_GET['loadChat']);
    }

function loadChat($a){
    session_start();
          
            try{
                 $connection = mysqli_connect("localhost", "root" ,"","my chat")or die(mysqli_error());
                
                 $select1 = mysqli_query($connection,"SELECT `msgID` FROM `messages` ORDER BY `msgID` desc ")
                    or die("Err:001:".mysqli_error($connection));
                    $res1 = mysqli_fetch_assoc($select1);
                    if($res1){
                        $countMsg = $res1['msgID'];
                        
                   
                        if($a <= $countMsg){   
                        
                        $search = $a +1;
                        $select = mysqli_query($connection,"SELECT `msgID`,`chat`, `time`,`userName` FROM `messages`  ORDER BY `msgID`  limit $a,$countMsg ")
                        or die("Err:001:".mysqli_error($connection));
                        
                        if($select){
                            
                             while($res = mysqli_fetch_assoc($select)){
                                $name = $res['userName'];
                                $time = $res['time'];
                                $chat = $res['chat'];
                                $user =  $_SESSION['userName'];
                            if($name ==$user){
                                ?>


                                     <div id="chatAreaControlMsg">
                                          <span id="name2"><h6><?php echo $name ;?></h6></span>
                                        <span class="sent" style = ""><h6><?php echo $chat ;?></h6></span>
                                    </div>
                                    <hr>

                                <?php
                                
                            }else{
                                ?>


                                     <div id="chatAreaControlMsg">
                                          <span id="name1"><h6><?php echo $name ;?></h6></span>
                                        <span class="recieve" style = ""><h6><?php echo $chat ;?></h6></span>
                                    </div>
                                    <hr>
                                    
                                <?php
                               
                            }
                             $a = $a + 1;        
                        }
                        
                         
                         
                     }
                        }
                        
                 }$_SESSION['countView'] = $a; 
                    
                    
                }catch(Exception $e) {
                    echo "<script>alert('". $e->getMessage()."'')</script>";
                }
}

if(isset($_GET['count'])){
    session_start();
 
    echo $_SESSION['countView'];
}
?>