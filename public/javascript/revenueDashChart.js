window.onload = function () {
    
    var chartRevenueClass = new CanvasJS.Chart("revenueClassChart", {
        animationEnabled: true,
        title: {
            text: "Revenue for Classes"
        },
        data: [{
            type: "pie",
            startAngle: 240,
            yValueFormatString: "##0.00'%'",
            indexLabek: "{label} {y}",
            dataPoints: [
                {y: 25, label: "1st Class"},
                {y: 65,  label: "2nd Class"}, 
                {y: 10, label: "3rd Class"}
            ]
        }]
    
    });

    var chartRevenueType = new CanvasJS.Chart("revenueTypeChart", {
        animationEnabled: true,
        title: {
            text: "Revenue by types"
        },
        data: [{
            type: "pie",
            startAngle: 240,
            yValueFormatString: "##0.00'%'",
            indexLabek: "{label} {y}",
            dataPoints: [
                {y: 37, label: "Online"},
                {y: 63,  label: "Over the Counter"}
            ]
        }]
    
    });

    
    var chartTotalRevenue = new CanvasJS.Chart("totalRevenueChart", {
        animationEnabled: true,
        title: {
            text: "Revenue by types"
        },
        axisY:[{
            title: "Revenue",
            lineColor: "#c24642",
            tickColor: "#c24642",
            labelFontColor: "#c24642",
            titleFontColor: "#c24642",
            suffix: "k"
        }],
        tootTip: {
            shared: true
        },
        legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries
        },
        data: [{
            type:"line",
            name: "Online",
            color: "#369ead",
            showInLegend: true,
            axisYIndex: 1,
            dataPoints: [
                {x: new Date(2020, 02, 29), y: 33.4},
                {x: new Date(2020, 03, 31), y: 29.5},
                {x: new Date(2020, 04, 30), y: 42.0},
                {x: new Date(2020, 05, 31), y: 32.7},
                {x: new Date(2020, 06, 30), y: 53.4},
                {x: new Date(2020, 07, 31), y: 47.4},
                {x: new Date(2020, 08, 30), y: 67.8}
            ]
        },
        {
            type:"line",
            name: "Over the Counter",
            color: "#c24642",
            showInLegend: true,
            axisYIndex: 0,
            dataPoints: [
                {x: new Date(2020, 02, 29), y: 53.4},
                {x: new Date(2020, 03, 31), y: 37.5},
                {x: new Date(2020, 04, 30), y: 63.0},
                {x: new Date(2020, 05, 31), y: 72.7},
                {x: new Date(2020, 06, 30), y: 69.4},
                {x: new Date(2020, 07, 31), y: 78.4},
                {x: new Date(2020, 08, 30), y: 66.8}
            ]
        }]
    });


    var chartTotalTypeRevenue = new CanvasJS.Chart("totalRevenueByType", {
        animationEnabled: true,
        title: {
            text: "Revenue by Seat Classes"
        },
        axisY:[{
            title: "Revenue",
            lineColor: "#c24642",
            tickColor: "#c24642",
            labelFontColor: "#c24642",
            titleFontColor: "#c24642",
            suffix: "k"
        }],
        tootTip: {
            shared: true
        },
        legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries
        },
        data: [{
            type:"line",
            name: "First Class",
            color: "#0000ff",
            showInLegend: true,
            axisYIndex: 1,
            dataPoints: [
                {x: new Date(2020, 02, 29), y: 24.4},
                {x: new Date(2020, 03, 31), y: 19.5},
                {x: new Date(2020, 04, 30), y: 24.0},
                {x: new Date(2020, 05, 31), y: 18.7},
                {x: new Date(2020, 06, 30), y: 15.4},
                {x: new Date(2020, 07, 31), y: 26.4},
                {x: new Date(2020, 08, 30), y: 17.8}
            ]
        },
        {
            type:"line",
            name: "Second Class",
            color: "#00ff00",
            showInLegend: true,
            axisYIndex: 0,
            dataPoints: [
                {x: new Date(2020, 02, 29), y: 33.4},
                {x: new Date(2020, 03, 31), y: 37.5},
                {x: new Date(2020, 04, 30), y: 23.0},
                {x: new Date(2020, 05, 31), y: 24.7},
                {x: new Date(2020, 06, 30), y: 31.4},
                {x: new Date(2020, 07, 31), y: 19.4},
                {x: new Date(2020, 08, 30), y: 32.8}
            ]
        },
        {
            type:"line",
            name: "Third Class",
            color: "#990000",
            showInLegend: true,
            axisYIndex: 0,
            dataPoints: [
                {x: new Date(2020, 02, 29), y: 23.4},
                {x: new Date(2020, 03, 31), y: 37.5},
                {x: new Date(2020, 04, 30), y: 43.0},
                {x: new Date(2020, 05, 31), y: 22.7},
                {x: new Date(2020, 06, 30), y: 39.4},
                {x: new Date(2020, 07, 31), y: 28.4},
                {x: new Date(2020, 08, 30), y: 32.8}
            ]
        }]
    });

       

    chartRevenueClass.render();
    chartRevenueType.render();
    chartTotalRevenue.render();
    chartTotalTypeRevenue.render();

    function toggleDataSeries(e) {
        if(typeof(e.dataSeries.visible)=="undefined" || e.dataSeries.visible){
            e.dataSeries.visible=false;
        }else{
            e.dataSeries.visible=true;
        }
        e.chartTotalRevenue.render();
        e.chartTotalTypeRevenue.render();
    }
}