


<!DOCTYPE HTML>  
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
		<meta name="description" content="Create webview for Chatfuel">
		<meta name="keywords" content="Chatfuel, Chatbot, JSON, Plugin">
		<meta name="author" content="J. Rian Matawi">
				
		<title>Make a Pizza</title>
		<!--
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
				
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<script type="text/javascript" src="cf_webview.js?3Szlv" ></script>
		
		<!--
		<link rel="stylesheet" href="cf_webview.css">
		-->
		
		<style>
			p span 
			{
				padding-left:10px; 
				display:inlineblock;
			}

			.footer 
			{
				position: fixed;
				left: 0;
				z-index: 5; /* Sit on top */
				bottom: 0;
				width: 100%;
				background-color: blue;
				color: white;
				text-align: center;
			}
			
			.slider 
			{
				-webkit-appearance: none;
				width: 100%;
				height: 15px;
				border-radius: 5px;
				background: #d3d3d3;
				outline: none;
				opacity: 0.7;
				-webkit-transition: .2s;
				transition: opacity .2s;
			}

			.slider::-webkit-slider-thumb 
			{
				-webkit-appearance: none;
				appearance: none;
				width: 25px;
				height: 25px;
				border-radius: 50%;
				background: black;
				cursor: pointer;
			}

		</style>
		
		<style>
			body { 
background-color: white; 
background-image: url("https://cdn.shopify.com/s/files/1/0879/0542/products/PC1367_b3de8ae9-6c70-40e3-bf22-7e650f77eeb1_1024x1024.jpg?v=1513996898"); 
background-repeat: no-repeat; 
background-size: cover; 
} 
label { 
color: white; 
font-size: 16px; 
} 
.form-control { 
font-size: 18px; 
} 
.btn { 
//font-size:16px; 
//background-color: blue; 
} 
.btn-danger { 
//font-size:14px; 
background-color: red; 
} 
.btn-info { 
//font-size:14px; 
background-color: green; 
}		</style>
		
		
		
	</head>
	
	<body>

        <form class="w3-container w3-card-4" style="background-color:rgba(255,255,255,0.5);" action="https://www.messenger.com/closeWindow/?image_url=IMAGE_URL&display_text=Please%20close%20this%20window%20to%20continue" method="post" >
		
		<!-- CLIENT BUILDS -->
		
						<label>Pick a Size (DropdownList)</label>
						<div class="input-group input-group-lg" >
							<span class="input-group-addon glyphicon glyphicon-list" id="basic-addon1"></span>
							<select  name="pizza_size" id="pizza_size" class="form-control"><option value="Small">Small</option><option value="Medium">Medium</option><option value="Large">Large</option></select>
						</div>
						<label>Pick your Toppings (Multiselect Conditional List)</label>
							<div class="input-group input-group-lg" >
							<span class="input-group-addon glyphicon glyphicon-list" id="basic-addon1"></span>
							<select  data-type="checkbox" onchange="conditional(this)" name="toppings" id="toppings" class="form-control">
								<option></option><option data-subs="Pepperoni,Mushrooms,Onions,Sausage,Bacon,Extra cheese,Black olives,Green peppers,Pineapple,Spinach" value="Mix">Mix</option><option data-subs="Pepperoni,Sausage,Bacon,Extra cheese,BBQ Chicken,Meatballs,Smoked turkey,BBQ Pork" value="Meatlover">Meatlover</option><option data-subs="Mushrooms,Onions,Black olives,Green peppers,Pineapple,Spinach" value="Veggie">Veggie</option></select>
							</div>
								
							<div>
								<p name="opt_toppings" id="opt_toppings"></p>
							</div>
							
							<br>
							
						<label>Amount</label>
						<div class="input-group input-group-lg" >
							<span class="input-group-btn">
								<button data-increment=1 data-min=0 data-name="my_attrib_zKoQ1" onclick="decrement(this)" class="btn btn-default glyphicon glyphicon-minus" type="button"></button>
							</span>
							
							<input type="number" readonly="readonly" name="my_attrib_zKoQ1" id="my_attrib_zKoQ1" class="form-control text-center" value=0>
							
							<span class="input-group-btn">
								<button data-increment=1 data-max=5 data-name="my_attrib_zKoQ1" onclick="increment(this)" class="btn btn-default glyphicon glyphicon-plus" type="button"></button>
							</span>
						</div><!-- /input-group -->
						
				<div class="form-group" >
					<div class="w3-bar" style="text-align:left;"><label>When do you need it?</label></div>
						<div class="w3-row">
							
							<div class="w3-half">
								<div class="input-group input-group-lg" >
									<span class="input-group-addon glyphicon glyphicon-calendar" id="basic-addon1"></span>
									<input name="date_my_attrib_ixMzi"id="date_my_attrib_ixMzi" data-name="my_attrib_ixMzi" type="date" onchange=datetime(this) class="form-control"></input>
								</div>
							</div>
								
							<div class="w3-half">
								<div class="input-group input-group-lg" >
									<span class="input-group-addon glyphicon glyphicon-time" id="basic-addon1"></span>
									<input name="time_my_attrib_ixMzi" id="time_my_attrib_ixMzi" data-name="my_attrib_ixMzi" type="time" onchange=datetime(this) class="form-control"></input>
								</div>
							</div>
								
						</div>
					</div>
				</div>
				<div class="form-group" >
					<div class="w3-bar" style="text-align:left;"><label>Google Calendar</label></div>
						<div class="w3-row">
							
							<div class="w3-half">
							
								<div class="input-group input-group-lg" >
									<span class="input-group-addon glyphicon glyphicon-calendar" id="basic-addon1"></span>
									<select data-type="option" onchange="conditional(this)" name="google_date" id="google_date" class="form-control">
										<option></option>
										<option data-subs="15:30,16:00,16:30,17:30" value="Wed Feb 28 2018">Wed Feb 28 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Thu Mar 01 2018">Thu Mar 01 2018</option><option data-subs="10:00,10:30,11:00,11:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Fri Mar 02 2018">Fri Mar 02 2018</option><option data-subs="09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Mon Mar 05 2018">Mon Mar 05 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Tue Mar 06 2018">Tue Mar 06 2018</option><option data-subs="09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Wed Mar 07 2018">Wed Mar 07 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Thu Mar 08 2018">Thu Mar 08 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Fri Mar 09 2018">Fri Mar 09 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Mon Mar 12 2018">Mon Mar 12 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Tue Mar 13 2018">Tue Mar 13 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Wed Mar 14 2018">Wed Mar 14 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Thu Mar 15 2018">Thu Mar 15 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Fri Mar 16 2018">Fri Mar 16 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Mon Mar 19 2018">Mon Mar 19 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Tue Mar 20 2018">Tue Mar 20 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Wed Mar 21 2018">Wed Mar 21 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Thu Mar 22 2018">Thu Mar 22 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Fri Mar 23 2018">Fri Mar 23 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Mon Mar 26 2018">Mon Mar 26 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,17:30" value="Tue Mar 27 2018">Tue Mar 27 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Wed Mar 28 2018">Wed Mar 28 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Thu Mar 29 2018">Thu Mar 29 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Fri Mar 30 2018">Fri Mar 30 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Mon Apr 02 2018">Mon Apr 02 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Tue Apr 03 2018">Tue Apr 03 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Wed Apr 04 2018">Wed Apr 04 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Thu Apr 05 2018">Thu Apr 05 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Fri Apr 06 2018">Fri Apr 06 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Mon Apr 09 2018">Mon Apr 09 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Tue Apr 10 2018">Tue Apr 10 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30" value="Wed Apr 11 2018">Wed Apr 11 2018</option><option data-subs="09:00,09:30,10:00,10:30,11:00,11:30" value="Thu Apr 12 2018">Thu Apr 12 2018</option></select>
									</div>
								
								</div>
										
							<div class="w3-half">
								<div class="input-group input-group-lg" >
									<span class="input-group-addon glyphicon glyphicon-time" id="basic-addon1"></span>
									<select  name="opt_google_date" id="opt_google_date" class="form-control">
									</select>
								</div>
								
							</div>
							
							<div class="input-group input-group-lg">
								<span class="input-group-addon" id="sizing-addon1">@</span>
								<input name="email_google_date" id="email_google_date" placeholder="E-mail" type="email" class="form-control"></input>
							</div>
								
						</div>
					</div>
					
					<input type="hidden" name="calendarId" value="42tg2hu56goa1oc9024qvsdvps@group.calendar.google.com"/>
				
				</div>		
		<!-- PREDEFINED VALUES -->
		
			<input type="hidden" name="webview_id" value="8414"/>
			<input type="hidden" name="user_id" value="1695262973863543"/>
			<input type="hidden" name="username" value="Alejandro,Moya"/>
			<input type="hidden" name="appointment_duration" value="30"/>
			<input type="hidden" name="preview" value=""/>
										
		</br>
		</br>
		</br>
		
		<div class="footer">
							<button class="btn btn-primary btn-block btn-lg" type="submit" name="btnSub">
								<span class="glyphicon glyphicon-send"></span>
							</button> 
						</div>		
		</form>
		


	</body>
</html>