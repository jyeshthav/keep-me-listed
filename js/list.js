$(document).ready(function(){
    $('.datepicker').datepicker();
});

var close = document.getElementsByClassName("clear-task");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function() {
    var div = this.parentElement;
    div.style.display = "none";
  }
}

var list = document.getElementsByClassName("collection-item");
var i;
for (i = 0; i < list.length; i++){
    list[i].onclick = function(){
        this.classList.toggle("checked");
        console.log(i);
    }
};

