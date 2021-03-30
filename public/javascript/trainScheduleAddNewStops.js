
window.onload= function (){

    for (var i=0;i<currentSchedules.length;i++){
        console.log(currentSchedules[i].stationID);
    }

}

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
    }else if (isNaN(stopNo.value-1) ){
        document.getElementById("stopNoError").innerHTML="You stop number should be numeric.";
        return;
    }else if(arrivalTime.value.length==0){
        document.getElementById("arrivalTimeError").innerHTML="You should enter a Arrival time.";
        return;
    }else if(departureTime.value.length==0){
        document.getElementById("departureTimeError").innerHTML="You should enter a Departure time.";
        return;
    }else if(date.value.length==0){
        document.getElementById("dateError").innerHTML="You should enter a Date.";
        return;
    }else if(arrivalTime.value>=departureTime.value){
        document.getElementById("arrivalTimeError").innerHTML="Arrival time should be lesser than departure time";
        document.getElementById("departureTimeError").innerHTML="Departure time should be greater than arrival time";
        return;
    }else if(distance.value.length==0){
        document.getElementById("distanceError").innerHTML="You should enter a distance.";
        return;
    }else if(isNaN(distance.value-1)) {
        document.getElementById("distanceError").innerHTML="Distance should be numeric.";
        return;
    }else if(schedules.length>0){
        for(var i=0;i<schedules.length;i++){
            if(schedules[i].stopNo==stopNo.value){
                console.log(schedules[i].stopNo);
                document.getElementById("stopNoError").innerHTML="stop number has been repeated.";
                return;
            }
            if(schedules[i].stationId==stationName.value){
                document.getElementById("stationIDError").innerHTML="Station name has been repeated.";
                return;
            }
        }
    }else if(currentSchedules.length>0){
        for(var i=0;i<currentSchedules.length;i++){
            if(currentSchedules[i].stopNo==stopNo.value){
                console.log(currentSchedules[i].stopNo);
                document.getElementById("stopNoError").innerHTML="stop number has been already entered.";
                return;
            }
            if(currentSchedules[i].stationID==stationName.value){
                document.getElementById("stationIDError").innerHTML="Station name has already entered.";
                return;
            }
        }
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


    row.insertCell(0).innerHTML=stationName.value;
    row.insertCell(1).innerHTML=stopNo.value;
    row.insertCell(2).innerHTML=arrivalTime.value;
    row.insertCell(3).innerHTML=departureTime.value;
    row.insertCell(4).innerHTML=date.value;
    row.insertCell(5).innerHTML=distance.value;
    row.insertCell(6).innerHTML='<input type="button" class="red-btn" value = "Del" onClick="Javacsript:deleteRow(this)">';



    stationName.value='';
    stopNo.value="";
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

