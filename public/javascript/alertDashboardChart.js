window.onload = function () {
    
    var chartAlertType = new CanvasJS.Chart("alertTypeChart", {
        animationEnabled: true,
        title: {
            text: "Alert Types on Date 2020-10-20"
        },
        data: [{
            type: "pie",
            startAngle: 240,
            yValueFormatString: "##0.00'%'",
            indexLabek: "{label} {y}",
            dataPoints: [
                {y: 25, label: "Cancellations"},
                {y: 65,  label: "Delays"}, 
                {y: 10, label: "Reschedulements"}
            ]
        }]
    
    });

    var chartAlertIssueType = new CanvasJS.Chart("issueTypeChart", {
        animationEnabled: true,
        title: {
            text: "Alert Issues on Date 2020-10-20"
        },
        data: [{
            type: "pie",
            startAngle: 240,
            yValueFormatString: "##0.00'%'",
            indexLabek: "{label} {y}",
            dataPoints: [
                {y: 25, label: "Technical"},
                {y: 45,  label: "Environmental"}, 
                {y: 17, label: "Rail Road"},
                {y: 13, label: "Other"}
            ]
        }]
    
    });


    chartAlertType.render();
    chartAlertIssueType.render();
}