function addUserFunc() {
  var firstName = document.getElementById("txtFirstname").value;
  var lastName = document.getElementById("txtLastname").value;
  var userID = document.getElementById("txtUserID").value;
  var roleID = document.getElementById("roleSelect").value;

  $.ajax({
    url: "../controllers/userController.php",
    type: "POST",
    data: {
      fName: firstName,
      lName: lastName,
      userID: userID,
      roleID: roleID,
    },
    success: (returnData) => {
      console.log("Data sent to make a user.");
    },
    error: (xhr) => {
      alert(xhr.status + " : " + xhr.responseText);
    },
  });
}

function updateUserFunc() {}

function deleteUserFunc() {}

function redirectFunc(redirectID) {
  switch (redirectID) {
    case 1: //registration
      window.location.href = "../views/homePage.php";
      break;
    default:
      console.error("No valid redirects!");
      break;
  }
  exit;
}
