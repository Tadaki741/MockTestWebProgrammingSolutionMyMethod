var submitButton = document.querySelector("#submitButton");
var selectBox = document.querySelector("#selectInForm");
var formElement = document.querySelector("#submitForm");
var aboutMeElement = document.querySelector("#AboutMeLink");
var fullName = document.querySelector("#fullName");

submitButton.addEventListener("click" , () => {
    //Check the select value
    let selectValueString = String(selectBox.value);
    if(selectValueString === '' ){
        alert ("Please select something");
    }
    else {
        formElement.submit();
    }
});

aboutMeElement.addEventListener("click", () => {
    fullName.innerText = "Username: S3821186";
    setTimeout(changeBackNameAfterThreeSeconds,3000);
})


function changeBackNameAfterThreeSeconds () {
    fullName.innerText = "Username: Vo Dai Duong";
}


