<!DOCTYPE html>

<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <title>jvassessoriatelecom Google Maps</title>
  <style>
    
    #map {
      height: 100%;
    }

    
    html,
    body {
      height: 400px;
      margin: 0;
      padding: 0;
    }
  </style>
</head>

<body>
  <div id="map"></div>

  <script>
    var customLabel = {
      restaurant: {
        label: 'R'
      },
      bar: {
        label: 'B'
      }
    };

    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(-12.937375, -38.333111),
        zoom: 10
      });
      var infoWindow = new google.maps.InfoWindow;

      
      downloadUrl('resultado.php', function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        Array.prototype.forEach.call(markers, function(markerElem) {
          var name = markerElem.getAttribute('name');
          var address = markerElem.getAttribute('address');
          var type = markerElem.getAttribute('type');
          var teste = markerElem.getAttribute('teste');
          var point = new google.maps.LatLng(
            parseFloat(markerElem.getAttribute('lat')),
            parseFloat(markerElem.getAttribute('lng')));

          var infowincontent = document.createElement('div');
          var strong = document.createElement('strong');
          strong.textContent = name
          infowincontent.appendChild(strong);
          infowincontent.appendChild(document.createElement('br'));

          var strong = document.createElement('strong');
          strong.textContent = type
          infowincontent.appendChild(strong);
          infowincontent.appendChild(document.createElement('br'));

          var strong = document.createElement('strong');
          strong.textContent = teste
          infowincontent.appendChild(strong);
          infowincontent.appendChild(document.createElement('br'));

          var text = document.createElement('text');
          text.textContent = address
          infowincontent.appendChild(text);
          var icon = customLabel[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            label: icon.label
          });
          marker.addListener('click', function() {
            infoWindow.setContent(infowincontent);
            infoWindow.open(map, marker);
          });
        });
      });
    }



    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap">
  </script>
  <div class="btn-group" role="group" aria-label="Basic outlined example">
    <a button type="button" class="btn btn-outline-warning" href="cadastrar.php">Cadastrar</a></button>
    <a button type="button" class="btn btn-outline-warning active" href="index.php">Maps</a></button>
    <a button type="button" class="btn btn-outline-warning" href="list.php">Listar</a></button>
  </div>

  <div class="btn-groupa" role="group" aria-label="Basic outlined example">

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script type="text/javascript" src="js/javascriptpersonalizado.js"></script>


    <form method="POST" id="form-pesquisa" action="">
      Pesquisar: <input type="text" name="pesquisa" id="pesquisa" placeholder="Qual cliente está procurando?" size="30">

    </form>

    <ul class="resultado">

    </ul>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>