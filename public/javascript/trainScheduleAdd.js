// window.onload = function() {
  

//     console.log("hola hola");


// }

var schedules=[];


function addScheduleRow() {
    document.getElementById("stationIDError").innerHTML='';
    document.getElementById("stopNoError").innerHTML='';
    document.getElementById("arrivalTimeError").innerHTML='';
    document.getElementById("departureTimeError").innerHTML='';
    document.getElementById("dateError").innerHTML='';
    document.getElementById("distanceError").innerHTML='';

    var stationName= document.getElementById("stationID");
    var stopNo= document.getElementById("stopNo");
    var arrivalTime= document.getElementById("arrivaltime");
    var departureTime= document.getElementById("departuretime");
    var date= document.getElementById("date");
    var distance= document.getElementById("distance");
    var table= document.getElementById("scheduleTable");

    if(stationName.value.length==0){
        document.getElementById("stationIDError").innerHTML="You should select a Station.";
        return;
    }else if (stopNo.value.length==0) {
        document.getElementById("stopNoError").innerHTML="You should enter a stop number.";
        return;
    }else if(arrivalTime.value.length==0){
        document.getElementById("arrivalTimeError").innerHTML="You should enter a Arrival time.";
        return;
    }else if(departureTime.value.length==0){
        document.getElementById("departureTimeError").innerHTML="You should enter a Depature time.";
        return;
    }else if(date.value.length==0){
        document.getElementById("dateError").innerHTML="You should enter a Date.";
        return;
    }else if(distance.value.length==0){
        document.getElementById("distanceError").innerHTML="You should enter a distance.";
        return;
    }
        

    var tbody=table.getElementsByTagName("tbody")[0];
    var rowCount=tbody.rows.length;
    var row=tbody.insertRow(rowCount);

    var index=schedules.length;

    var temp={
        "stationId": stationName.value,
        "stopNo": stopNo.value,
        "arrivaltime": arrivalTime.value,
        "departuretime": departureTime.value,
        "date": date.value,
        "distance": distance.value
    }

    schedules.push(temp);

    console.log(schedules);

    // schedules[index]["stationId"]=stationName;
    // schedules[index]["stopno"]=stopNo;
    // schedules[index]["arrivaltime"]=arrivalTime;
    // schedules[index]["departuretime"]=departureTime;
    // schedules[index]["date"]=date;
    // schedules[index]["distance"]=distance;
    

    row.insertCell(0).innerHTML=stationName.value;
    row.insertCell(1).innerHTML=stopNo.value;
    row.insertCell(2).innerHTML=arrivalTime.value;
    row.insertCell(3).innerHTML=departureTime.value;
    row.insertCell(4).innerHTML=date.value;
    row.insertCell(5).innerHTML=distance.value;
    row.insertCell(6).innerHTML='<input type="button" class="red-btn" value = "Del" onClick="Javacsript:deleteRow(this)">';
    


    stationName.value='';
    stopNo.value="";
    // arrivalTime.value='';
    // departureTime.value='';
    date.value='';
    distance.value='';

    $('#scheduleField').val(JSON.stringify(schedules));

} 

function deleteRow(obj) {
    var index=obj.parentNode.parentNode.rowIndex;
    var table= document.getElementById("scheduleTable");
    table.deleteRow(index);
    console.log(index);
    schedules.splice(index-1,1);
    console.log(schedules);

    
    $('#scheduleField').val(JSON.stringify(schedules));


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