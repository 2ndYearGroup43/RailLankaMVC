function openJourneyDetails(journeys, c) {
    var table=document.getElementById('journeypopup');
    table.rows.namedItem('Ids').cells.namedItem('journeyId').innerHTML=journeys[c].journeyId;
    table.rows.namedItem('Ids').cells.namedItem('moderatorId').innerHTML=journeys[c].moderatorId;
    table.rows.namedItem('date_time').cells.namedItem('assignedDate').innerHTML=journeys[c].assignment_date;
    table.rows.namedItem('date_time').cells.namedItem('assignedTime').innerHTML=journeys[c].assignment_time;
    table.rows.namedItem('journey_date_time').cells.namedItem('started_date_time').innerHTML=journeys[c].started_date+" "+journeys[c].started_time;
    table.rows.namedItem('journey_date_time').cells.namedItem('ended_date_time').innerHTML=journeys[c].ended_date+" "+journeys[c].ended_time;
    table.rows.namedItem('journeyStatus').cells.namedItem('journeyDate').innerHTML=journeys[c].date;
    table.rows.namedItem('journeyStatus').cells.namedItem('journeyStatus').innerHTML=journeys[c].journey_status;
    table.rows.namedItem('journeyDetails').cells.namedItem('trainId').innerHTML=journeys[c].trainId;
    table.rows.namedItem('journeyDetails').cells.namedItem('driverId').innerHTML=journeys[c].driverId;
    switch ( table.rows.namedItem('journeyStatus').cells.namedItem('journeyStatus').innerHTML) {
        case 'Live':
            table.rows.namedItem('journeyStatus').cells.namedItem('journeyStatus').style.backgroundColor='#b8ea98';
            break;
        case 'Off-Line':
            table.rows.namedItem('journeyStatus').cells.namedItem('journeyStatus').style.backgroundColor='#ead398';
            break;
        case 'Ended':
            table.rows.namedItem('journeyStatus').cells.namedItem('journeyStatus').style.backgroundColor='#ea9898';
            break;
    }
    document.getElementById('popup-journey').style.display="block";

}

function closeJourneyDetails() {
    document.getElementById('popup-journey').style.display="none";
}

window.onload= function () {
    var table=document.getElementById('journeyTable');
    for (let i in table.rows){
       if(i>0){
           var row=table.rows[i];
           console.log(i);
           console.log(row);
           switch (row.cells.namedItem('jstatus').innerHTML) {//check whats inside the table cell (status cell)
               case 'Live':
                   row.cells.namedItem('jstatus').style.backgroundColor='#b8ea98';
                   break;
               case 'Off-Line':
                   row.cells.namedItem('jstatus').style.backgroundColor='#ead398';
                   break;
               case 'Ended':
                   row.cells.namedItem('jstatus').style.backgroundColor='#ea9898';
                   break;
           }
       }
    }
}