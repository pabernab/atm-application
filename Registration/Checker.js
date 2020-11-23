function submission()
{
  let firstname = document.forms["myForm"]["userFirstName"].value;
  let lastname = document.forms["myForm"]["userLastName"].value;
  let email = document.forms["myForm"]["userEmailAddress"].value;
  let username = document.forms["myForm"]["userName"].value;
  let pass1 = document.forms["myForm"]["userPassword"].value;
  let pass2 = document.forms["myForm"]["repassword"].value;

  if (firstname === "" || lastname === "" || email === ""  || username === "" || pass1 === "" || pass2 === "" )
  {
    alert("please fill entry");
     return false;
  }

  if(!email.includes("@") && (!email.includes(".com") ||  !email.includes(".net")))
  {
    alert("Invalid email");
    return false;
  }

  //Checks password dont match or not
  if(pass1 !== pass2)
  {
    alert("The passwords don't match each other.");
    return false;
  }

  //Checks if email is valid


  // if (firstname === "test" || lastname === "test" || email === "test"  || username === "test" || pass1 === "test" || pass2 === "test" )
  //   {
  //     alert("hit");
  //     document.forms["myForm"]["input"].value = "test";
  //      return false;
  //   }
  // else
  //   {
  //     alert("Nope");
  //     document.forms["myForm"]["input"].value = "userInput";
  //      return true;
  //   }


  //Refresh page
    return true;
}
