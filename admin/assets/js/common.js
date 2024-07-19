function fadeOut(){
   $(".alert").alert('close')
}


$(document).on("click",'#login_btn',function(){
    var user_id= $(".user_id").val();
    var password= $(".password").val();
    $.ajax({
      type: "POST",
      url: "http://localhost/buddy/index.php/home/login",
      data: {"userId":user_id, "password": password},
      success: function(data){
        if(data != 'success'){
            $("#error-msg").addClass("show");
            $("#error-msg").html(data);
            setTimeout(fadeOut, 2000);
        }
      }
    }); 
})


$(document).on("click",'#create_account',function(){
    var user_id= $(".user_id").val();
    var password= $(".password").val();
    alert();
    $.ajax({
      type: "POST",
      url: "http://localhost/buddy/index.php/home/login",
      data: {"userId":user_id, "password": password},
      success: function(data){
         console.log(data);
      }
    }); 
})