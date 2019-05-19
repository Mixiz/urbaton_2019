<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="http://code.jquery.com/jquery-1.8.3.js" type="text/javascript"></script>
        <script src="js/exchange_data.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/main_style.css">
        
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
            integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
            crossorigin=""/>
        <!-- Make sure you put this AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
            integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
            crossorigin="">
        </script>
        
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    </head>
    <body>
        <div class="main" align="center">
            <div class="header">
                <p>MyEvent</p>
                <p>Мероприятия, события, мастер-классы</p>
            </div>
            <div class="row">
                <div class="filter">
                    <h1>Фильтры</h1>
                    <form id="form_id">
                      <p><input type="submit" value="Обновить" id="submit_btn"></p>
                      <p><b>Даты</b></p>
                       <input type="text" name="daterange" value="05/18/2019 - 05/25/2019" />
                     <p><b>Категории</b></p>
                     <p align="left" class="filter-fields" id="filter_fields">
                       <!--<input type="checkbox" name="category[]" value="excursion" checked>Экскурсии<Br>
                       <input type="checkbox" name="category[]" value="master_class" checked>Мастер-классы<Br>
                       <input type="checkbox" name="category[]" value="festival" checked>Фестивали<Br> -->
                     </p>
                    </form>
                </div>
                <div class="map">
                    <h1>Карта</h1>
                    <div id="mapid"></div>
                </div>
                <div class="tab">
                    <h1>Мероприятия</h1>
                    <div id="tab_id" class="scrollable">
                        <!--<div class="btn rounded tab_field border-2">
                            <button type="button" class="btn btn-primary btn-lg btn-block">Заголовок</button>
                            <p class="btn btn-default btn-lg btn-block">
                                Описание 
                                <br><a href="google.com">Ссылка</a>
                            </p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
