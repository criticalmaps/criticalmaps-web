require.config({
  baseUrl:"/js/",
  paths : {
    jquery : [
      "vendor/jquery-2.1.3"
    ],
    leaflet : [
      "vendor/leaflet-src"
    ]
  }
});

require(["app/app"]);

