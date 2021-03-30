

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

    row.insertCell(0).innerHTML=compartmentNo.value;
    row.insertCell(1).innerHTML=trainClass.value;
    row.insertCell(2).innerHTML=type.value;
    row.insertCell(3).innerHTML='<input type="button" class="red-btn" value = "Del" onClick="Javacsript:deleteRow(this)">';
    


    compartmentNo.value='';
    trainClass.value="";
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

