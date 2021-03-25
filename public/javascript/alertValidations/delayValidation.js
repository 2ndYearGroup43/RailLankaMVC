window.onload = function () {
    var delayDate= document.getElementById('delaydate');
    var today=new Date();
    console.log(today);
    delayDate.min=today.toISOString().split('T')[0];

}