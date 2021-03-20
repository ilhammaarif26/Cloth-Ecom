$(document).ready(function(){
    // check admin pass correct or nor
    $('#current_pwd').keyup(function(){
        var current_pwd = $('#current_pwd').val();
        // alert(current_pwd);
        $.ajax({
            type: 'post',
            url: '/admin/check-current-pwd',
            data: {current_pwd:current_pwd},
            success:function(resp){
                if(resp == "false"){
                    $('#checkCurrentPwd').html('<font color=red> Current password incorrect </font>');
                } else if(resp == "true") {
                    $('#checkCurrentPwd').html('<font color=green> Current password correct </font>');
                }
            },error:function(){
                alert('Error');
            }
        });
    });
});