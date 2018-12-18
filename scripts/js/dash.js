$(document).ready(function(){
    $('.fixed-action-btn').floatingActionButton();
    $('.modal').modal();
    $('.tooltipped').tooltip();
    $('.datepicker').datepicker();
    
    $(".delete-list").click(function(){
       var data = {};
        data['list_id'] = $(this).attr("id");
         $(".row").load("scripts/php/delete_list.php", data);
//        console.log(data['list_id']);
//        console.log(data['type']);
    });
});

var close = document.getElementsByClassName("delete-list");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function() {
    var div = this.parentElement;
    div.style.display = "none";
  }
}

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(elems, {
      direction: 'left',
      hoverEnabled: true
    });
  });

