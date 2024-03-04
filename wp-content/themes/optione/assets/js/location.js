;(function ($) {
    "use strict";


    function initMapCom() {
        initMap(5,45);
    }
        
    function initMapDith() {
        initMap(3,30);
    }
    
    function initMap(mapZoom,latitude) {
        var map;
        var marker;
        var i;       
        var infowindow = new google.maps.InfoWindow({
            maxWidth:393
        });
        var mapLocations = [];
        
        $(".locations-box").each(function(){
            locationName = $(this).find("[data-location-name]").html();
            locationLat = parseFloat($(this).data("location-lat"));
            locationLng = parseFloat($(this).data("location-lng"));
            locationDetails = $(this).find("[data-location-details]").html();
            locationCat = $(this).data("location-cat");
            locationIcon = $(this).data("location-icon");
            locationCountry = $(this).data("location-country");
            mapLocations.push([locationLat, locationLng, locationDetails, locationIcon, locationName, locationCat, locationCountry]);
        });
        console.log(mapLocations);
    
        var center_location = {lat: 30, lng: -0};
        var markers = [];
        
        map = new google.maps.Map(document.getElementById('map'), {
            center: center_location,
            zoom: mapZoom,
            mapTypeControl: false,
            fullscreenControl: false,
            streetViewControl: false,
            zoomControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.LEFT_TOP
            },
            styles: [
                
                
                // imported
                {
                    "featureType":"administrative",
                    "elementType":"labels.text.fill",
                    "stylers":[
                        {
                            "color":"#444444"
                        }
                    ]
                },
                {
                    "featureType":"administrative.country",
                    "elementType":"geometry",
                    "stylers":[
                        {
                            "visibility":"on"
                        }
                    ]
                },
                {
                    "featureType":"administrative.country",
                    "elementType":"geometry.fill",
                    "stylers":[
                        {
                            "visibility":"on"
                        }
                    ]
                },
                {
                    "featureType":"administrative.country",
                    "elementType":"labels",
                    "stylers":[
                        {
                            "visibility":"on"
                        }
                    ]
                },
                {
                    "featureType":"administrative.province",
                    "elementType":"geometry",
                    "stylers":[
                        {
                            "visibility":"on"
                        }
                    ]
                },
                {
                    "featureType":"administrative.locality",
                    "elementType":"geometry",
                    "stylers":[
                        {
                            "visibility":"on"
                        }
                    ]
                },
                {
                    "featureType":"landscape",
                    "elementType":"all",
                    "stylers":[
                        {
                            "color":"#f2f2f2"
                        },
                        {
                            "visibility":"off"
                        }
                    ]
                },
                {
                    "featureType":"landscape",
                    "elementType":"geometry",
                    "stylers":[
                        {
                            "visibility":"off"
                        }
                    ]
                },
                {
                    "featureType":"poi",
                    "elementType":"all",
                    "stylers":[
                        {
                            "visibility":"off"
                        }
                    ]
                },
                
                {
                    "featureType":"road",
                    "elementType":"all",
                    "stylers":[
                        {
                            "saturation":-100
                        },
                        {
                            "lightness":45
                        },
                        {
                            "visibility":"on"
                        }
                    ]
                },
                
                {
                    "featureType":"road.highway",
                    "elementType":"all",
                    "stylers":[
                        {
                            "visibility":"simplified"
                        }
                    ]
                },
                
                {
                    "featureType":"road.arterial",
                    "elementType":"labels.icon",
                    "stylers":[
                        {
                            "visibility":"off"
                        }
                    ]
                },
                
                {
                    "featureType":"transit",
                    "elementType":"all",
                    "stylers":[
                        {
                            "visibility":"off"
                        }
                    ]
                },
                
                {
                    "featureType":"water",
                    "elementType":"all",
                    "stylers":[
                        {
                            "color":"#656565"
                        },
                        {
                            "visibility":"on"
                        }
                    ]
                }
            ]
        });
        
        for (i = 0; i < mapLocations.length; i++) {
            
            var mapLocation = mapLocations[i];
            var mapLat = mapLocation[0];
            var mapLng = mapLocation[1];
            var markerImg = mapLocation[3];
            var mapName = mapLocation[4];
            var mapCat = mapLocation[5];
            var mapCountry = mapLocation[6];
            
            marker = new google.maps.Marker({
                position: {lat: mapLat, lng: mapLng},
                map: map,
                animation: google.maps.Animation.DROP,
                icon: new google.maps.MarkerImage(markerImg, null, null, null, new google.maps.Size(40,40)),
                draggable: false
            });
            marker.mrkrCountry = mapCountry;
            marker.mrkrCategory = mapCat;            
            markers.push(marker);
            
            var currentMarker = null;
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    
                return function() {
                    var iwCenterName = mapLocations[i][4];
                    var iwCenterAddress = mapLocations[i][2];
                    
                    var contentString = '<div id="iw-container">' +
                        '<div class="iw-title"><h4 class="col-active">' + iwCenterName + '</h4></div>' +
                        '<div class="iw-content">' +
                        '<p class="iw-contact-address">' + iwCenterAddress + '</p>' +
                        '</div>' +
                        '</div>';
                    // set this marker to the currentMarker
                    if (currentMarker) currentMarker.setAnimation(null);
                    currentMarker = marker;
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                    
                    infowindow.setContent(contentString);
                    infowindow.open(map, marker);
                }
            })(marker, i));
    
            function showCountry(country){
                for (var i=0; i<markers.length; i++) {
                    if (markers[i].mrkrCountry == country) {
                        markers[i].setVisible(true);
                    }
                }
            }
    
            function hideCountry(country){
                for (var i=0; i<markers.length; i++) {
                    if (markers[i].mrkrCountry == country) {
                        markers[i].setVisible(false);
                    }
                }
                infowindow.close();
            }
            
            function showCat(category){
                for (var i=0; i<markers.length; i++) {
                    if (markers[i].mrkrCategory == category) {
                        markers[i].setVisible(true);
                    }
                }
            }
            
            function hideCat(category){
                for (var i=0; i<markers.length; i++) {
                    if (markers[i].mrkrCategory == category) {
                        markers[i].setVisible(false);
                    }
                }
                infowindow.close();
            }
            
            
            $("#map-tab-list > ul > li > input[type='checkbox']").change(function(){
                if ( $(this).is(':checked') ) {
                    category = $(this).data('location-cat');
                    showCat(category);
                
                    $(".map-location-container [data-location-cat='"+category+"']").parent().show();
                    $(this).closest(".list-item").find("input").prop('checked', true);
                }
                else{
                    category = $(this).data('location-cat');
                    hideCat(category);
                
                    $(".map-location-container [data-location-cat='"+category+"']").parent().hide();
                    $(this).closest(".list-item").find("input").prop('checked', false);
                }
            });
            
            $("#map-tab-list ul li input[type='checkbox']").change(function(){        
                checkResults();
            });
            
            function hideSingleMarker(markerid){
                for (var i=0; i<markers.length; i++) {
                    markers[markerid].setVisible(false);
                }
                infowindow.close();
            }
            
            function showSingleMarker(markerid){
                for (var i=0; i<markers.length; i++) {
                    markers[markerid].setVisible(true);
                }
            }
    
        }
        
        $(".locations-select").change(function(){
            if ( $(this).val() == -1 ){
                $(".map-location-container .locations-box").parent().show();
                for (var i=0; i<markers.length; i++) {
                    markers[i].setVisible(true);
                }
            }
            else{
                showCat($(this).val());
                //hideOtherCat($(this).val());
                hideLocantions();
            }
            
            checkResults();
        });
    
        $(".countries-select").change(function(){
            if ( $(this).val() == -1 ){
                $(".map-location-container .locations-box").parent().show();
                for (var i=0; i<markers.length; i++) {
                    markers[i].setVisible(true);
                }
            }
            else{
                showCountry($(this).val());
                //hideOtherCountry($(this).val());
                hideLocantions();
            }
    
            checkResults();
        });
        
        map.addListener('click', function() {
            infowindow.close();
        });
        
        // Infowindow
    
        google.maps.event.addListener(infowindow, 'domready', function() {
            // Reference to the DIV which receives the contents of the infowindow using jQuery
            var iwOuter = $('.gm-style-iw');
            
            /* The DIV we want to change is above the .gm-style-iw DIV.
            * So, we use jQuery and create a iwBackground variable,
            * and took advantage of the existing reference to .gm-style-iw for the previous DIV with .prev().
            */
            var iwBackground = iwOuter.prev();
            
            // Remove the background shadow DIV
            iwBackground.children(':nth-child(2)').css({'display' : 'none'});
            
            // Remove the white background DIV
            iwBackground.children(':nth-child(4)').css({'display' : 'none'});
            
            // add z-index to the arrow
            iwBackground.css("z-index", 2);
            
            // Moves the shadow of the arrow 76px to the left margin.
            iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left:213px !important;'});
    
            // Moves the arrow 76px to the left margin.
            iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left:213px !important;'});
    
            // Changes the desired tail shadow color.
            iwBackground.children(':nth-child(3)').find('div').children().css({'font-size' : '16px', 'background-color' : '#FFFFFF', 'z-index' : '1'});
    
            // Reference to the div that groups the close button elements.
            var iwCloseBtn = iwOuter.next();
    
            // Apply the desired effect to the close button
            iwCloseBtn.css({opacity: '1', width: '16px', height: '16px', right: '38px', top: '24px', border: '0', 'border-radius': '0', 'box-shadow': '0'});
            iwCloseBtn.children("img").css("display", "none");
            iwCloseBtn.append("<i class='icon-close'></i>").css({position: 'asbolute', width: '16px', height: '16px',  'z-index': '2', 'font-size': '16px'});
            
            // The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
            iwCloseBtn.mouseout(function(){
                $(this).css({opacity: '1'});
            });
            
        });
            
        // click on input label to toggle infowindow
        $(document).on('click', '[data-markerid]', function () {
            google.maps.event.trigger(markers[$(this).data('markerid')], 'click');
        });
    
        // click on input checkbox to show hide list results
        $(document).on('click', '[data-input-markerid]', function () {
            if ( $(this).is(':checked') ) {
                $(".map-location-container [data-markerid='"+$(this).data('input-markerid')+"']").closest(".locations-box").parent().show();
                showSingleMarker($(this).data('input-markerid'));
            }
            else{
                $(".map-location-container [data-markerid='"+$(this).data('input-markerid')+"']").closest(".locations-box").parent().hide();
                hideSingleMarker($(this).data('input-markerid'));
            }
        });
    
        function hideOtherCat(category){
            var country = $("#place_country").val(); //gestire country != -1
            for (var i=0; i<markers.length; i++) {
                if (markers[i].mrkrCategory != category) { //|| markers[i].mrkrCountry != country //OK
                    markers[i].setVisible(false);
                }
            }
            infowindow.close();
            $(".map-location-container .locations-box").parent().hide()
            $(".map-location-container .locations-box[data-location-cat='"+category+"']").parent().show();
            //$(".map-location-container .locations-box[data-location-country='"+country+"']").parent().show();
        }
    
        function hideOtherCountry(country){
            var category = $("#place_category").val();
            for (var i=0; i<markers.length; i++) {
                if (markers[i].mrkrCountry != country) {
                    markers[i].setVisible(false);
                }
            }
            infowindow.close();
            $(".map-location-container .locations-box").parent().hide()
            //$(".map-location-container .locations-box[data-location-cat='"+category+"']").parent().show();
            $(".map-location-container .locations-box[data-location-country='"+country+"']").parent().show();
        }
    
        function hideLocantions(){
            var category = $("#place_category").val();
            var country = $("#place_country").val();
            if ( category != -1 && country != -1 ) {
                for (var i = 0; i < markers.length; i++) {
                    if (markers[i].mrkrCountry != country || markers[i].mrkrCategory != category) {
                        markers[i].setVisible(false);
                    }
                }
                infowindow.close();
                $(".map-location-container .locations-box").parent().hide()
                if (category != -1 && country != -1) {
                    console.log("2 filrti")
                    $(".map-location-container .locations-box[data-location-cat='" + category + "']").parent().show();
                    var items = $(".map-location-container .locations-box[data-location-cat='" + category + "']").parent().show();
                    $(".map-location-container .locations-box[data-location-cat='" + category + "']").each(function (index) {
                        var countryItem = $(this).data("location-country");
                        if (countryItem != country) {
                            console.log(countryItem + "hide")
                            $(this).parent().hide();
                        }
                    });
                }
            }
            else if ( category != -1) {
                for (var i=0; i<markers.length; i++) {
                    if (markers[i].mrkrCategory != category) {
                        markers[i].setVisible(false);
                    }
                }
                infowindow.close();
                $(".map-location-container .locations-box").parent().hide()
                $(".map-location-container .locations-box[data-location-cat='"+category+"']").parent().show();
    
            }
    
            else if ( country != -1) {
                for (var i=0; i<markers.length; i++) {
                    if (markers[i].mrkrCountry != country) {
                        markers[i].setVisible(false);
                    }
                }
                infowindow.close();
                $(".map-location-container .locations-box").parent().hide()
                $(".map-location-container .locations-box[data-location-country='"+country+"']").parent().show();
    
            }
        }
        
        function checkResults(){        
            if ( $(".map-location-container-box").children(':visible').length == 0) {
                $(".map-location-container-box .no-results").show();
            }
            else{
                $(".map-location-container-box .no-results").hide();
            }
        }
        
        /* Open / close locations */
        
        if ($('.map-tab-list-button').length){  
            
            var mapButtonShow = 'Show';
            var mapButtonHide = 'Hide';
            
            $(document).on('click', '.map-tab-list-button', function() {
    
                $('.map-tab-list > ul').slideToggle('slow');
    
                if ($(this).text() == mapButtonHide) {
                    $(this).text(mapButtonShow);
                } else {
                    $(this).text(mapButtonHide);
                }
            });
        }
        
        
        $('.locations-box h4').click(function() {
            $('html, body').animate({
                scrollTop: $("#map").offset().top-90
            }, 600);
        });
    }
    
})(jQuery);
