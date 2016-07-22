var xmlhttp;
if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
}else{// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}

function request(){
    var query = document.search.query.value;
    soundCloud(query);
    /**
    var service = getRadioValue("service");
    switch(service){
        case "youtube":
            youTube(query);
            break;
        case "soundcloud":
            soundCloud(query);
            break;
    }**/
    return false;
}
function youTube(query)
{
    console.log("youtube query ="+query);
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("response").innerHTML = xmlhttp.responseText;
        }
        else{
        setTimeout( this, 1000);

        }
    }

xmlhttp.open("POST","search.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("query="+query);
}

function soundCloud(query){
     xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("response").innerHTML = xmlhttp.responseText;
        }
        else{
            console.log(xmlhttp.status);
            setTimeout( this, 1000);
        }
    }

xmlhttp.open("POST","/tracks");
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("query="+ query);
}
function getRadioValue(name) {
   //Get all elements with the name
   var buttons = document.getElementsByName(name);
   for(var i = 0; i < buttons.length; i++) {
      //Check if button is checked
      var button = buttons[i];
      if(button.checked) {
         //Return value
         return button.value;
      }
   }
   //No radio button is selected.
   return null;
}
