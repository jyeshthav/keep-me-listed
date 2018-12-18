$(document).ready(function(){
    $('.datepicker').datepicker();
   
    $(".sorting").change(function() {
    var data = {};
    data['sortby'] = $(this).attr("id");
    data['list_id'] = $(this).attr("name");
    data['uid'] = $(this).attr("uid");
    $(".all-tasks").load("scripts/php/sort.php", data);
    }); 
    
    $(".clear-task").click(function(){
       var data = {};
        data['task_id'] = $(this).attr("id");
         $(".all-tasks").load("scripts/php/delete.php", data);
    });
    
    $(".status").click(function(){
        var data = {};
        data['name'] = $(this).attr("name");
        data['task_id'] = $(this).attr("id");
        data['uid'] = $(this).attr("uid");
        data['status'] = $(this).attr("data-status");
//        ---for attribute---
        if(data['status'] == 'checked'){
            $(this).attr("data-status", 'unchecked');
            location.reload();
        }
        else{
            $(this).attr("data-status", 'checked');
            location.reload();
        }
//        ---for database---
        $.post("scripts/php/check.php", data, function(result){
                result = JSON.parse(result);
                console.log("1->"+result);
        });
//        console.log(data['status']);
//        console.log(data['name']);
//        console.log(data['uid']);
//        console.log($(this).attr("data-status"));
    });
    
    function status() {
    var stat = $(".status");
//        ---for adding class based on attribute---
    stat.each(function () {
      if ($(this).attr('data-status') == 'checked') {
          $(this).children("span").removeClass("unchecked").addClass("checked");
      }
      else{
          $(this).children("span").removeClass("checked").addClass("unchecked");
      }
    });
  }
  status();
});


                 

var close = document.getElementsByClassName("clear-task");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function() {
    var div = this.parentElement;
    div.style.display = "none";
  }
}

//var list = document.getElementsByClassName("collection-item");
//var i;
//for (i = 0; i < list.length; i++){
//    list[i].onclick = function(){
//        this.classList.toggle("checked");
//    }
//};



