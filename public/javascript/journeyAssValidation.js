window.onload = function () {
    var assDate=document.getElementById('date');
    var today= new Date();
    assDate.min=today.toISOString().split('T')[0];
}