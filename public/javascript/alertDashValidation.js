window.onload = function (){
    var datePicker= document.getElementById('searchDate');
    var today=new Date();
    datePicker.max=today.toISOString().split('T')[0];
    // console.log(today.toISOString().split('T')[0]);


}