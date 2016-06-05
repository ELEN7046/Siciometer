<?php
include("DocumentationProfile.php");
$docObject = new DocumentationProfile();
$docObject->initialize("index.php",$_SERVER['REQUEST_URI']);
?>
<html>
<head>
<title>Social Barometer powered by FusionCharts Suite XT</title>
<style>
body {
    margin: 0;
    padding: 0;
    width: 100%;
    background-color: #00406A;
    font-family: Tahoma, Helvetica, Arial, sans-serif;
}
h1, h2, h3, h4, h5 {
    margin: 0;
    padding: 0;
    font-weight: bold;
}
.chartCont {
    padding: 0px 12px;
}
.border-bottom {
    border-bottom: 1px dashed rgba(0, 117, 194, 0.2);
}
.border-right {
    border-right: 1px dashed rgba(0, 117, 194, 0.2);
}
#container {
    width: 1200px;
    margin: 0 auto;
    position: relative;
}
#container> div {
    width: 100%;
    background-color: #ffffff;
}
#logoContainer {
    float: left;
}
#logoContainer img {
    padding: 0 10px;
}
#logoContainer div {
    position: absolute;
    top: 8px;
    left: 95px;
}
#logoContainer div h2 {
    color: #0075c2;
}
#logoContainer div h4 {
    color: #0e948c;
}
#logoContainer div p {
    color: #719146;
    font-size: 12px;
    padding: 5px 0;
}

#userDetail {
    float: right;
}
#userDetail img {
    position: absolute;
    top: 16px;
    right: 130px;
}
#userDetail div {
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 14px;
    font-weight: bold;
    color: #0075c2;
}
#userDetail div p {
    margin: 0;
}
#userDetail div p:nth-child(2) {
    color: #0e948c;
}
#header div:nth-child(3) {
    clear: both;
    border-bottom: 1px solid #0075c2;
}
#content div {
    display: inline-block;
}
#content > div {
    margin: 0px 20px;
}
#content > div:nth-child(1) > div {
    margin: 20px 0 0;
}
#content > div:nth-child(2) > div {
    margin: 0 0 20px;
}
#footer p {
    margin: 0;
    font-size: 9pt;
    color: black;
    padding: 5px 0;
    text-align: center;
}
</style>
  <script type="text/javascript" src="http://localhost/7046/fusioncharts/js/jquery-2.2.4.min.js"></script>
  <script type="text/javascript" src="http://localhost/7046/fusioncharts/js/fusioncharts.js"></script>
  <script type="text/javascript" src="http://localhost/7046/fusioncharts/js/fusioncharts.charts.js"></script>
  <script type="text/javascript" src="http://localhost/7046/fusioncharts/js/themes/fusioncharts.theme.zune.js"></script>
  <script type="text/javascript" src="http://localhost/7046/fusioncharts/js/app.js"></script>
<script type="text/javascript" src="http://localhost/7046/fusioncharts/js/themes/fusioncharts.theme.fint.js"></script>
<script type ="text/javascript" src="http://localhost/7046/fusioncharts/js/menu.js" ></script>
 <!-- <link href="fusioncharts/assets/css/menu.css" type="text/css" rel="stylesheet"> !-->
 
<script type="text/javascript">
FusionCharts.ready(function () {
	
var test =	  $.ajax({
    url: '<?php
	echo $docObject->getCurrentURL();
	?>',
	type: 'GET',
    success : function(data) {
	   mapData = data.mapData;
	   barChartYesData = data.barChartYesData;
	   barChartNoData = data.barChartNoData;
	   barChartNotSelectedData = data.barChartNotSelectedData;
	   pieChartData = data.pieChartData;
	   columnData = data.columnData;
       chartData = data.chartData;
	   infoData = data.infoData;
	   var selection = "";
	    var year = "";
		var minimum = "";
		var maximum = "";
		var average = "";
	    var items = data.infoData.map(function (item) {
			if(item.id == "selection")
			{selection = item.value;}
		   if(item.id == "year")
			{year = item.value;}
			if(item.id == "minimum")
			{minimum = item.value;}
		   if(item.id == "average")
			{average = item.value;}
			if(item.id == "maximum")
			{maximum = item.value;}
		
        return item.id + ': ' + item.value;
      });
	   
      var chartProperties = {
        "caption": "Needs by "+selection+" Sub-Categories",
        "xAxisName": "Province",
        "yAxisName": selection+'',
        "rotatevalues": "1",
        "theme": "zune"
      };
	  var mapProperties = {
                "caption": 'Total '+selection+' Needs by Province',
                "subcaption": year,
                "entityFillHoverColor": "#cccccc",
                "numberScaleValue": "1,1000,1000",
                "numberScaleUnit": ",K,M",
                "numberPrefix": "",
                "showLabels": "1",
                "theme": "zune"
      };
	  
	  
      apiChart = new FusionCharts({
        type: 'column3d',
        renderAt: 'needsChartContainer',
        width: '550',
        height: '350',
        dataFormat: 'json',
        dataSource: {
          "chart": chartProperties,
          "data": columnData
        }
      });
      apiChart.render();
	  
	  
	var needsByProvince = new FusionCharts({
        type: "maps/southafrica",
        renderAt: "needsMapContainer",
        width: "500",
        height: "300",
        dataFormat: "json",
        dataSource:{
            "chart": mapProperties,
            "colorrange": {
                "minvalue": minimum,
                "startlabel": "Low",
                "endlabel": "High",
                "code": "#6baa01",
                "gradient": "1",
                "color": [
                    {
                        "maxvalue": average,
                        "displayvalue": "Average",
                        "code": "#f8bd19"
                    },
                    {
                        "maxvalue": maximum,
                        "code": "#e44a00"
                    }
                ]
            },
            "data": mapData
        }
    }).render();
	  
	 var pieChartByProvince = new FusionCharts({
        "type": "pie3d",
        "renderAt": "pieChartContainer",
        "width": "500",
        "height": "300",
        "dataFormat": "json",
        "dataSource":{
            "chart": {
                "caption": "Total by Province",
                "subcaption": "Last year",
                "entityFillHoverColor": "#cccccc",
                "numberScaleValue": "1,1000,1000",
                "numberScaleUnit": ",K,M",
                "numberPrefix": "",
                "showLabels": "1",
                "theme": "fint"
            },
            "colorrange": {
                "minvalue": minimum,
                "startlabel": "Low",
                "endlabel": "High",
                "code": "#6baa01",
                "gradient": "1",
                "color": [
                    {
                        "maxvalue": average,
                        "displayvalue": "Average",
                        "code": "#f8bd19"
                    },
                    {
                        "maxvalue": maximum,
                        "code": "#e44a00"
                    }
                ]
            },
            "data": pieChartData
        }
    }).render();  
	
	
	
	 var barChart = new FusionCharts({
    type: 'stackedcolumn3d',
    renderAt: 'barChartContainer',
    width: '500',
    height: '300',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": "Needs by Sample Size",
            "subCaption": "For selected year",
            "xAxisname": "Quarter",
            "yAxisName": "",
            "showSum": "1",
            "numberPrefix": "",
            "theme": "fint"
        },

        "categories": [{
            "category": [
			 {
                "label": "Eastern Cape",
				"id":"05"
            }, 
			{
                "label": "Free State",
				"id":"03"
            },
			{
                "label": "Gauteng",
				"id":"06"
            },
			{
                "label": "KwaZulu-Natal",
				"id":"02"
            },{
                "label": "Limpopo",
				"id":"09"
            }, {
                "label": "Mpumalanga",
				"id":"07"
            },
			{
                "label": "Northern Cape",
				"id":"08"
            },
			{
                "label": "North West",
				"id":"10"
            },
			{
                "label": "Western Cape",
				"id":"11"
            }
			]
        }],

        "dataset": [{
            "seriesname": "Needs",
            "data": barChartYesData
        }, {
            "seriesname": "No",
            "data": barChartNoData
        }, {
            "seriesname": "Not Selected",
            "data": barChartNotSelectedData
        }
		]
    }
}).render();
	  
	  
    }
  });
	
	  





});
</script>
</head>
<body>
    <div>
        <a href="menu1.html" class="menulink">All</a>
        <ul class="menu" id="menu1">
            <li><a href="#">Documentation</a></li>
            <li><a href="#">Education</a></li>
            <li><a href="#">Health</a></li>
        </ul>
    </div>
    <div>
        <a href="menu1.html" class="menulink">Documentation</a>
        <ul class="menu" id="menu1">
            <li><a href="#">IDs</a></li>
            <li><a href="#">Birth Certs.</a></li>
            <li><a href="#">Death Certs.</a></li>
            <li><a href="#">Marriage Certs.</a></li>
			<li><a href="#">Passports</a></li>
			<li><a href="#">Resident Permits.</a></li>
        </ul>
    </div>
    <div>
        <a href="menu2.html" class="menulink">Social</a>
        <ul class="menu" id="menu2">
            <li><a href="#">something2</a></li>
            <li><a href="#">nothing2</a></li>
            <li><a href="#">anything2</a></li>
            <li><a href="#">everything2</a></li>
        </ul>
    </div>
    <div>
        <a href="menu3.html" class="menulink">Health</a>
        <ul class="menu" id="menu3">
            <li><a href="#">something3</a></li>
            <li><a href="#">nothing3</a></li>
            <li><a href="#">anything3</a></li>
            <li><a href="#">everything3</a></li>
        </ul>
    </div>
    <div>
        <a href="menu4.html" class="menulink">By Region</a>
        <ul class="menu" id="menu4">
            <li><a href="#">Province</a></li>
            <li><a href="#">District</a></li>
            <li><a href="#">Local Munic</a></li>
        </ul>
    </div>

<div id='container'>
    <div id='header'>
        <div id='logoContainer'>
            <img src="http://static.fusioncharts.com/sampledata/images/Logo-HM-72x72.png" alt='Logo' />
            <div>
                  <h2>Social Barometer</h2>

                  <h4>Los Angeles Topanga</h4>
                    <p>Today: 4th June, 2014</p>

            </div>
        </div>
        <div id='userDetail'>
            <img src="http://static.fusioncharts.com/sampledata/images/user_image.jpg" alt='Logo' />
            <div>
                <p>Welcome John</p>
                <p>Store Manager</p>
            </div>
        </div>
        <div></div>
    </div>
    <div class='border-bottom' id='content'>
      <div class='border-bottom'>
        <div class='chartCont border-right' id='needsMapContainer'>FusionCharts will load here.</div>
        <div class='chartCont' id='pieChartContainer'>FusionCharts will load here.</div>
      </div>
      <div>
        <div class='chartCont border-right' id='needsChartContainer'>FusionCharts will load here.</div>
        <div class='chartCont' id='barChartContainer'>FusionCharts will load here.</div>
      </div>
    </div>
    <div id='footer'>
        <p>This application was built using <a href="http://www.fusioncharts.com" target="_blank" title="FusionCharts - Data to delight... in minutes"><b>FusionCharts Suite XT</b></a>
</p>
    </div>
</div>
</body>
</html>