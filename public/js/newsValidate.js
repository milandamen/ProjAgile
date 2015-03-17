$("#cancel").click(function(){
    document.getElementById("upload").value = "";
});

function validate() {
    if (document.getElementById("title").value == "") {
        alert("Vul a.u.b. een titel in.");
        return false;
    }
    if(document.getElementById("content").value == "")
    {
        alert("Vul a.u.b. een content in.");
        return false;
    }
}
