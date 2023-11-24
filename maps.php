<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metadata -->
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="DIVSIG UGM">
    <meta name="description" content="leaflet basic">

    <!-- Judul pada tab browser -->
    <title>Location</title>

    <!-- Leaflet CSS Library -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css">

    <!-- Tab browser icon -->
    <link rel="icon" type="image/x-icon" href="http://luk.staff.ugm.ac.id/logo/UGM/Resmi/Warna.gif">


    <style>
        /* Tampilan peta fullscreen */
        #map {
            height: 500px;
            margin-bottom: 20px;
            color: white;
            text-align: center;
            margin-left: 200px;
            margin-right: 200px;
            animation: fadeInMap 5s ease-in-out forwards
        }

        body {
            background-image: url(foto/forest.jpg);
            color: white;
            text-align: center;
        }

        header {
            padding: 2em;
          
            padding: 70px 0;
            text-align: center;
            color: #ffffff;
     
     
      font-family: 'Courier New', Courier, monospace;
            
        }

        section {
            padding: 40px 0;
        }

        .card {
            margin-bottom: 20px;
            border-radius: 10px;
            /* Sudut border card */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-title.text-white,
        .card-text.text-white {
            color: white !important;
        }

        footer {
            color: white;
        }

        form {
            margin: 0 auto;
            width: 50%;
        }

        label {
            color: white;
        }

        input {
            margin-bottom: 10px;
        }

        #informasi {
            color: white;
        }

        .custom-btn {
            background-color: white;
            color: black;
            border: 1px solid black;
            /* Optional: add a border to make it visually distinct */
        }
        .nav-link {
        color: white; /* Set the color to white */
         /* Animasi fade-in */
    @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .fade-in {
            animation: fadeIn 2s ease-in-out; /* Sesuaikan durasi dan fungsi waktu animasi sesuai kebutuhan Anda */
        }
    </style>
</head>

<body>
<!-- Map Container -->

    <div class="container">

        <!-- Header Section -->
        
        <header>
        <div class="inner2 fade-in">
          <nav class="nav nav-masthead justify-content-center">
              <a class="nav-link active" href="index.html">Home</a>
              <a class="nav-link" href="legend.html">Legend's</a>
              <a class="nav-link" href="maps.php">Maps</a>
              <a class="nav-link" href="#">Info</a>
          </nav>
      </div>

            <h1>Location's Guide</h1>
            
            <p>A digital portal inviting you to explore the timeless allure of myths and folk tales <br>that have shaped
                societies and inspired imaginations throughout history.<br> Enjoy your fantasy journey!</p>
        </header>
        
        <!-- Map Container -->
        <div id="map" class="fade-in"></div>
    </div>

    <!-- Leaflet JavaScript Library -->
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>

    <div id="map"></div>
    <script>
        //* Initial Map */ (note: sesuaikan setView koordinat dan zoom level ke titik tengah lembar peta) 
        var map = L.map('map').setView([-2.60871423, 112.77995568], 5); //lat, long, zoom

        //* Tile Basemap */ (note: pilihan basemap diakses pada https://leaflet-extras.github.io/leaflet-providers/preview/) 
        var basemap1 = L.tileLayer('https://tile.openstreetmap.de/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        var basemap2 = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}{r}.{ext}', {
            minZoom: 0,
            maxZoom: 20,
            attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            ext: 'png'
        });

        var basemap3 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri | <a href="Lathan WebGIS" target="_blank">DIVSIG UGM</a>'
        });

        var basemap4 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/NatGeo_World_Map/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; National Geographic, Esri, DeLorme, NAVTEQ, UNEP-WCMC, USGS, NASA, ESA, METI, NRCAN, GEBCO, NOAA, iPC',
            maxZoom: 16
        });

        basemap2.addTo(map);

        /* Control Layer */
        var baseMaps = {
            "OpenStreetMap": basemap1,
            "Stadia_AlidadeSmooth ": basemap2,
            "Esri Imagery": basemap3,
            "Esri.NatGeoWorldMap": basemap4
        };

        // /* Layer Marker */ 
        /* // var marker1 = L.marker([-7.7829218, 110.3670757], { draggable: true });
        // marker1.addTo(map);
        // marker1.bindPopup("Tugu Jogja");


        // var marker2 = L.marker([-7.80969656, 110.36343965]);
        // marker2.addTo(map);
        // marker2.bindPopup("Keraton Ngayogyakarta Hadiningrat"); */



        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "pgweb-acara8";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM lokasi";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $latitude = $row["latitude"];
                $longitude = $row["longitude"];
                $nama_lokasi = $row["nama_lokasi"];
                echo "L.marker([$latitude, $longitude]).addTo(map).bindPopup('$nama_lokasi');";
            }
        }
        ?>



       
        L.control.layers(baseMaps).addTo(map);

        /* Scale Bar */
        L.control.scale({
            maxWidth: 150,
            position: 'bottomright'
        }).addTo(map);

        //Image watermark//
        L.Control.Watermark = L.Control.extend({
            onAdd: function (map) {
                var img = L.DomUtil.create('img');
                img.src = 'assets/img/logo/SIG.png';
                img.style.width = '170px';
                return img;
            }
        });

        L.control.Watermark = function (opts) {
            return new L.Control.Watermark(opts);
        }
        L.control.Watermark({ position: 'bottomleft' }).addTo(map);

        /* //legenda
        L.Control.Legend = L.Control.extend({
            onAdd: function (map) {
                var img = L.DomUtil.create('img');
                img.src = 'assets/img/legend/legenda.jpeg';
                img.style.width = '250px';
                return img;
            }
        });

        L.control.Legend = function (opts) {
            return new L.Control.Legend(opts);
        }

        L.control.Legend({ position: 'bottomleft' }).addTo(map); */



    </script>


</body>

</html>