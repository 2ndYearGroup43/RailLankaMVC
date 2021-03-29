// window.onload = function() {
  

//     console.log("hola hola");


// }

var compartments=[];


function addCompartmentRow() {
    document.getElementById("compartmentNoError").innerHTML='';
    document.getElementById("classError").innerHTML=''; 
    document.getElementById("typeError").innerHTML='';

    var compartmentNo= document.getElementById("compartmentNo");
    var trainClass = document.getElementById("trainClass");
    var type= document.getElementById("type");

    
    var table= document.getElementById("compartmentTable");

    if(compartmentNo.value.length==0){
        document.getElementById("compartmentNoError").innerHTML="You should enter the compartment number.";
        return;
    }else if (trainClass.value.length==0) {
        document.getElementById("classError").innerHTML="You should enter the class.";
        return;
    }else if(type.value.length==0){
        document.getElementById("typeError").innerHTML="You should enter a a compartment type.";
        return;
    }else if(compartments.length>0){
        for(var i=0;i<compartments.length;i++){
            if (compartments[i].compartmentNo==compartmentNo.value){
                document.getElementById("compartmentNoError").innerHTML="Compartment number has been repeated.";
                return;
            }
        }
    }else if(currentCompartments.length>0){
        for(var i=0;i<currentCompartments.length;i++){
            if (currentCompartments[i].compartmentNo==compartmentNo.value){
                document.getElementById("compartmentNoError").innerHTML="Compartment number has been already inserted.";
                return;
            }
        }
    }
        

    var tbody=table.getElementsByTagName("tbody")[0];
    var rowCount=tbody.rows.length;
    var row=tbody.insertRow(rowCount);

    var index=compartments.length;

    var temp={
        "compartmentNo": compartmentNo.value,
        "trainClass": trainClass.value,
        "type": type.value
    }

    compartments.push(temp);

    console.log(compartments);

    // schedules[index]["stationId"]=stationName;
    // schedules[index]["stopno"]=stopNo;
    // schedules[index]["arrivaltime"]=arrivalTime;
    // schedules[index]["departuretime"]=departureTime;
    // schedules[index]["date"]=date;
    // schedules[index]["distance"]=distance;
    

    row.insertCell(0).innerHTML=compartmentNo.value;
    row.insertCell(1).innerHTML=trainClass.value;
    row.insertCell(2).innerHTML=type.value;
    row.insertCell(3).innerHTML='<input type="button" class="red-btn" value = "Del" onClick="Javacsript:deleteRow(this)">';
    


    compartmentNo.value='';
    trainClass.value="";
    // arrivalTime.value='';
    // departureTime.value='';
    type.value='';

    $('#compartmentField').val(JSON.stringify(compartments));

    var coll= document.getElementById("availdays-btn");
    var content=coll.nextElementSibling;
    if(content.style.display==="none"){
        content.style.display="block";
        coll.style.backgroundColor="#0c2752";
    }
} 

function deleteRow(obj) {
    var index=obj.parentNode.parentNode.rowIndex;
    var table= document.getElementById("compartmentTable");
    table.deleteRow(index);
    console.log(index);
    compartments.splice(index-1,1);
    console.log(compartments);

    
    $('#compartmentField').val(JSON.stringify(compartments));


}


// function postData(trainId) {
//     schedules.push(trainId);

//     var url= "";
//     $.ajax({
//         type: "POST",
//         url: url,
//         data: JSON.stringify(schedules),
//         contentType: "applicaton/json; charset=utf-8",
//         dataType: "json",
//         error: function(){
//             alert("Error sumiting data");
//         },
//         success: function(){
//             alert("Successfully submited");
//         }
//     })
// }

// function postData() {
//     var values = {};
//     var fields=$('#scheduleForm :input');
//     $.each(fields, function (i, field) {
//         var dom = $(field),
//             name= dom.attr('name'),
//             value=dom.val();
//         values[name]=value;    

//     });

//     values.schedules={};
//     $.each(schedules, function(i, field){
//         values.schedules[field.name]=field.value;
//     });

//     console.log(values);

//     $.post('/raillankamvc/Admin_manage_schedules/addschedule', values);
//     alert("successfully submitted");
// }



// function addrow() {
//     var stationName= document.getElementById("stationID");
//     var stopNo= document.getElementById("stopno");
//     var arrivalTime= document.getElementById("arrivaltime");
//     var departureTime= document.getElementById("departuretime");
//     var date= document.getElementById("date");
//     var distance= document.getElementById("distance");
//     var table= document.getElementById("scheduleTable");

//     var rowCount=table.rows.length;
//     var row=table.insertRow(rowCount);

//     var index=schedules.length;

//     schedules[index]["stationId"]=stationName;
//     schedules[index]["stopno"]=stopNo;
//     schedules[index]["arrivaltime"]=arrivalTime;
//     schedules[index]["departuretime"]=departureTime;
//     schedules[index]["date"]=date;
//     schedules[index]["distance"]=distance;
    

//     row.insertCell(0).innerHTML=stationName.value;
//     row.insertCell(1).innerHTML=stopNo.value;
//     row.insertCell(2).innerHTML=arrivalTime.value;
//     row.insertCell(3).innerHTML=departureTime.value;
//     row.insertCell(4).innerHTML=date.value;
//     row.insertCell(5).innerHTML=distance.value;
    
    
    

    
    
// }