   <!-- ======= Header ======= -->
   <div class="d-flex fixed-top justify-content-around bg-dark" id="tete">
         <div class="bars" id="navCollapse" onclick="bars(this)">
             <div class=" bar1" id="bar"></div>
             <div class=" bar2" id="bar"></div>
             <div class=" bar3" id="bar"></div>
        </div> 
        <h5 class="text-white mt-2 logo ">LOGO</h5>
        <h4 class="text-white titre1 mt-1">GESTION DE STOCK ET FACTURATION</h4>
        <!--Dropdown header-->
        <div class="dropdown mt-2" >
            <a class="text-light dropdown-toggle" data-toggle="dropdown" id="btn-dd" >
               <i class="fas fa-user user-haut"></i> 
               <?php
                 
                  if(isset($_SESSION["nom1"])){
         
               ?>
               <span class="salutation text-capitalize"> Bonjour, <?php echo $_SESSION["nom1"]; ?> </span>
               <?php

                  }else {

               ?>
                     <span class="salutation"> Bonjour, NANA</span>
               <?php  
                  }
               ?>
            </a> 
            <div class="bg-dark  dropdown-menu " id="dd-menu">
               <a  class="dropdown-item text-light " href="utilisateur.php" id="dd-list">
                  <i class="fas fa-list fa-sm"></i> <span class="px-2">Liste</span> 
               </a><br>
               <a  class="dropdown-item  text-light " href="loginout.php" id="dd-list">
                  <i class="fas fa-sign-out-alt  fa-sm"></i> <span class="px-2">Deconnecter</span>
               </a><br>
            </div>     
         </div>
    </div>
    <!-- ======= Header Fin ======= -->