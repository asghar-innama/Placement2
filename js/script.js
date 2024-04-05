function addNewWEfield() {
    
    // console.log("Adding new field");

    let newNode = document.createElement("textarea");
    newNode.classList.add("form-control");
    newNode.classList.add("weField");
    newNode.classList.add("mt-3");
    newNode.setAttribute("rows", 3);
    newNode.setAttribute("placeholder", "Enter here");

    let weOb = document.getElementById("we");
    let weaddButtonOb = document.getElementById("weaddButton");

    weOb.insertBefore(newNode, weaddButtonOb);
}

function addNewEQfield() {
    // console.log("Adding new field");

    let newNode = document.createElement("textarea");
    newNode.classList.add("form-control");
    newNode.classList.add("eqfield");
    newNode.classList.add("mt-3");
    newNode.setAttribute("rows", 3);
    newNode.setAttribute("placeholder", "Enter here");

    let Eq = document.getElementById("eq");
    let eqaddButtonOb = document.getElementById("eqaddButton");

    Eq.insertBefore(newNode, eqaddButtonOb);
}

function addNewSfield() {


    let newNode = document.createElement("textarea");
    newNode.classList.add("form-control");
    newNode.classList.add("sField");
    newNode.classList.add("mt-3");
    newNode.setAttribute("rows", 3);
    newNode.setAttribute("placeholder", "Enter here");

    let Eq = document.getElementById("sF");
    let saddButtonOb = document.getElementById("sAddButton");

    Eq.insertBefore(newNode, saddButtonOb);
}

// generating cv
document.getElementById("generateCVBtn").addEventListener("click", generateCV);

function generatePDF() {
    const pdf = new jsPDF();

    // Capture the CV template div as an image using html2canvas
    html2canvas(document.getElementById('cv-template')).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        pdf.addImage(imgData, 'PNG', 0, 0, pdf.internal.pageSize.getWidth(), pdf.internal.pageSize.getHeight());
        pdf.save('resume.pdf'); // Save the PDF file
    });
}

function generateCV() {
    let nameField = document.getElementById("nameField").value;
    let contactField = document.getElementById("contactField").value;
    let addressField = document.getElementById("addressField").value;
    let emailField = document.getElementById("emailField").value;
    let fbField = document.getElementById("fbField").value;
    let instaField = document.getElementById("instaField").value;
    let linkedField = document.getElementById("linkedField").value;
    let objectiveField = document.getElementById("objectiveField").value;

    // Setting Name
    document.getElementById("nameT1").innerHTML = nameField;
    document.getElementById("nameT2").innerHTML = nameField;

    // Contact
    document.getElementById("contactT").innerHTML = contactField;

    // Address
    document.getElementById("addressT").innerHTML = addressField;

    // Links
    document.getElementById("emailT").innerHTML = emailField;
    document.getElementById("fbT").innerHTML = fbField;
    document.getElementById("instaT").innerHTML = instaField;
    document.getElementById("linkedT").innerHTML = linkedField;

    // Objective
    document.getElementById("objectiveT").innerHTML = objectiveField;

    // Skills
    let skills = document.getElementsByClassName("sField");
    let strSkills = "";
    for (let skill of skills) {
        strSkills += `<li>${skill.value}</li>`;
    }
    document.getElementById("sT").innerHTML = strSkills;

    // Work Experience
    let wes = document.getElementsByClassName("weField");
    let strWE = "";
    for (let we of wes) {
        strWE += `<li>${we.value}</li>`;
    }
    document.getElementById("weT").innerHTML = strWE;

    // Education Qualifications
    let eqs = document.getElementsByClassName("eqField");
    let strEQ = "";
    for (let eq of eqs) {
        strEQ += `<li>${eq.value}</li>`;
    }
    document.getElementById("eqT").innerHTML = strEQ;

    // Image
    let file = document.getElementById("imageField").files[0];
    let reader = new FileReader();
    if (file) {
        reader.readAsDataURL(file);
    }
    reader.onloadend = function () {
        document.getElementById("imgT").src = reader.result;
    };

    // Show CV template, hide form
    document.getElementById("cv-form").style.display = "none";
    document.getElementById("cv-template").style.display = "block";
}

function previewFile() {
    const preview = document.querySelector('img');
    const file = document.querySelector('input[type=file]').files[0];
    const reader = new FileReader();

    reader.addEventListener("load", function () {
        preview.src = reader.result;
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}

function printCV() {
    window.print();
}

   