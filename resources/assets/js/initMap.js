var initMaps = function () {
        var styles = [
            {
                featureType: "road",
                elementType: "geometry",
                stylers: [
                    { lightness: 90 },
                    { visibility: "simplified" }
                ]
            }, {
                featureType: "road",
                elementType: "labels",
                stylers: [
                    { visibility: "on" }
                ]
            }, {
                featureType: "poi",
                stylers: [
                    { visibility: "off" }
                ]
            }, {
                featureType: "landscape",
                stylers: [
                    { visibility: "off" }
                ]
            }
        ];
        var styledMap = new google.maps.StyledMapType(styles, {name: "Styled Map"});
        var mapOptionsCrolles = {
            center: new google.maps.LatLng(45.273546,5.897627),
            zoom: 17,
            scrollwheel: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
            }
        };
        var mapCrolles = new google.maps.Map($('.contact__map')[0], mapOptionsCrolles);
        mapCrolles.mapTypes.set('map_style', styledMap);
        mapCrolles.setMapTypeId('map_style');
        // Création de l'icône
        //var myMarkerImage = new google.maps.MarkerImage(template_url+'/path_to_img');
        var myMarkerCrolles = new google.maps.Marker({
            position: new google.maps.LatLng(45.273546, 5.894057),
            map: mapCrolles,
            title: "Cabinet Schmidt"
            //icon: myMarkerImage
        });
    };
