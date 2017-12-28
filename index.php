<?php
    session_start();
    if(!isset($_SESSION['userName'])){
       
        header("location:login.php");
        
    }
if(isset($_POST["logout"])){
    unset($_SESSION['userName']);
     header("location:index.php");
}
    if(!isset($_SESSION['countView'])){
        $_SESSION['countView'] = 0;
    }
?>

<html>
    <head>
        <title>Login to ChatRoom</title>
          <link href="css/styleIndex.css" type="text/css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">    
    </head>
    
    <body>

        <style>
            
            *{
                padding:0;
                margin: 0;
            }
            #chatRoom p{
                font-family:calibri;
                font-size:40px;
                font-weight: 400;
                padding:0;
               color:white;
                margin: auto;
                margin-top: 50px;
            }
            #chatRoom{
                width:40%; height:auto;;
                border-radius: 10px;
                border:1px solid gray;
                background: #006699;
                margin:auto;
            
            }
            #chatRoom input[type="text"]{
               width:80%;
                height:35px;
                font-family:calibri;
                font-size:18px;
                font-weight: 200;
                padding: 5px 5px 5px 3;
                 border-radius: 5px 0 0 5px;
                 border:1px solid #4d4d4d;
                outline:none;
                  margin-bottom: 10px;
                 margin-top: 10px;
                float:left;
            }
            #chatRoom input[type="text"]:focus{
                 border:3px solid black;
                    
                
            }
             #chatRoom input[type="button"]{
                  background-color:#4d4d4d;
                width:20%;
                 height:35px;
                font-family:calibri;
                font-size:20px;
                font-weight: 200;
                padding: 5px 5px 5px 3;
                  border-radius:0 5px 5px 0 ;
                 border:1px solid #4d4d4d;
                outline:none;
                 color:white;
                margin-top: 10px;
                   float:left;
               
            }
            #chatRoom input[type="button"]:hover{
                background: #196619;
            }
            #chatArea{
                width: 90%;
                height: 60%;
                background: white;
                border-radius: 10px 10px 0 0; 
                    border-bottom: 1px solid gray;
                overflow-y: scroll;
            }

            #inputDiv{
                width: 90%;
                height: auto;
                background: white;
                margin: auto;
                border-radius: 0 0 5px 5px; 
                overflow:hidden;
               
            }
             #controlInputDiv{
                width:95%;
             
                margin: auto;
               
            }
            .recieve h6{
                background: #669999;
                float:left;
                margin:3px 0 3px 5px;
                color:white;
                font-family: calibri;
                font-size: 16px;
                font-weight: 100;
                padding:10px;
                border-radius: 10px;
                overflow: hidden;
            }
            .chatArea::before{
                 content: "";
                position: absolute;
                top: 50%;
                right: 100%;
                margin-top: -5px;
                border-width: 5px;
                border-style: solid;
                border-color: transparent black transparent transparent;
            }
            .sent h6{
                background: #669999;
                float:right;
                margin:3px 5px 0 0;
                color:white;
                font-family: calibri;
                font-size: 16px;
                font-weight: 100;
                padding:10px;
                border-radius: 10px;
                overflow: hidden;
            }
            #chatAreaControlMsg{
                float:left;
                width: 100%;
                
            }
            #chatAreaControlMsg #name1,#name2{
                width: 100%;
                float:left;
            }
            #chatAreaControlMsg #name1 h6{
                font-family: calibri;
                font-size: 16px;
                font-weight: 100;
                float:left;
               
                text-align:left;
                margin: 0 0 0 5px;
                
            }
            #theNotification{
                position: absolute;
                
                cursor: hand;
                font-family: calibri;
                font-size: 16px;
                font-weight: 300;
                margin-top:2%;
                margin-left: calc(13% - 15px);
                padding:4px;color:white;border-radius: 10px;
                background: rgba(0,0,0,.5);
                 display:none;
            }
            #chatAreaControlMsg #name2 h6{
                font-family: calibri;
                 font-family: calibri;
                font-size: 16px;
                font-weight: 100;
                float:right;
                text-align:left;
                margin: 0 0 0 5px;
               
            }
            @media (max-width: 600px) {
                #chatRoom{width:100%;height:100%;}
                 #chatRoom p {font-size:20px;height:30px;}
                #theNotification{
               
                margin-top:2%;
                margin-left: calc(32% - 15px);
               
            }
            }
            
        </style>
        <div id="chatRoom">
            <center>
            <p>Enter Your Name Please... </p>
            <div id="chatArea">
                
                <h1 id="theNotification" onclick="gotoBottom();this.style.display='none';">Click here for new message.</h1>
            </div>
                
                
                
            <div id="inputDiv">
                
                <div id="controlInputDiv">
                   
                        <input type="text" placeholder="Your Name" name="name" id="text" onkeydown="SEND(event)">
                        <input type="button" name="submit" value="OK!" onclick="try{ sendChat();}catch(err){
                    alert(err.message);alert('<?php echo $_SESSION['countView'];?>');
                }" >
                   
                </div>
                
            </div>
                </center>
        </div>
        
         <?php function configCount(){$couniView = $_SESSION['countView']; unset($_SESSION['countView']);}?>
             <script>
                 var firstLoad = true;
               var TheCount = 0;
                 var beforeScroll=0;
    function SEND(){
          var x = event.key;
        if(x == "Enter"){
            sendChat();
        }
    }
     function sendChat(){
         var msg = document.getElementById('text').value;
                if(msg!=""){
                try{
                        
                        
                            if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }

                            xmlhttp.onreadystatechange = function(){

                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){

                                        document.getElementById('text').value = "";
                                        loadlog();
                                        
                                }
                            };

                            
                            xmlhttp.open("GET","send.php?chatWhat="+msg,true);
                           
                            xmlhttp.send();

                       

                    
                }catch(err){
                    alert(err.message);
                }
                }
			} 
    function loadlog(){    
        try{    
           
             var a = TheCount;
              
                        if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }

                            xmlhttp.onreadystatechange = function(){

                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                       
                                    var newDiv = document.createElement("div");
                                    var chatArea = document.getElementById("chatArea");
                                    
                                    newDiv.setAttribute("style","width:100%;height:auto;");
                                    chatArea.appendChild(newDiv);

                                    if(chatArea.scrollTop > ((chatArea.scrollHeight)-400)){
                                        
                                        newDiv.innerHTML= xmlhttp.responseText;       
                                        chatArea.scrollTop = chatArea.scrollHeight;
                                    }else{
                                        if(firstLoad == true){
                                            
                                            newDiv.innerHTML= xmlhttp.responseText;       
                                            chatArea.scrollTop = chatArea.scrollHeight;
                                            firstLoad = false;
                                        }else{
                                            
                                            document.getElementById("theNotification").style.display='block';
                                            newDiv.innerHTML= xmlhttp.responseText;    
                                        }
                                        
                                    }
                                   getCount();
                                    
                                }
                            };
                             
                        
                            xmlhttp.open("GET","send.php?loadChat="+a,true);
                            
                            xmlhttp.send();
        }catch(err){
                    alert(err.message);
                }
}
                 function gotoBottom(){
                      chatArea.scrollTop = chatArea.scrollHeight;
                 }
    function getCount(){    
        try{
                
                  
                        if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }

                            xmlhttp.onreadystatechange = function(){

                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                    TheCount = Number(xmlhttp.responseText);
                                   
                                }
                            };
                             
                        
                            xmlhttp.open("GET","send.php?count=1",true);
                            xmlhttp.send();
        }catch(err){
                    alert(err.message);
                }
}
        
                 
        setInterval(loadlog,1000);         
       
    </script>
    </body>

</html>