function createStudentCard() {

    // FRONT
    function front() {

        const canvas = document.getElementById("library_card_front");

        const ctx = canvas.getContext("2d");

        ctx.fillStyle = "rgb(225,225,225)";
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.fillStyle = "#033249";
        ctx.rect(0, 0, 336, 56);
        ctx.fill();

        ctx.fillStyle = "#DFDFDF";

        ctx.font = "20px Helvetica";
        ctx.fillText("Library Card", 10, 25);

        ctx.font = "16px Arial";
        // PHP NEEDED
        ctx.fillText(member_type, 12, 45);

        const logo = new Image();
        logo.src = "./resources/images/cl_logo.jpg";
        logo.onload = function () { ctx.drawImage(logo, 280, 0, 56, 56); };

        ctx.fillStyle = "#033249";
        // PHP NEEDED
        ctx.font = "normal normal bold 20px arial";
        ctx.fillText(fname + " " + lname, 110, 90);

        ctx.font = "normal normal bold 14px arial";
        ctx.fillText("Member No :", 110, 115);
        ctx.fillText(member_id, 225, 115);

        ctx.fillText("Member Since :", 110, 140);
        ctx.fillText(member_since, 225, 140);

        ctx.fillText("Expiry Date :", 110, 165);
        ctx.fillText(expiry_date, 225, 165);

        const avatar = new Image();
        avatar.src = avatar_url;
        avatar.onload = function () { ctx.drawImage(avatar, 10, 65, 90, 105); };

    }
    // FRONT END

    // BACK
    function back() {

        const canvas = document.getElementById("library_card_back");

        const ctx = canvas.getContext("2d");

        ctx.fillStyle = "rgb(225,225,225)";
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.fillStyle = "#033249";
        ctx.rect(0, 0, 336, 56);
        ctx.fill();

        ctx.fillStyle = "#DFDFDF";

        ctx.font = "20px Helvetica";
        ctx.fillText("Library Card", 107, 35);

        ctx.font = "normal normal bold 14px arial";
        ctx.fillStyle = "#033249";
        // PHP NEEDED
        ctx.fillText("Date of Birth :", 20, 100);
        ctx.fillText(dateofbirth, 150, 100);

        ctx.fillText("Email Address :", 20, 130);
        ctx.fillText(emailaddress, 150, 130);

        ctx.fillText("Contact Number :", 20, 160);
        ctx.fillText(contactnumber, 150, 160);

    }
    // BACK END

    // CREATE
    front();
    back();



}

const downloadCardButton = document.getElementById("downloadCardButton");
downloadCardButton.addEventListener("click", function () {

    const canvas_front = document.getElementById("library_card_front");
    const a_front = document.createElement("a");
    document.body.appendChild(a_front);
    a_front.href = canvas_front.toDataURL();
    a_front.download = "Card_front.png";
    a_front.click();
    document.body.removeChild(a_front);

    const canvas_back = document.getElementById("library_card_back");
    const a_back = document.createElement("a");
    document.body.appendChild(a_back);
    a_back.href = canvas_back.toDataURL();
    a_back.download = "Card_back.png";
    a_back.click();
    document.body.removeChild(a_back);

});

createStudentCard();