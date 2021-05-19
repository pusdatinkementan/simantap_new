<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 300px;
  overflow: hidden;
}
</style>

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create map instance
var chart = am4core.create("chartdiv", am4maps.MapChart);

// Set map definition
chart.geodata = am4geodata_indonesiaLow;

// Set projection
chart.projection = new am4maps.projections.Miller();

// Create map polygon series
var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());

// Exclude Antartica
polygonSeries.exclude = ["AQ"];

// Make map load polygon (like country names) data from GeoJSON
polygonSeries.useGeodata = true;

// Configure series
var polygonTemplate = polygonSeries.mapPolygons.template;
polygonTemplate.tooltipText = "{name}";
polygonTemplate.polygon.fillOpacity = 0.6;


// Create hover state and set alternative fill color
var hs = polygonTemplate.states.create("hover");
hs.properties.fill = chart.colors.getIndex(0);

// Add image series
var imageSeries = chart.series.push(new am4maps.MapImageSeries());
imageSeries.mapImages.template.propertyFields.longitude = "longitude";
imageSeries.mapImages.template.propertyFields.latitude = "latitude";
imageSeries.mapImages.template.tooltipText = "{title}";
imageSeries.mapImages.template.propertyFields.url = "url";

var circle = imageSeries.mapImages.template.createChild(am4core.Circle);
circle.radius = 3;
circle.propertyFields.fill = "color";

var circle2 = imageSeries.mapImages.template.createChild(am4core.Circle);
circle2.radius = 3;
circle2.propertyFields.fill = "color";


circle2.events.on("inited", function(event){
  animateBullet(event.target);
})


function animateBullet(circle) {
    var animation = circle.animate([{ property: "scale", from: 1, to: 5 }, { property: "opacity", from: 1, to: 0 }], 1000, am4core.ease.circleOut);
    animation.events.on("animationended", function(event){
      animateBullet(event.target.object);
    })
}

var colorSet = new am4core.ColorSet();

imageSeries.data = [ {
  "title": "BPP Jombang",
  "latitude": -6.2893272,
  "longitude": 106.6944967,
  "color":colorSet.next()
},
{
  "title": "BPP Ragunan",
  "latitude": -6.2956309,
  "longitude": 106.8160762,
  "color":colorSet.next()
},
{
  "title": "BPPK Lembang",
  "latitude": -6.5130159,
  "longitude": 106.8843142,
  "color":colorSet.next()
},
{
  "title": "BPP Rantau Pauh",
  "latitude": 4.302686,
  "longitude": 98.0829409,
  "color":colorSet.next()
}
];

// Zoom control
chart.zoomControl = new am4maps.ZoomControl();

var homeButton = new am4core.Button();
homeButton.events.on("hit", function() {
//   polygonSeries.show();
//   countrySeries.hide();
  chart.goHome();
});

homeButton.icon = new am4core.Sprite();
homeButton.padding(7, 5, 7, 5);
homeButton.width = 30;
homeButton.icon.path = "M16,8 L14,8 L14,16 L10,16 L10,10 L6,10 L6,16 L2,16 L2,8 L0,8 L8,0 L16,8 Z M16,8";
homeButton.marginBottom = 10;
homeButton.parent = chart.zoomControl;
homeButton.insertBefore(chart.zoomControl.plusButton);

}); // end am4core.ready()

</script>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
    <!-- Map -->
	<div class="col-xs-12 col-md-12 col-lg-12 mb-4">
		<div class="panel panel-primary">
			  <div class="panel-heading">Sebaran BPP </div>
			  <div class="panel-body">
					<div id="chartdiv"></div>
			  </div>
		</div>		   
	</div>

    <?php
    $api = 'https://api.pertanian.go.id/api/simantap/dashboard/list?&api-key=f13914d292b53b10936b7a7d1d6f2406';
    $result = file_get_contents($api, false);
    $json = json_decode($result,true);
    $data = $json[0];
    ?>

    <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                              Jumlah Penyuluh PNS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=number_format($data['jumpenyuluhpns']);?></div>
                                        </div>
                                        <div class="col-auto">
                                        <img src="<?=base_url()?>/assets/img/agriculture.png" width="60"></img>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Jumlah Penyuluh THL APBN</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=number_format($data['jumpenyuluhthlapbn']);?></div>
                                        </div>
                                        <div class="col-auto">
                                        <img src="<?=base_url()?>/assets/img/agriculture.png" width="60"></img>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Penyuluh THL APBD</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=number_format($data['jumpenyuluhthlapbd']);?></div>
                                            <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <img src="<?=base_url()?>/assets/img/agriculture.png" width="60"></img>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                <a href="" target="blank">Jumlah Penyuluh Swadaya</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=number_format($data['jumpenyuluhswadaya']);?></div>
                                        </div>
                                        <div class="col-auto">
                                        <img src="<?=base_url()?>/assets/img/agriculture.png" width="60"></img>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                <a href="" target="blank">Jumlah Penyuluh Swasta</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=number_format($data['jumpenyuluhswasta']);?></div>
                                        </div>
                                        <div class="col-auto">
                                        <img src="<?=base_url()?>/assets/img/agriculture.png" width="60"></img>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                <a href="" target="blank">Jumlah BPP</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=number_format($data['jumbpp']);?></div>
                                        </div>
                                        <div class="col-auto">
                                        <img src="<?=base_url()?>/assets/img/agriculture.png" width="60"></img>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                <a href="" target="blank">Jumlah Poktan</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=number_format($data['jumpoktan']);?></div>
                                        </div>
                                        <div class="col-auto">
                                        <img src="<?=base_url()?>/assets/img/agriculture.png" width="60"></img>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                <a href="" target="blank">Jumlah Gapoktan</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=number_format($data['jumgapoktan']);?></div>
                                        </div>
                                        <div class="col-auto">
                                        <img src="<?=base_url()?>/assets/img/agriculture.png" width="60"></img>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

      

    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 


