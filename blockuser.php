<!DOCTYPE html>
<html>
<head>
	<title>Block User</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>
<body>
	<form method="POST">
		<table border="1">
			 <tr>
				<td>Select staff</td>
				<td>
					<select id="ddlstaffcode" name="ddlstaffcode" tabindex="1" autofocus="true">


						<!--fetch-->
					</select>
				</td>
			</tr>
			
			 
			<tr>
				<td><input type="button" name="btnblock" id="btnblock" value="Block" tabindex="2" /></td>
			</tr>
		</table>
	</form>
	<div id="div1">
	</div>

	<script>
		$(document).ready(function(){
			//fetch staff info from database
			var array_staffcode=[];
			var array_name=[];
			var selected_staffcode="";
			var name="";
			
			
			load_staff();
	
		//fetch staffcode, name from staff table
		function load_staff(){
		
			array_staffcode.length=0;
			array_name.length=0;
			 
			document.getElementById("ddlstaffcode").length=0;


			  $.ajax({
			     
			      url: 'dal_fetch_uniquestaff.php',
			      datatype: 'json',
			      success: function(data)          //on recieve of reply
      				{
      					try{
      						alert(data);
      					result=JSON.parse(data);
      				}
      				catch(err){
      					alert(err.message);}
      					var ddlstaffcode=document.getElementById("ddlstaffcode");
      					var staffcode="", name="";

      					var opt=document.createElement("option");
      					opt.value="select";
      					opt.text="select";
      					ddlstaffcode.appendChild(opt);

      					for(var i=0;i<result.length; i++)
      					{
      						staffcode=result[i].staffcode;
      						name=result[i].name;
      						

      						//store in arrays
      						array_staffcode.push(staffcode);
      						array_name.push(name);
      						

      						var opt=document.createElement("option");
      						opt.text=name;
      						opt.value=staffcode;
      						ddlstaffcode.appendChild(opt);
      					} 
      					 
      				}});
			}

			   /*
			 $("#btnblock").click(function(){
			 	
		 	
				var staffcode=document.getElementById("ddlstaffcode").value;

			      $.ajax({
			      type: "POST",
			      url: 'dal_blockuser.php',
			    data: ({
			      	param_staffcode:staffcode
			      }), 
			      success: function(data) {
			       document.getElementById("div1").innerHTML=data;

			       //clear all controls
			       document.getElementById("txtusername").value="";
			       document.getElementById("txtpassword").value="";
			       document.getElementById("txtusertype").value="";
			       document.getElementById("ddlstaffcode").focus();
			       
			       load_staff();


			      } 
			    });   
			    });*/    
		});
	</script>
</body>
</html>