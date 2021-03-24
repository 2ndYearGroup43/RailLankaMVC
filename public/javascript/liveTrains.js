function zoomAround(map){
     var westernLoc={lat: 6.933924,lng: 79.850026};
     var southernLoc={lat: 6.034246461056236,lng: 80.214295039247};
     var centralLoc={lat: 7.289776,lng: 80.632347};
     var northernLoc={lat: 9.667037622579672,lng: 80.0209296861432};
     var easternLoc={lat: 8.593162518186563,lng: 81.22041713456699};

    var selectArea=document.getElementById('centerAround');
    var area=selectArea.value;

    switch (area) {
        case "western":
            map.panTo(westernLoc);
            break;
        case "southern":
            map.panTo(southernLoc);
            break;
        case "northern":
            map.panTo(northernLoc);
            break;
        case "eastern":
            map.panTo(easternLoc);
            break;
        case "central":
            map.panTo(centralLoc);
            break;
    }
    map.zoom=10;

}

function zoomTrain(markers, map){
    var journeyId=document.getElementById('trainid').value;
    console.log(journeyId);
    if(markers.hasOwnProperty(journeyId)){
        map.panTo(markers[journeyId]['marker'].position);
        map.zoom=15;
    }else{
        alert("Entered train must've ended its journey");
    }
}

function getLiveTrains(markers, map){
    $.ajax({
        type: 'get',
        url: '/raillankamvc/ModeratorTrackings/getLiveLocations',
        dataType: 'json',
        success: function (response) {
            if(response.length>0){
                console.log('new');
                for(var i=0;i<response.length;i++){
                    var loc={
                        lat: Number(response[i].latitude),
                        lng: Number(response[i].longtitude)
                    };
                    if(markers.hasOwnProperty(response[i].journeyId)){
                        markers[response[i].journeyId]['marker'].setPosition(loc);
                        markers[response[i].journeyId]['journey_status']=response[i]['journey_status'];
                    }else{
                        var markerNew=new google.maps.Marker({
                            position: loc,
                            map:map,
                            title: response[i].trainId+" "+response[i].name
                        });
                        markers[response[i]["journeyId"]] = {
                            marker: markerNew,
                            trainId: response[i]["trainId"],
                            name: response[i]["name"],
                            status: response[i]["journey_status"]
                        };
                    }
                    //change marker icon image to indicate if they re stopped or not
                    if(response[i]['journey_status']=="Live"){
                        markers[response[i]["journeyId"]]['marker'].setIcon(icons['live']['iconPath']);
                    }else if (response[i]['journey_status']=="Off-Line"){
                        console.log("kaka");
                        markers[response[i]["journeyId"]]['marker'].setIcon(icons['stopped']['iconPath']);
                    }
                }
            }else{
                var notice=document.getElementById('redNotice');
                notice.innerHTML="There seems to be no trains live right now!";
            }
        }

    })
}