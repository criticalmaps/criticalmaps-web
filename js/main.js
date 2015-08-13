require.config({
  baseUrl:"/js/",
  paths : {
    jquery : [
      "vendor/jquery"
    ],
    leaflet : [
      "vendor/leaflet-src"
    ]
  }
});

require(["app/app"]);

