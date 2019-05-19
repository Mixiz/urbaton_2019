/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var mymap;
// data from server
var objects;
// filter category
var categories;
// filter event dates
var dates;
// current coords of map center
var coords;
var last_coords = [];

// initialize map and get first data
$( document ).ready(function() {
    console.log( "ready!" );
    mymap = L.map('mapid').setView([56.838011, 60.597465], 13); // Екатеринбург
    
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoibWl4aXoiLCJhIjoiY2p2dGt3dml2MGNjeDQzcGhvd3p0YnlpcCJ9.dVuqSZZsjy0Efu3kJUoBMQ'
    }).addTo(mymap);
    
    $('input[name="daterange"]').daterangepicker();
    // Assign handlers immediately after making the request,
    // and remember the jqXHR object for this request
    // получить данные с сервера
    prepare_data();
    get_data();

});

// get data from filters and prepare for ajax request
// categories
// dates
// coords
function prepare_data() {
    categories = [];
    jQuery("input[name='category[]']").each(function() {
        console.log( this.value + ":" + this.checked );
        if (this.checked)
          categories.push(this.value);
    });
    
    jQuery("input[name='daterange']").each(function() {
        console.log( this.value );
        dates = this.value;
    });
    
    coords = mymap.getCenter();
    coords = [coords.lat, coords.lng];
    console.log( coords );
    last_coords[0] = coords[0];
    last_coords[1] = coords[1];
}

// retrieve data from server
function get_data() {
    var jqxhr = $.ajax( {
            method: "POST",
            url: "server/server.php",
            dataType: 'json',
            data: { categories: categories
                  , dates: dates
                  , position_x:coords.lat
                  , position_y:coords.lng
              }
        })
      .done(function(msg) {
        // обработка пришедших данных
        if (msg.result = "ok") {
            //mymap.clearLayers();
            //alert('!!!');
            //alert(msg.data);
            msg = JSON.parse(msg);
            //alert(msg);
            data = msg.data;
            var count = 0;
            data.forEach(function(item, i, data) {
                descr = item.descr;
                title = item.title;
                latitude = item.latitude;
                longitude = item.longitude;
                id = item.id;
                url = item.url;
                var marker = L.marker([latitude, longitude]).addTo(mymap);
                marker.bindPopup(descr + "<br><a href=" + url + ">Ссылка</href>");//.openPopup();
                
                // генерируем табы
            
                var tab = "<div class='btn rounded tab_field border' onclick='marker.openPopup();' name='tab" +id+ "'>" +
                        "<button type='button' class='btn btn-primary btn-lg btn-block'>" +title+ "</button>" +
                        "<p class='btn btn-default btn-lg btn-block'>" +
                                descr +
                            "<br><a href='"+url +"'>Ссылка</a>" +
                        "</p>"
                    "</div>";
                $('#tab_id').append(tab);
                
                count++;
            });
            //alert(count);
            // очистим таб
            //.$('#tab_id').html('');

            alert("ok");
        }
        else
            alert("error");
      })
      .fail(function (jqXHR, exception) {
          alert(exception);
      });
}