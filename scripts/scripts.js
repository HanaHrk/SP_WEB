const labels = document.getElementsByClassName("show_rev");
const tables = document.getElementsByClassName("rev_table");

for(let i = 0; i < labels.length; i++) {
    labels[i].onmouseover = function(){
        tables[i].style.display = "flex";
    };
    labels[i].onmouseout = function(){
        tables[i].style.display = "none";
    };
}
