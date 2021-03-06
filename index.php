<!DOCTYPE html>
<html lang="en">
  <head>

    <title>CASG Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
      /* Make the image fully responsive */
      .carousel-inner img {
      width: 100%;
      height: 100%;
      }
    </style>

  </head>


  <body>
    <div class="container d-flex align-items-center"> 
      <h1>CASG Database Home Page</h1>
    </div> 

	  <!-- begin flex container for nav links -->
	  <div class="container d-flex align-items-center">
		
      <!-- begin search link div -->    
      <div class="container p-3 my-3 bg-primary text-white"> 
			
			   <h4> 
			   <!-- <ul class="nav flex-column"> -->
			     <ul class="navbar-nav">		 
    		      <li class="nav-item"> 
      		      <a class="nav-link text-white" href="lot-loc-search-form.php">Locality and Lot Search</a>
       	      </li>
            </ul>  
  		    </h4>

  			  <h4>
      		  <!-- <ul class="nav flex-column"> -->	
      		  <ul class="navbar-nav">	 
    		      <li class="nav-item"> 
      		      <a class="nav-link text-white" href="loan-search-form.php">Loan Search</a> 
    		      </li>
    		    </ul>
    		  </h4>	

    		  <h4>
      		  <!-- <ul class="nav flex-column"> -->	
      		  <ul class="navbar-nav">	 
    		      <li class="nav-item"> 
      		      <a class="nav-link text-white" href="reference-search-form.php">Reference Search</a> 
    		      </li>
    		    </ul>
    		  </h4>	 
      <!-- end search link div -->
      </div>
    

      <!-- begin create records links div-->
      <div class="container p-3 my-3 bg-primary text-white">
        <h4>
            <!-- <ul class="nav flex-column"> --> 
            <ul class="navbar-nav">  
             <li class="nav-item"> 
                <a class="nav-link text-white" href="create-loan-form.php">Create Loan</a> 
             </li>
            </ul>
        </h4>  
    
        <h4>
            <!-- <ul class="nav flex-column"> --> 
            <ul class="navbar-nav">  
              <li class="nav-item"> 
                <a class="nav-link text-white" href="create-person.php">Create Person</a> 
              </li>
            </ul>
        </h4>      
    
        <h4>
            <!-- <ul class="nav flex-column"> --> 
            <ul class="navbar-nav">  
              <li class="nav-item"> 
                <a class="nav-link text-white" href="create-person.php">Create Reference</a> 
              </li>
            </ul>
        </h4>        
      <!--end create records div  -->
      </div>

    <!-- end flex container for nav links -->
	  </div>	
   			

   	<!-- begin container for carousel + controls -->
  	<div class="container">

  		<!-- begin container for carousel images + indicators -->
   		<div id="specimens" class="carousel slide" data-ride="carousel">

  			<!-- Indicators -->
  			<ul class="carousel-indicators">
    			<li data-target="#specimens" data-slide-to="0" class="active"></li>
   			 	<li data-target="#specimens" data-slide-to="1"></li>
    			<li data-target="#specimens" data-slide-to="2"></li>
  			</ul>

  				<!-- images in slideshow-->
  				<div class="carousel-inner">
    				<div class="carousel-item active">
      				<img src="images/direWolf.jpg" alt="dire wolf" width="1100" height="200">
    			  </div>

    			  <div class="carousel-item">
      				<img src="images/forams.jpg" alt="forams" width="1100" height="200">
    			  </div>

    			  <div class="carousel-item">
      			 <img src="images/ammonite.jpg" alt="ammonite" width="1100" height="200">
    			  </div>            
          <!-- end div for images in slideshow  -->
          </div>
        <!-- end div for carousel images + indicators -->
  		</div>
  			

 				<!-- Left and right controls -->
 				<a class="carousel-control-prev" href="#specimens" data-slide="prev">
    			<span class="carousel-control-prev-icon"></span>
  			</a>
  			<a class="carousel-control-next" href="#specimens" data-slide="next">
    			<span class="carousel-control-next-icon"></span>
  			</a>
    <!-- end container for carousel + controls  -->
		</div>
  </body>
</html>