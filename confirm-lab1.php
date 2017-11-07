<?
#Transferring all values from one page to the other.
#Need to find a cleaner and easier way.
#  $dog_toy=$_POST["dog_toy"]; This can be done but you are wasting memory.

  $quan1=$_POST["dog_toy"];
  $quan2=$_POST["cat_toy"];
  $quan3=$_POST["adult_blue"];
  $quan4=$_POST["kitt_nutro"];
  $quan5=$_POST["pup_form"];
  $quan6=$_POST["dog_euk"];
  $quan7=$_POST["dog_ces"];
  $quan8=$_POST["cat_fan"];
  $answer=$_POST["find"];
  $address=$_POST["Address"];
  $state=$_POST["state"];
#FIND printed out value of customer status
  $totalprice=0;
  $tax=0.0875;
  $return_cust=0;
  $shipping=10;
  $extratoy=0;

?>
<html>
<head>

  <title>Mr. Pete's Submit - Order Results</title>

</head>
<body>
<BODY BGCOLOR="#a4c0f4">

<h1>Mr. Pete's Pet Shop - Confirmation Page</h1>
<h2>Order Results</h2>
<h3>Receipt</h3>

<?
  date_default_timezone_set('UTC');
  $item=array("KONG Plush Rosie the Rhino Squeaker Dog Toy","KONG Squirrel Cat Nip Toy",
  "Blue Buffalo Wilderness Indoor Adult Cat Food","Nutro Max Kitten Food","Blue Buffalo, Blue Life Protection Formula Puppy Food",
  "Eukanuba Adult Maintenance Dog Food","Cesar Savory Delights Adult Dog Food","Fancy Feast Classic Adult Cat Food");
  $price=array(7.50,7.50,33.99,24.50,45.99,33.99,0.75,0.59);
#lab2 added this array
#  $quantity=array($_POST["dog_toy"],$_POST["cat_toy"],$_POST["adult_blue"],$_POST["kitt_nutro"],$_POST["pup_form"],$_POST["dog_euk"],$_POST["dog_ces"],$_POST["cat_fan"]);

	echo"<p>Order processed at ". date('l jS \of F Y h:i:s A')."</p>";
  echo "<p>Your orders as followed:<br></p>";
  echo $street;
  if ($_POST["dog_ces"]>=5&&$_POST["dog_ces"]<=10){
    $price[6]=0.72;
  }
  elseif ($_POST["dog_ces"]>=11&&$_POST["dog_ces"]<=15) {
    $price[6]=0.71;
  }
  elseif ($_POST["dog_ces"]>16) {
    $price[6]=0.70;
  }


  if ($_POST["cat_fan"]>=5&&$_POST["cat_fan"]<=10){
      $price[7]=0.56;
    }
    elseif ($_POST["cat_fan"]>=11&&$_POST["cat_fan"]<=15) {
      $price[7]=0.55;
    }
    elseif ($_POST["cat_fan"]>=16) {
      $price[7]=0.54;
    }

if($_POST["adult_blue"]>0&&$_POST["pup_form"]>0||$_POST["kitt_nutro"]>0&&$_POST["dog_euk"]>0){
  $extratoy++;
  $combo = $_POST["dog_toy"] + $extratoy;
}


if ($_POST["dog_toy"]>0) {
  echo $item[0]."     ".$combo."---------$".$price[0]*$_POST["dog_toy"]."<br>";
  $totalprice+=$price[0]*$_POST["dog_toy"];
}

if ($_POST["cat_toy"]>0) {
  echo $item[1]."     ".$_POST["cat_toy"]."---------$".$price[1]*$_POST["cat_toy"]."<br>";
  $totalprice+=$price[1]*$_POST["cat_toy"];
}
if ($_POST["adult_blue"]>0) {
  echo $item[2]."     ".$_POST["adult_blue"]."---------$".$price[2]*$_POST["adult_blue"]."<br>";
  $totalprice+=$price[2]*$_POST["adult_blue"];
}
if ($_POST["kitt_nutro"]>0) {
  echo $item[3]."     ".$_POST["kitt_nutro"]."---------$".$price[3]*$_POST["kitt_nutro"]."<br>";
  $totalprice+=$price[3]*$_POST["kitt_nutro"];
}

if ($_POST["pup_form"]>0) {
  echo $item[4]."     ".$_POST["pup_form"]."---------$".$price[4]*$_POST["pup_form"]."<br>";
  $totalprice+=$price[4]*$_POST["pup_form"];
}

if ($_POST["dog_euk"]>0) {
  echo $item[5]."     ".$_POST["dog_euk"]."---------$".$price[5]*$_POST["dog_euk"]."<br>";
  $totalprice+=$price[5]*$_POST["dog_euk"];
}
if ($_POST["dog_ces"]>0) {
  echo $item[6]."     ".$_POST["dog_ces"]."---------$".$price[6]*$_POST["dog_ces"]."<br>";
  $totalprice+=$price[6]*$_POST["dog_ces"];
}
if ($_POST["cat_fan"]>0) {
  echo $item[7]."     ".$_POST["cat_fan"]."---------$".$price[7]*$_POST["cat_fan"]."<br>";
  $totalprice+=$price[7]*$_POST["cat_fan"];
}
if($answer==b){
  $return_cust=.05;
}
elseif($answer==c){
  $return_cust=.07;
}
else{
  $return_cust=null;
}
if($totalprice>=50){
  $shipping=0;
}

echo "Your total is: $".$totalprice."<br>";
$totalprice += $totalprice * $tax;
echo "Your total with tax is: $".number_format((float)$totalprice, 2, '.', '')."<br>";
$totalprice+=$shipping;
echo "Your total with shipping is: $".number_format((float)$totalprice, 2, '.', '')."<br>";
$totalprice -= ($totalprice*$return_cust);
echo "Your discount has been added and grand total is: $".number_format((float)$totalprice, 2, '.', '')."<br>";

$myfile = fopen("shipping_list.txt", "a")or die("Unable to open file!");
$fileIt=PHP_EOL.date("Y/m/d")."~".$quan1."~".$quan2."~".$quan3."~".$quan4."~".$quan5."~".$quan6."~".$quan7."~".$quan8."~".$totalprice."~".$address."~".$state;
fwrite($myfile,$fileIt);
fclose($myfile);

?>

</body>
</html>
