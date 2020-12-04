function submission()
{
  //Gets order Number
  let order = document.forms["order"]["number"].value;


  var img = document.createElement("img");
  //location of image
  img.src = "../Deposit_Withdraw/images/"+ order +".png";

  if(!imageExists(img.src))//If URL image does not exist.
  {
    document.getElementById("myImage").innerHTML = "Order Number does not Exist or incorrect Order Number";

    return false;
  }

  var src = document.getElementById("myImage");
  //posts image
  if (src.hasChildNodes())//Checks if image exist already
  {
    src.removeChild(src.childNodes[0]);
  }
  src.appendChild(img);

  return false;
}
//Checks URL if image exist
function imageExists(image_url)
{

    var http = new XMLHttpRequest();

    http.open('HEAD', image_url, false);
    http.send();

    return http.status != 404;

}
