<?php
$title = "Social Barometer";
?>
<!doctype html>
<html>
<head>
<style>
#needs{
	width:800px;
	border:medium:red;
	height:250px;
    float:left;
    padding:10px;
}
#haves{
	width:800px;
	height:250px;
    float:left;
    padding:10px;
}
#header {
	 background-color:green;
    color:white;
    text-align:center;
    padding:5px;
}
#nav {
	line-height:30px;
    background-color:#eeeeee;
    height:550px;
    width:100px;
    float:left;
    padding:5px;
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #111;
}
</style>
<meta charset="utf-8">
<title><?php echo $title;?></title>

<script type="text/javascript" src="/fusioncharts/fusioncharts.js"></script>
<script type="text/javascript" src="/fusioncharts/themes/fusioncharts.theme.fint.js"></script>
<script type="text/javascript">
  FusionCharts.ready(function(){
    var revenueChart = new FusionCharts({
        "type": "column2d",
        "renderAt": "chartContainer",
        "width": "500",
        "height": "300",
        "dataFormat": "json",
        "dataSource":  {
          "chart": {
            "caption": "Monthly revenue for last year",
            "subCaption": "Harry's SuperMart",
            "xAxisName": "Month",
            "yAxisName": "Revenues (In USD)",
            "theme": "fint"
         },
         "data": [
            {
               "label": "Jan",
               "value": "420000"
            },
            {
               "label": "Feb",
               "value": "810000"
            },
            {
               "label": "Mar",
               "value": "720000"
            },
            {
               "label": "Apr",
               "value": "550000"
            },
            {
               "label": "May",
               "value": "910000"
            },
            {
               "label": "Jun",
               "value": "510000"
            },
            {
               "label": "Jul",
               "value": "680000"
            },
            {
               "label": "Aug",
               "value": "620000"
            },
            {
               "label": "Sep",
               "value": "610000"
            },
            {
               "label": "Oct",
               "value": "490000"
            },
            {
               "label": "Nov",
               "value": "900000"
            },
            {
               "label": "Dec",
               "value": "730000"
            }
          ]
      }

  });
revenueChart.render();
})
</script>

</head>
<body>
<div id="header"><h1><strong>
  <header>	<?php echo $title;?> </header>
</strong></h1></div>

<div><ul>
		<li><a id="css3menu1" class="topmenu" href="#All">ALL</a></li>
        <li><a id="css3menu2" class="topmenu" href="#SubCategory1">SubCategory 1</a></li>
        <li><a id="css3menu3" class="topmenu" href="#SubCategory2">SubCategory 2</a></li>
        <li><a id="css3menu4" class="topmenu" href="#SubCategory3">SubCategory 3</a></li>
        <li><a id="css3menu5" class="topmenu" href="#SubCategory4">SubCategory 4</a></li>
      </ul></div>
      
<div id="nav">
  <p><a href="#Document">Document</a></p>
  <p><br>
  <a href="#Social">Social</a></p>
  <p><br>
    <a href="#Education">Education</a></p>
  <p><br>
  <a href="#Health">Health</a></p>
  <p><br>
    <a href="#Food">Food</a><br>
  </p>
  </div>
<div id="chartContainer">FusionCharts XT will load here!</div>
<div id="chartContainer"><p>Needs</p><br></div>




</body>
</html>