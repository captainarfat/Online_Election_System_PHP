<!-- // This page is for inserting candidate data into db -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>OES INDIA</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body class="container-fluid" onload="resetSelection()">
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<!--  Dropdown code -->
<script type="text/javascript">
var citiesByState = {
Maharashtra: ["01-Nandurbar","02-Dhule","03-Jalgaon","04-Raver","05-Buldhana","06-Akola","07-Amravati","08-Wardha","09-Ramtek","10-Nagpur","11-Bhandara-Gondiya","12-Gadchiroli-Chimur","13-Chandrapur","14-Yavatmal-Washim","15-Hingoli","16-Nanded","17-Parbhani","18-Jalna","19-Aurangabad","20-Dindori","21-Nashik","22-Palghar","23-Bhiwandi","24-Kalyan","25-Thane","26-Mumbai North","27-Mumbai North West","28-Mumbai North East","29-Mumbai North Central","30-Mumbai South Central","31-Mumbai South","32-Raigad","33-Maval","34-Pune","35-Baramati","36-Shirur","37-Ahmednagar","38-Shirdi","39-Beed","40-Osmanabad","41-Latur","42-Solapur","43-Madha","44-Sangli","45-Satara","46-Ratnagiri Sindhudurg","47-Kolhapur","48-Hatkanangle"],
Gujarat: ["01-Kachh","02-Banaskantha","03-Patan","04-Mahesana","05-Sabarkantha","06-Gandhinagar","07-Ahmedabad East","08-Ahmedabad West","09-Surendranagar","10-Rajkot","11-Porbandar","12-Jamnagar","13-Junagadh","14-Amreli","15-Bhavnagar","16-Anand","17-Kheda","18-Panchmahal","19-Dahod","20-Vadodara","21-Chhota Udaipur","22-Bharuch","23-Bardoli","24-Surat","25-Navsari","26-Valsad"],
Delhi: ["01-Chandni Chowk","02-North East Delhi", "03-East Delhi", "04-New Delhi", "05-North West Delhi", "06-West Delhi", "07-South Delhi"]


}

function makeSubmenu(value) {
if(value.length==0) document.getElementById("const").innerHTML = "<option></option>";
else {
var citiesOptions = "";
for(cityId in citiesByState[value]) {
citiesOptions+="<option>"+citiesByState[value][cityId]+"</option>";
}
document.getElementById("const").innerHTML = citiesOptions;
}
}
function displaySelected() { var country = document.getElementById("state").value;
var city = document.getElementById("const").value;
alert(country+"\n"+city);
}
function resetSelection() {
document.getElementById("state").selectedIndex = 0;
document.getElementById("const").selectedIndex = 0;
}
</script>



<?php
if( isset($_POST['submit'])) {
include('conn.php');
session_start();

$cname = $_POST['fullname'];
$age = $_POST['age'];
$cparty = $_POST['party'];
$cstate = $_POST['State'];
$cconst = $_POST['const'];
$cpic = $_FILES['profilephoto']['name'];
$tmp_name = $_FILES['profilephoto']['tmp_name'];
$folder = 'candidates/';
move_uploaded_file($tmp_name, $folder.$cpic);

$partysymbol = $_FILES['partysymbol']['name'];
$tmp_name = $_FILES['partysymbol']['tmp_name'];
$folder = 'parties/';
move_uploaded_file($tmp_name, $folder.$partysymbol);
$cgender = $_POST['gender'];



$query = " INSERT INTO candidates (cname, age, party, states, const, photo, partysymbol, gender) VALUES ('$cname', '$age', '$cparty', '$cstate', '$cconst', '$cpic', '$partysymbol', '$cgender')";
$sql = mysqli_query($conn,$query);

}

?>

    <div class="text-center textBG">
        <h1>Online Election System</h1>
        <p>The Most Secure System For Voting In INDIA</p>
    </div>
    
    <div class="container login-container">
        <div class="row">
            
            <div class="col-md-12 login-form-2">
                <h3>Candidate Personal Information</h3>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fullName" class="col-sm-12 control-label">Full Name</label>
                        <input name="fullname" type="text" class="form-control" value="" />
                    </div>
                    <div class="form-group">
                        <label for="birthyear" class="col-sm-12 control-label">Age</label>
                        <input name="age" type="number" min="25" max="80" id="birthyear" class="form-control">
                        
                    </div>
                    <div class="form-group">
                            <label for="party" class="col-sm-12 control-label">Select Party</label>
                            
                                <select name="party" id="party" class="form-control">
                                    <option>Select Party</option>
                                    <option>Bharatia Janata Party</option>
                                    <option>Indian National Congress Party</option>
                                    <option>Aam Aadmi Party</option>
                                    
                                </select>
                            
                    </div>

                    <div class="form-group">
                            <label for="State" class="col-sm-12 control-label" >Select State</label>
                            
                                <select name="State" id="state" class="form-control" size="1" onchange="makeSubmenu(this.value)">
                                    <option value="" disabled selected>Select State</option>
                                    <option>Maharashtra</option>
                                    <option>Gujarat</option>
                                    <option>Delhi</option>
                                    
                                </select>
                            
                    </div>

                   <div class="form-group">
                            <label for="const" class="col-sm-12 control-label">Select Constituency</label>
                            
                                <select name="const" id="const" class="form-control" size="1">
                                <option value="" disabled selected>Choose Constituency</option>
                                <option></option>
                                </select>
                                    
                                </select>
                            
                    </div>

                    <div class="form-group">
                            <label for="profilephoto" class="col-sm-12 control-label">Profile Photo</label>
                            <input name="profilephoto" type="file" id="profilephoto" class="form-control" style="padding-bottom: 45px;">
                            
                        </div>

                         <div class="form-group">
                            <label for="partysymbol" class="col-sm-12 control-label">Party Symbol</label>
                            <input name="partysymbol" type="file" id="partysymbol" class="form-control" style="padding-bottom: 45px;">
                            
                        </div>

                        <div class="form-group">
                                <label class="control-label col-sm-12">Gender</label>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="radio-inline">
                                                <input name="gender" type="radio" id="femaleRadio" value="Female"><b>Female</b>
                                            </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="radio-inline">
                                                <input name="gender" type="radio" id="maleRadio" value="Male"><b>Male</b>
                                            </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="radio-inline">
                                                <input name="gender" type="radio" id="uncknownRadio" value="Other"><b>Other</b>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <div class="form-group text-center" style="margin : 60px; padding: 30px; font-size: 40px">
                        <input name="submit" type="submit" class="btnSubmit" value="Submit" />
                    </div>
                    <div class="form-group text-center" style="margin : 60px; padding: 30px; font-size: 40px">
                        <a href="AdminAfterLogin.php"><input name="backbutton" type="button" class="btnSubmit" value="Back" />
                    </div>
                    
                </form>
            </div>
            
        </div>
    </div>

</body>
</html>