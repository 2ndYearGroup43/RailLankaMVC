window.onload = function () {
    var assDate=document.getElementById('date');
    var today= new Date();
    if(updateFlag==0){
        assDate.min=today.toISOString().split('T')[0];
    }

}