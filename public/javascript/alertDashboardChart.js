var chartAlertType;
var chartAlertIssueType;
function initiateCharts(alertCount) {
    console.log(alertCount);
    var cancelCount=parseInt(alertCount['cancelledCount']);
    var delayCount=parseInt(alertCount['delayedCount']);
    var reschCount=parseInt(alertCount['rescheduledCount']);
    var envCount=parseInt(alertCount['envCount']);
    var techCount=parseInt(alertCount['techCount']);
    var rrcount=parseInt(alertCount['railroadCount']);
    var otherCount=parseInt(alertCount['otherCount']);
    var unspecCount= parseInt(alertCount['unspecCount']);

    var alertTypeTotal=cancelCount+delayCount+reschCount;
    var issueTypeTotal=envCount+techCount+rrcount+otherCount+unspecCount;
    console.log(alertTypeTotal);
    console.log(issueTypeTotal);
    chartAlertType = new CanvasJS.Chart("alertTypeChart", {
        animationEnabled: true,
        title: {
            text: "Alert Types on Date "+alertCount['searchDate']
        },
        data: [{
            type: "pie",
            startAngle: 240,
            yValueFormatString: "##0.00'%'",
            indexLabek: "{label} {y}",
            dataPoints: [
                {y: (cancelCount/alertTypeTotal)*100, label: "Cancellations"},
                {y: (delayCount/alertTypeTotal)*100,  label: "Delays"},
                {y: (reschCount/alertTypeTotal)*100, label: "Reschedulements"}
            ]
        }]

    });

    chartAlertIssueType = new CanvasJS.Chart("issueTypeChart", {
        animationEnabled: true,
        title: {
            text: "Alert Issues on Date "+alertCount['searchDate']
        },
        data: [{
            type: "pie",
            startAngle: 240,
            yValueFormatString: "##0.00'%'", //defines format of the percentage display
            indexLabek: "{label} {y}",
            dataPoints: [
                {y: (techCount/issueTypeTotal)*100, label: "Technical"},
                {y: (envCount/issueTypeTotal)*100,  label: "Environmental"},
                {y: (rrcount/issueTypeTotal)*100, label: "Rail Road"},
                {y: (otherCount/issueTypeTotal)*100, label: "Other"},
                {y: (unspecCount/issueTypeTotal)*100, label: "Unspecified"}
            ]
        }]

    });


    chartAlertType.render();
    chartAlertIssueType.render();
}

function printCharts(){
    chartAlertType.print();
    chartAlertIssueType.print();
}