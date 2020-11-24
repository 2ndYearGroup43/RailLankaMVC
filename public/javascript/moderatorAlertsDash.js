function randomCharts(can, del, resc, tech, env, rail, oth) {
    var totalTypes=can+resc+del;
    var totalIss=tech+env+rail+oth;
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
                {y: (can/totalTypes)*100, label: "Cancellations"},
                {y: (del/totalTypes)*100,  label: "Delays"}, 
                {y: (resc/totalTypes)*100, label: "Reschedulements"}
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
                {y: (tech/totalIss)*100, label: "Technical"},
                {y: (env/totalIss)*100,  label: "Environmental"}, 
                {y: (rail/totalIss)*100, label: "Rail Road"},
                {y: (oth/totalIss)*100, label: "Other"}
            ]
        }]
    
    });


    chartAlertType.render();
    chartAlertIssueType.render();
    
}