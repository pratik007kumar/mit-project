/**
 * Created by Administrator on 9/11/14.
 */

function checkfile(sender) {
    var validExts = new Array(".xlsx", ".xls", ".csv");
    var fileExt = sender.value;
    fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
    if (validExts.indexOf(fileExt) < 0) {
        alert("Invalid file selected, valid files are of " +
            validExts.toString() + " types.")
        sender.value="";
        return false;
    }
    else return true;
}

function checkImageFile(sender) {
    var validExts = new Array(".jpge",".jpg",".png");
    var fileExt = sender.value;
    fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
    if (validExts.indexOf(fileExt) < 0) {
        alert("Invalid file selected, valid files are of " +
            validExts.toString() + " types.")
        sender.value="";
        return false;
    }
    else return true;
}

//change password Admin
function changepassword()
{
    if($("#new_password").val()===$("#confirm_password").val())
    {
        var newpass=$("#new_password").val();
        var oldpass=$("#current_password").val();
        $.post( "ajax/changeAdminPassword.php", { oldpass: oldpass,newpass:newpass  },
            function(result){
                alert(result)
            });

      document.getElementById("frm").reset();
        if($("#new_password").val()==""){$('#changepassword').modal('hide')}

    }else
    {
        alert('New Password And Confirm  Password not match.!!');
    }
    return false;
}

function addStore()
{
    if(isNaN($('phno').val())){
        $.post( "ajax/addAdminStore.php",
            {
                name: $('#name').val(),
                address:$('#address').val(),
                city:$('#city').val(),
                state:$('#state').val(),
                pin:$('#pin').val(),
                category:$('#category').val(),
                phno:$('#phno').val(),
                website:$('#website').val()

            },
            function(result){

                alert(result)
                document.getElementById("addstore").reset();
                 location.reload();
            });
    }else{alert('Invalid Phone Number')}
    return false;
}
function editform(id)
{
    $.post( "ajax/storeUpdate.php",
        {
            id: id
        },
        function(result){
            $('#updatestote').html(result);
           $('#updateStore').modal('show');

        });

}

function updateStore()
{
    if(isNaN($('phno').val())){
        $.post( "ajax/storeUpdate.php",
            {
                id: $('#uid').val(),
                name: $('#uname').val(),
                address:$('#uaddress').val(),
                city:$('#ucity').val(),
                state:$('#ustate').val(),
                pin:$('#upin').val(),
                phno:$('#uphno').val(),
                website:$('#uwebsite').val(),

                    category:$('#ucategory').val(),
                like:$('#ulike').val(),
                rating:$('#urating').val(),
                update:1

            },
            function(result){

                alert(result)
               // document.getElementById("addstore").reset();
                 location.reload();
            });
    }else{alert('Invalid Phone Number')}
    return false;
}
function deleteStore(id)
{
    if(confirm("Do you want to Delete ?")){
        $.post( "ajax/storeDelete.php",
            {
                id: id

            },
            function(result){

                alert(result)
                // document.getElementById("addstore").reset();
              location.reload();
            });
    }
    return false;
}

function updateStructre(id)
{
    $.post( "ajax/structureUpdate.php",
        {
            id: id
        },
        function(result){
            $('#updatebody').html(result);
            $('#updateStructre').modal('show');

        });

}
function structureDelete(id)
{
    $.ajax({
        type: "POST",
        url: "ajax/structureDelete.php",
        data:{id:id}
        ,
        success: function(msg){
            //  document.getElementById("addmedicine").reset();
            alert(msg)
            location.href='structure.php';


        },
        error: function(){
            alert("failure");
        }
    });

}

function getcity(id,city)
{
    $.post( "ajax/getcitybystate_id.php",
        {
            id: id.value
        },
        function(result){
            $('#'+city).html(result);


        });

}


function medicineAdd() {

//twitter bootstrap script
   // $('#disp').html(' <div class="" style="padding: 100px 0px ; text-align: center;"> <i class="fa fa-spinner text-blue  fa-spin fa-2x "></i> </div>');
    $.ajax({
        type: "POST",
        url: "ajax/medicineAdd.php",
        data: $('#addmedicine').serialize()
        ,
        success: function(msg){
            document.getElementById("addmedicine").reset();

          alert(msg)
             location.href='medicine.php';

        },
        error: function(){
            alert("failure");
        }
    });

    return false;
}

function medicineUpdate()
{
    $.ajax({
        type: "POST",
        url: "ajax/medicineupdate.php",
        data: $('#updatemedicine').serialize()
        ,
        success: function(msg){
            document.getElementById("updatemedicine").reset();

            alert(msg)
            location.href='medicine.php';

        },
        error: function(){
            alert("failure");
        }
    });

    return false;
}
function midicineeditform(id)
{
    $.ajax({
        type: "POST",
        url: "ajax/medicineupdate.php",
        data:{did:id}
        ,
        success: function(msg){
            //  document.getElementById("addmedicine").reset();

            $('#updatemedicine-div').html(msg)
            $('#update').modal('show');

        },
        error: function(){
            alert("failure");
        }
    });

}
function midicinedelete(id)
{
    $.ajax({
        type: "POST",
        url: "ajax/medicineDelete.php",
        data:{id:id}
        ,
        success: function(msg){
            //  document.getElementById("addmedicine").reset();
            alert(msg)
            location.href='medicine.php';


        },
        error: function(){
            alert("failure");
        }
    });

}


function clinicsAdd() {

//twitter bootstrap script
    // $('#disp').html(' <div class="" style="padding: 100px 0px ; text-align: center;"> <i class="fa fa-spinner text-blue  fa-spin fa-2x "></i> </div>');
    $.ajax({
        type: "POST",
        url: "ajax/clinicsAdd.php",
        data: $('#addclinics').serialize()
        ,
        success: function(msg){
            document.getElementById("addclinics").reset();

            alert(msg)
            location.href='clinics.php';

        },
        error: function(){
            alert("failure");
        }
    });

    return false;
}


function clinicsEditform(id)
{
    $.ajax({
        type: "POST",
        url: "ajax/clinicsUpdate.php",
        data:{did:id}
        ,
        success: function(msg){
            //  document.getElementById("addmedicine").reset();

            $('#update').html(msg)
            $('#updateModal').modal('show');

        },
        error: function(){
            alert("failure");
        }
    });

}
function clinicsUpdate()
{
    $.ajax({
        type: "POST",
        url: "ajax/clinicsUpdate.php",
        data: $('#clinicsUpdateForm').serialize()
        ,
        success: function(msg){
            document.getElementById("clinicsUpdateForm").reset();

            alert(msg)
            location.href='clinics.php';

        },
        error: function(){
            alert("failure");
        }
    });

    return false;
}
function clinicsDelete(id)
{
    $.ajax({
        type: "POST",
        url: "ajax/clinicsDelete.php",
        data:{did:id}
        ,
        success: function(msg){
            //  document.getElementById("addmedicine").reset();

            alert(msg)
            location.href='clinics.php';

        },
        error: function(){
            alert("failure");
        }
    });

}

function symptomsEditform(id)
{  $('#updateModal').modal('show');
    $('#update').html(' <div class="" style="padding: 100px 0px ; text-align: center;"> <i class="fa fa-spinner text-blue  fa-spin fa-2x "></i> </div>');
    $.ajax({
        type: "POST",
        url: "ajax/symptomsUpdate.php",
        data:{did:id}
        ,
        success: function(msg){
            $('#update').html(msg)



        },
        error: function(){
            alert("failure");
        }
    });

    return false;
}

function symptomsDelete(id)
{
    $.ajax({
        type: "POST",
        url: "ajax/symptomsDelete.php",
        data:{did:id}
        ,
        success: function(msg){
            //  document.getElementById("addmedicine").reset();

            alert(msg)
             location.href='symptoms.php';

        },
        error: function(){
            alert("failure");
        }
    });

}

function firstAddFrom()
{
    $('#myModalLabel').html('Add First Aids');
    document.getElementById("addfirstaids").reset();
    $('#add').modal('show');
}
function firstaidsAdd()
{
    // $('#disp').html(' <div class="" style="padding: 100px 0px ; text-align: center;"> <i class="fa fa-spinner text-blue  fa-spin fa-2x "></i> </div>');
    $.ajax({
        type: "POST",
        url: "ajax/firstaidsAdd.php",
        data: $('#addfirstaids').serialize()
        ,
        success: function(msg){
            document.getElementById("addfirstaids").reset();

            alert(msg)
            location.href='firstaids.php';
        },
        error: function(){
            alert("failure");
        }
    });

    return false;
}

function firstaidsEditform(id)
{
    $.ajax({
        type: "POST",
        url: "ajax/firstaidsUpdate.php",
        data:{did:id},
        success: function(msg){
            $('#update').html(msg)
            $('#updateModal').modal('show');
        },
        error: function(){
            alert("failure");
        }
    });
}
function firstaidsUpdate()
{
    $.ajax({
        type: "POST",
        url: "ajax/firstaidsUpdate.php",
        data: $('#firstaidsUpdateForm').serialize()
        ,
        success: function(msg){
            document.getElementById("firstaidsUpdateForm").reset();
            alert(msg)
            location.href='firstaids.php';

        },
        error: function(){
            alert("failure");
        }
    });

    return false;
}

function firstaidsDelete(id)
{
    $.ajax({
        type: "POST",
        url: "ajax/firstaidsDelete.php",
        data:{did:id}
        ,
        success: function(msg){
            //  document.getElementById("addmedicine").reset();
            alert(msg)
            location.href='firstaids.php';

        },
        error: function(){
            alert("failure");
        }
    });
}



function healthtipsAdd()
{
    // $('#disp').html(' <div class="" style="padding: 100px 0px ; text-align: center;"> <i class="fa fa-spinner text-blue  fa-spin fa-2x "></i> </div>');
    $.ajax({
        type: "POST",
        url: "ajax/healthtipsAdd.php",
        data: $('#addhealthtips').serialize()
        ,
        success: function(msg){
            document.getElementById("addhealthtips").reset();

            alert(msg)
            location.href='health_tips.php';
        },
        error: function(){
            alert("failure");
        }
    });

    return false;
}


function healthtipsEditform(id)
{
    $.ajax({
        type: "POST",
        url: "ajax/healthtipsUpdate.php",
        data:{did:id},
        success: function(msg){
            $('#update').html(msg)
            $('#updateModal').modal('show');
        },
        error: function(){
            alert("failure");
        }
    });
}


function healthtipsUpdate()
{
    $.ajax({
        type: "POST",
        url: "ajax/healthtipsUpdate.php",
        data: $('#healthtipsUpdateForm').serialize()
        ,
        success: function(msg){
            document.getElementById("healthtipsUpdateForm").reset();
            alert(msg)
            location.href='health_tips.php';

        },
        error: function(){
            alert("failure");
        }
    });

    return false;
}


function healthtipsDelete(id)
{
    $.ajax({
        type: "POST",
        url: "ajax/healthtipsDelete.php",
        data:{did:id},
        success: function(msg){
            //  document.getElementById("addmedicine").reset();
            alert(msg)
            location.href='health_tips.php';

        },
        error: function(){
            alert("failure");
        }
    });
}