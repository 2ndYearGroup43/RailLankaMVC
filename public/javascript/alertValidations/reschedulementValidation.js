window.onload = function () {
    var newDate= document.getElementById('newdate');
    var today=new Date();
    console.log(today);
    newDate.min=today.toISOString().split('T')[0];

}