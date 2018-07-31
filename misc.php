<?php 
               $count += 1;
               $output .= "<div class='container'><div class='entry-add'><h2 id='head".$count."' class='username-add'></h2>";
               $output .= "<div id='ansAdd".$count."' class='answer-add'></div>";
               $output .= "</div></div>";
            ?>



            //counter += 1;
           <?php
              //$responses = $no_response['num'];
            ?>
            //var currResp = <?php echo $responses+1;?>+" Answers";
            //var user = document.getElementById('hidden').value;
            //document.getElementById("count").innerHTML = currResp;
             
            //document.getElementById('head'+counter).innerHTML = user;
            //document.getElementById('ansAdd'+counter).innerHTML = response;








                        <?php
               $responses_query = mysqli_query($con,"SELECT COUNT(*) AS num FROM response WHERE response_to_user='$qby' AND response_to_question='$q'");
               $no_response = mysqli_fetch_assoc($responses_query);
               $responses = $no_response['num'];
               ?>console.log(<?php echo $responses; ?>);<?php
               $output = ""; 
               $output .= "<div class='container'><div class='entry'><h2 class='username'><b>".$qby."</b></h2>";
               $output .= "<div class='question'>".$q."</div><br>";
               $output .= "</div></div>";
               $output .= "<div class='container'><div id='count' class='entry1'>".$responses." Answers</div></div>";
               ?>console.log(<?php echo $output; ?>); <?php
               $get_responses = mysqli_query($con,"SELECT * FROM response WHERE response_to_user='$qby' AND response_to_question='$q'"); 
               while($response_result = mysqli_fetch_assoc($get_responses))
               {
                 ?>console.log("hi");<?php
                 $output .= "<div class='container'><div class='entry'><h2 class='usernamea'>".$response_result['response_by']."</h2>";
                 $output .= "<div class='answer'>".$response_result['response']."</div>";
                 $output .= "</div></div>";
               }
               
            ?>














                  for(var i = 1;i<=counter;i++)
           {
             var div1=document.createElement("div");
             var containerClass=document.createAttribute("class");
             containerClass.value="container";
             div1.setAttributeNode(containerClass);

             var div2=document.createElement("div");
             var entryClass=document.createAttribute("class");
             entryClass.value="entry";
             div2.setAttributeNode(entryClass);

             var h2=document.createElement("h2");
             var usernameaClass=document.createAttribute("class");
             usernameaClass.value="usernamea";
             h2.setAttributeNode(usernameaClass);
             h2.innerHTML=user;

             var div3=document.createElement("div");
             var newAnsId=document.createAttribute("id");
             newAnsId.value="newAns";
             div3.setAttributeNode(newAnsId);
             div3.innerHTML=response;

             div2.appendChild(h2);
             div2.appendChild(div3);
             div1.appendChild(div2);
           }



           ?><script type="text/javascript">console.log("henloo")</script><?php


           how to display my data on submit press without page refresh