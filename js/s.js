


$(function(){
    'use strict';
    var  winh=$(window).height(),
        uphieght =$('.upperbar').innerHeight(),
        navh =$('.navbar').innerHeight();
    $('.slider,.carousel-item').height(winh-(uphieght+navh));
    //featured work
    $('.featured-work ul li').on('click',function (){
        $(this).addClass('active').siblings().removeClass('active');
        //console.log($(this).data('class'));
        if($(this).data('class') === 'all') {
            $('.sh .col-md-3').css('opacity',1);
        }else {
            $('.sh .col-md-3').css('opacity','.08');
            $($(this).data('class')).parent().css('opacity',1);

            return;
        }
    });


    $(function(){
        $("#registor").ajaxForm({
            beforeSend:function(){
                $("#regist").html("<img src='../../img/load.gif'width='100px'/>");
            },success:function(data){
                $("#regist").html(data);
            }
        });

    });
    $(function(){
        $("#mod").ajaxForm({
            beforeSend:function(){
                $("#modify").html("<img src='../img/load.gif'width='100px'/>");
            },success:function(data){
                $("#modify").html(data);
            }
        });

    });


    $(function(){
        $("#log").ajaxForm({
            beforeSend:function(){
                $("#log_r").html("<img src='img/load.gif'width='30px'/>");
            },success:function(data){
                $("#log_r").html(data);
            }
        });

    });
    $(function(){
        $("#cats").ajaxForm({
            beforeSend:function(){
                $("#cat").html("<img src='../img/load.gif'width='30px'/>");
            },success:function(data){
                $("#cat").html(data);
            }
        });

    });



});


