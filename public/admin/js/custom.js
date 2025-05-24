$(document).ready(function(){
//check admin password is correct or not
$("#current_password").keyup(function(){
    var currentPassword = $("#current_password").val();
    //alert(currentPassword);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        type:'post',
        url: '/admin/check-admin-password',
        data:{current_password:currentPassword},
        success: function(response) {
            //alert(response);
            if(response == "false"){
                $('#check_password').html("<font color='red' >Current Password is incorrect!</font>");
            } else if (response == "true"){
                $('#check_password').html("<font color='green' >Current Password is Correct!</font>");

            }
        }, error:function(){
            //alert('Error');
        }
    })
})
});