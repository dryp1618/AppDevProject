import DataTable from "datatables.net-dt";
import "datatables.net-responsive-dt";

let table = new DataTable("#myTable", {
  responsive: true,
  paging: true,
  searching: true,
  ordering: true,
  pageLength: 10,
  lengthMen: [[0, "asc"]],
});

function addUserFunc() {
  var firstName = document.getElementById("txtFirstname").value;
  var lastName = document.getElementById("txtLastname").value;

  $.ajax({
    url: "../controllers/userController.php",
    type: "POST",
    data: {
      fName: firstName,
      lName: lastName,
    },
    success: (returnData) => {

    },
    error: (xhr) => {
      alert(xhr.status + " : " + xhr.responseText);
    },
  });
}

function updatedUserFunc() {}

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
