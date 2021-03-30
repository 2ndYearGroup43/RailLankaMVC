window.onload = function () {
    var cancelDate= document.getElementById('cancelDate');
    var today=new Date();
    console.log(today);
    cancelDate.min=today.toISOString().split('T')[0];
}