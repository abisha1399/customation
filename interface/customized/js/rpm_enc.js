if(rpm_encounter_true=='true'){
    $.ajax
       ({
           type        : 'POST',
           url:'../../customized/rpm_encounter.php?rpm_bill_generate=true',          
           data        : {
            pid:pid,
            encounter:encounter
           },
           
        success: function(response) 
        {
            console.log(response);
        }
    });
}
$('#summernote').summernote({
    placeholder: 'Type your Notes here!',
    tabsize: 1,
    height: 155
  });
$('#summernote1').summernote({
    placeholder: 'Type your Notes here!',
    tabsize: 1,
    height: 100
  });
$(document).on("click",".tabSpan ",function() {
    $('#pid').val('');
    $("#rpm_form").hide();    
});
$("#rpm_form").on("mousemove",()=>{
    this.addEventListener("keyup", function(event) {
        if(event.key=='F2'){
        $("#rpm_form").css({
            "width":"100%",
            "height":"100%"
        });
    }
    if(event.key=='Tab'){
        $("#rpm_form").css({
            "width":"650px"
        });
    }
    },
    );

   });   
   $("#rpm_form1").on("mousemove",()=>{
    this.addEventListener("keyup", function(event) {
        if(event.key=='F2'){
            $("#rpm_form1").css({
                "width":"100%",
                "height":"100%"
            });
        }
        if(event.key=='Tab')
        {
            $("#rpm_form1").css({
                "width":"650px"
            });
        }
    },
    );
}); 

$(".note-icon-video").on("click",()=>{
    setInterval(() => {
        console.log();
        $(".modal-backdrop").css("display","none");
    }, 100);

});

$(".note-icon-picture").on("click",()=>{
    setInterval(() => {
    console.log();
    $(".modal-backdrop").css("display","none");
    }, 100);

});
function delete_enc(id)
{

    $('#authmodel').modal('show');
    $("#delete_id").val(id);        
}
function disconnect(){
    $('#authmodel').modal('hide');
    var id=$("#delete_id").val();
    $.ajax({
        type: 'POST',
        url:'./forms.php?delete_enc',
        data:{
            id:id
        },
        success: function(data) {
            $("#rpmencounter_row_"+id).hide();
        }    
    });

}
$('#rpm_close').click(function(){
    $(".time,.activity,.encounter_type").removeClass('btn-secondary');
    $('.note-editable').html('');
    $('.note-editable').attr("placeholder", "Type your Notes here!");
    $('#form_id').val('');
    $('#pid').val('');
    $("#rpm_form").css('display','none');
    $("#rpm_form1").css('display','none');
})
$('.encounter_type').click(function(){
    var time = $(this).attr('id');
    var value=$(this).val();
    $(".encounter_type").removeClass('btn-secondary');
    $("#"+time).addClass('btn-secondary');
    $("#encounter_type").val(value);
})
$('.activity').click(function(){
    var time = $(this).attr('id');
    var value= $(this).val();
    $(".activity").removeClass('btn-secondary');
    $("#"+time).addClass('btn-secondary');
    $("#activity").val(value);
})
$('.time').click(function(){
    var time = $(this).attr('id');
    var time_val=$(this).val();
    $("#maxmin").val('');
    $(".time").removeClass('btn-secondary');
    $("#"+time).addClass('btn-secondary');            
    $("#timespent").val(time_val);

})

$('#maxmin').keyup(function(){
    var min = $("#maxmin").val();
    
    if(min!=''){
        $(".time").removeClass('btn-secondary');
    }
    
    $("#timespent").val(min);

})
function clear_field(type){
    $(".time,.activity,.encounter_type").removeClass('btn-secondary');
    $('.note-editable').html('');
    $('.note-editable').attr("placeholder", "Type your Notes here!");
    if(type=='1'){
        $('#pid').val('');
    }
    
}

$('#confirm').click(function(){
   // alert('confirm');
   var encounter_type = $('#encounter_type').val();
   var performed_by = $('#performed_by').val();
   var activity = $('#activity').val();
   var note = $('.note-editable').html();
   var timespent = $('#timespent').val();
   var id=$("#rpm_enc_id").val();
   var pid=$("#pid").val();
   
   if(encounter_type!=='' && activity!=''){
    $("#pid").val('');
    $.ajax({
        type: 'POST',
        url:'../../customized/rpm_encounter.php?rpm_encounter',
        data:{
            rpm:'true',
            pid:pid,
            encounter_type:encounter_type,
            performed_by:performed_by,
            activity:activity,
            note:note,
            timespent:timespent
        },
        success: function(data) {
            //alert(data);
            $(".time,.activity,.encounter_type").removeClass('btn-secondary');
            $('.note-editable').html('');
            $('.note-editable').attr("placeholder", "Type your Notes here!");
            $('#form_id').val('');
            $("#rpm_form").css('display','none');
            
        }
    })
   }else{
    alert("All field requied");
    return false;
   }
   //alert(id);
    
})
//var action=0;
function loadlink()
{
    
    var global1 = window.sessionStorage.getItem("altsession");
    var pid_data = window.sessionStorage.getItem("pid");

    
    if(global1 == 'yes')
    {
        $("#pid").val(pid_data);
        $("#click_new").trigger('click');
        sessionStorage.removeItem("altsession");
        sessionStorage.removeItem("pid");
        
    }
}

function edit_enc(id){
    $("#rpm_enc_id").val(id);        
    $.ajax({
            type: 'POST',
            url:'../../customized/rpm_encounter.php?get_rpmenc',
            data:{
                id:id
            },
            success: function(data)
            {
                $('.encounter_type').removeClass('btn-secondary');
                $('.activity').removeClass('btn-secondary');
                $('.time').removeClass('btn-secondary');
                $('#maxmin').removeClass('btn-secondary');
                $('.note-editable').html('');
                var result=$.parseJSON(data);                    
                var select=result['select'];
                var rpm_encounter_data=result['rpm_encounter_data'];
                if(rpm_encounter_data.encounter_type=='Phone Call'){
                    $("#Phone_Call").addClass('btn-secondary');
                }
                if(rpm_encounter_data.encounter_type=='Chart View'){
                    $("#Chart_View").addClass('btn-secondary');
                }

                if(rpm_encounter_data.activity=='Review PGHD'){
                    $("#pghd").addClass('btn-secondary');
                }
                if(rpm_encounter_data.activity=='Mediction Refill'){
                    $("#mediction_refill").addClass('btn-secondary');
                }
                if(rpm_encounter_data.activity=='Return Call'){
                    $("#return_call").addClass('btn-secondary');
                }

                if(rpm_encounter_data.timespent=='2'){
                    $("#2min").addClass('btn-secondary');
                }
                if(rpm_encounter_data.timespent=='5'){
                    $("#5min").addClass('btn-secondary');
                   
                }
                if(rpm_encounter_data.timespent=='10'){
                    $("#10min").addClass('btn-secondary');
                }
                if(rpm_encounter_data.timespent=='20'){
                    $("#20min").addClass('btn-secondary');
                }
                if(rpm_encounter_data.timespent!='2'&&rpm_encounter_data.timespent!='5'&&rpm_encounter_data.timespent!='10'&&rpm_encounter_data.timespent!='20')
                {
                    $("#maxmin").css('border-color','#6b7cb6');
                    $("#maxmin").val(rpm_encounter_data.timespent);
                }
                $('#encounter_type').val(rpm_encounter_data.encounter_type);
                $('#activity').val(rpm_encounter_data.activity);
                $('#summernote1').summernote('code', rpm_encounter_data.notes);                   
                $('#timespent').val(rpm_encounter_data.timespent);
                $("#rpm_enc_id").val(rpm_encounter_data.id);
                $("#activity_dropdown").html(select);
                $('#rpm_form1').css('display','block');
            }  
    });
   
}
$(".notes_th").mouseover(function(){
    $("#modelshow").modal('show');
});
$(".notes_th").mouseout(function(){
    $("#modelshow").modal('hide');
});
$('#confirm1').click(function()
    {
          
           var encounter_type = $('#encounter_type').val();
           var performed_by = $('#performed_by').val();
           var activity = $('#activity').val();
           var note = $('.note-editable').html();
           var timespent = $('#timespent').val();
           var id=$("#rpm_enc_id").val();
            $.ajax({
                type: 'POST',
                url:'./forms.php?edit_rpm',
                data:{
                    rpm:'true',
                    encounter_type:encounter_type,
                    performed_by:performed_by,
                    activity:activity,
                    note:note,
                    timespent:timespent,
                    id:id
                },
                success: function(data) {
                    //alert(data);
                    $(".time,.activity,.encounter_type").removeClass('btn-secondary');
                    $('.note-editable').html('');
                    $('.note-editable').attr("placeholder", "Type your Notes here!");
                    $('#form_id').val('');
                    location.reload();
                    $("#rpm_form1").css('display','none');
                    
                }
            })
    })