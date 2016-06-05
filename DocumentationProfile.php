<?php
function get_province_id($province)
{
$province_id = "0";
if($province == "Eastern Cape")
{
$province_id = "05";
}
if($province =="Free State")
{
$province_id = "03";
}
if($province == "Gauteng")
{
$province_id = "06";
}
if($province =="KwaZulu-Natal")
{
$province_id = "02";
}
if($province =="Limpopo")
{
$province_id = "09";
}
if($province =="Mpumalanga")
{
$province_id = "07";
}
if($province == "North West")
{
$province_id = "10";
}
if($province =="Northern Cape")
{
$province_id = "08";
}
if($province == "Western Cape")
{
$province_id = "11";
}

return $province_id;
}
class DocumentationProfile
{
	protected  $provinceName_;
	protected  $provinceID_;
	protected  $year_;
	protected  $district_;
	protected  $local_;
	protected  $isCountry_;
	protected  $server_;
	protected  $userName_;
	protected  $database_;
	protected  $password_;	
	protected  $tableName_;
	protected  $port_;
	protected  $query_;
	protected  $db_connection_;	
	protected $infoArray_;
	protected $barChartYesArray_;
	protected $barChartNoArray_;
	protected $barChartNotSelectedArray_;
	protected $pieChartArray_;
	protected $chartArray_;
	protected $mapDataArray_;
	protected $currentURL_;
	
	public function getMapDataArray()
	{
		return $this->mapDataArray_;
	}
	public function getBarChartYesArray()
	{
		return $this->barChartYesArray_;
	}
	public function getBarChartNoArray()
	{
		return $this->barChartNoArray_;
	}
	public function getBarChartNotSelectedArray()
	{
		return $this->barChartNotSelectedArray_;
	}
	public function getPieChartArray()
	{
		return $this->mapDataArray_;
	}
	public function getChartArray()
	{
		return $this->chartArray_;
	}
	public function getinfoArray()
	{
		return $this->infoArray_;
	}
	public function getCurrentURL()
	{
		return $this->currentURL_;
	}
	
	public function executeQuery($DocNeed)
	{
		$defaultMinimum = 10000000000;
        $defaultMaximum = 0;
        $defaultAverage = 0;
		
		$this->db_connection_ = new mysqli($this->server_ , $this->userName_, $this->password_, $this->database_);
		if ($this->db_connection_->connect_error) 
		{
         die("Connection failed: " . $this->db_connection_->connect_error);
        }
		//storing the result of the executed query
        $result =$this->db_connection_->query($this->query_);

//initialize the array to store the processed data
$this->chartArray_ = array();
$this->infoArray_ = array();
$this->barChartYesArray_ = array();
$this->barChartNoArray_ = array();
$this->barChartNotSelectedArray_ = array();
$this->pieChartArray_ = array();
$this->mapDataArray_ = array();


//check if there is any data returned by the SQL Query
if ($result->num_rows > 0) {
	$barChartDataArrayItem = array();
	
	$bcs=0;
	$ids=0;
	$mcs=0;
	$rps=0;
	$dcs=0;
	$pps = 0;
  //Converting the results into an associative array
  while($row = $result->fetch_assoc()) {
    $mapDataArrayItem = array();
	
	if(isset($row['Province'])){
    $mapDataArrayItem['label'] = $row['Province'];
	$mapDataArrayItem['id'] = get_province_id($row['Province']);
	$mapDataArrayItem['value'] = $row['TotalDocNeeds'];
	$mapDataArrayItem['link'] = 'http://localhost/7046/index.php/'.$row['CaptureYear']."/".$row['Province'];
	array_push($this->mapDataArray_, $mapDataArrayItem);
	
	$bcs = $bcs + $row['TotalsBC'];
	$ids = $ids + $row['TotalsID'];
	$mcs = $mcs + $row['TotalsMC'];
	$rps = $rps + $row['TotalsRP'];
	$dcs = $dcs + $row['TotalsDC'];
	$pps = $pps + $row['TotalsPP'];

	if(isset($row['District'])){
    $chartArrayItem['id'] = $row['District'];
	$chartArrayItem['id'] = get_province_id($row['Province']);
	$chartArrayItem['value'] = $row['TotalDocNeeds'];
	$chartArrayItem['link'] = "http://localhost/7046/index.php/".$row['CaptureYear']."/".$row['Province']."/".$row['District'];
	}
	if(isset($row['LocalMunicipality'])){
    $chartArrayItem['id'] = $row['LocalMunicipality'];
	$chartArrayItem['id'] = get_province_id($row['Province']);
	$chartArrayItem['value'] = $row['TotalDocNeeds'];
	$chartArrayItem['link'] = "http://localhost/7046/index.php/".$row['CaptureYear']."/".$row['Province']."/".$row['District']."/".$row['LocalMunicipality'];
	}

	if($defaultMinimum >$row['TotalDocNeeds'])
	{$defaultMinimum = $row['TotalDocNeeds'];}
	if($defaultMaximum <$row['TotalDocNeeds'])
	{$defaultMaximum = $row['TotalDocNeeds'];}
    //append the above created object into the main array.
    //array_push($this->chartArray_, $chartArrayItem);
  }
  
  $defaultAverage = ($defaultMaximum + $defaultMinimum)/2;
  
	}
	  	
	$barChartDataArrayItem['label'] = 'Birth Certs.';
	$barChartDataArrayItem['id'] = 'bcs';
	$barChartDataArrayItem['value'] = $bcs;
	$barChartDataArrayItem['link'] = 'http://localhost/7046/index.php/'.$row['CaptureYear']."/".$row['Province'];
	if($DocNeed="Yes")
	{
	array_push($this->barChartYesArray_, $barChartDataArrayItem);
	}
	if($DocNeed="No")
	{
	array_push($this->barChartNoArray_, $barChartDataArrayItem);
	}
	if($DocNeed="Not Selected")
	{
	array_push($this->barChartNotSelectedArray_, $barChartDataArrayItem);
	}
	$barChartDataArrayItem['label'] = 'IDs';
	$barChartDataArrayItem['id'] = 'ids';
	$barChartDataArrayItem['value'] = $ids;
	$barChartDataArrayItem['link'] = 'http://localhost/7046/index.php/'.$row['CaptureYear']."/".$row['Province'];
	if($DocNeed="Yes")
	{
	array_push($this->barChartYesArray_, $barChartDataArrayItem);
	}
	if($DocNeed="No")
	{
	array_push($this->barChartNoArray_, $barChartDataArrayItem);
	}
	if($DocNeed="Not Selected")
	{
	array_push($this->barChartNotSelectedArray_, $barChartDataArrayItem);
	}
	
	$barChartDataArrayItem['label'] = 'Death Certs.';
	$barChartDataArrayItem['id'] = 'dcs';
	$barChartDataArrayItem['value'] = $dcs;
	$barChartDataArrayItem['link'] = 'http://localhost/7046/index.php/'.$row['CaptureYear']."/".$row['Province'];
	if($DocNeed="Yes")
	{
	array_push($this->barChartYesArray_, $barChartDataArrayItem);
	}
	if($DocNeed="No")
	{
	array_push($this->barChartNoArray_, $barChartDataArrayItem);
	}
	if($DocNeed="Not Selected")
	{
	array_push($this->barChartNotSelectedArray_, $barChartDataArrayItem);
	}
	
	$barChartDataArrayItem['label'] = 'Marriage Certs.';
	$barChartDataArrayItem['id'] = 'mcs';
	$barChartDataArrayItem['value'] = $mcs;
	$barChartDataArrayItem['link'] = 'http://localhost/7046/index.php/'.$row['CaptureYear']."/".$row['Province'];
	if($DocNeed="Yes")
	{
	array_push($this->barChartYesArray_, $barChartDataArrayItem);
	}
	if($DocNeed="No")
	{
	array_push($this->barChartNoArray_, $barChartDataArrayItem);
	}
	if($DocNeed="Not Selected")
	{
	array_push($this->barChartNotSelectedArray_, $barChartDataArrayItem);
	}
	
	$barChartDataArrayItem['label'] = 'Passports';
	$barChartDataArrayItem['id'] = 'pps';
	$barChartDataArrayItem['value'] = $pps;
	$barChartDataArrayItem['link'] = 'http://localhost/7046/index.php/'.$row['CaptureYear']."/".$row['Province'];
	if($DocNeed="Yes")
	{
	array_push($this->barChartYesArray_, $barChartDataArrayItem);
	}
	if($DocNeed="No")
	{
	array_push($this->barChartNoArray_, $barChartDataArrayItem);
	}
	if($DocNeed="Not Selected")
	{
	array_push($this->barChartNotSelectedArray_, $barChartDataArrayItem);
	}
	
	$barChartDataArrayItem['label'] = 'Resident Permts.';
	$barChartDataArrayItem['id'] = 'rps';
	$barChartDataArrayItem['value'] = $rps;
	$barChartDataArrayItem['link'] = 'http://localhost/7046/index.php/'.$row['CaptureYear']."/".$row['Province'];
	if($DocNeed="Yes")
	{
	array_push($this->barChartYesArray_, $barChartDataArrayItem);
	}
	if($DocNeed="No")
	{
	array_push($this->barChartNoArray_, $barChartDataArrayItem);
	}
	if($DocNeed="Not Selected")
	{
	array_push($this->barChartNotSelectedArray_, $barChartDataArrayItem);
	}

}

//Closing the connection to DB
$this->db_connection_->close();

//echo "Minimum: ".$defaultMinimum. " Average: ".$defaultAverage." Maximum: ".$defaultMaximum."<p>";

	  $infoArrayItem['id'] = 'minimum';
	  $infoArrayItem['value'] = $defaultMinimum;
	  array_push($this->infoArray_, $infoArrayItem);
	  $infoArrayItem['id'] = 'maximum';
	  $infoArrayItem['value'] = $defaultMaximum;
	  array_push($this->infoArray_, $infoArrayItem);
	  $infoArrayItem['id'] = 'average';
	  $infoArrayItem['value'] = ($defaultMaximum + $defaultMinimum)/2;
	  array_push($this->infoArray_, $infoArrayItem);



	}
	public function initialize($tmp_filename,$tmp_filePath)
	{
		$this->server_   ="localhost";
		$this->port_   =3306;
		$this->database_ ="waronpoverty";
		$this->userName_ ="test"; 
		$this->password_ ="YPMU7MfTf53BshAB";
        $this->tableName_ ="tbl_7046provincedistrictlocaldocumentationneedssummary";
		
		$this->currentURL_ = "http://localhost/7046/getDocumentationProfile.php";
		//establishing the connection to the db.
       
		//echo 'calling initialize: '.$tmp_filePath;
      $tmp_parameters_all =explode('/', $tmp_filePath);
      $tmp_result_array = array();
      $tmp_result_array_count=false;
      $tmp_counter=0;
     for( $tmp_i = 0; $tmp_i < count($tmp_parameters_all); $tmp_i++){
	if($tmp_result_array_count)
	{
		switch($tmp_counter){
		case 0://year
			$this->year_ = $tmp_parameters_all[$tmp_i];
			$tmp_counter = $tmp_counter+1;
			$this->currentURL_.="/".$this->year_;
	       // echo 'year is set'.$this->year_.'<br/>';
		break;
		case 1://province
		
			$this->provinceName_= $tmp_parameters_all[$tmp_i];
			$tmp_counter = $tmp_counter+1;
			$this->currentURL_.="/".$this->provinceName_;
			//echo 'province is set'.$this->province_.'<br/>';
		break;
		case 2: //district
		
			$this->district_ = $tmp_parameters_all[$tmp_i];
			$tmp_counter = $tmp_counter+1;
			$this->currentURL_.="/".$this->district_;
			//echo 'district is set'.$this->district_.'<br/>';

		break;
		case 3: //local
		
			$this->local_ = $tmp_parameters_all[$tmp_i];
			$tmp_counter = $tmp_counter+1;
			$this->currentURL_.="/".$this->local_;
			//echo 'local is set'.$this->local.'<br/>';

		break;
		default:
		$tmp_counter = $tmp_counter+1;
		//echo 'nothing is set <br/>';
		break;

		}
		
	}
    if($tmp_parameters_all[$tmp_i]==$tmp_filename)
    {$tmp_result_array_count =true;}
}

	}
	public function buildSQLquery($DocNeed)
	{

		if(isset($this->year_) AND isset($this->provinceName_) AND isset($this->district_) AND isset($this->local_))
		{
			$this->query_ = 'SELECT CaptureYear,Province,District,LocalMunicipality,TotalsBC,TotalsDC,TotalsPP,TotalsRP,TotalsMC,TotalsID,TotalDocNeeds
		    FROM `'.$this->tableName_.'`
		    WHERE DocNeed = "'.$DocNeed.'"
			AND CaptureYear ='.$this->year_.'
			AND Province ="'.$this->provinceName_.'"
			AND District ="'.$this->district_.'"
			AND LocalMunicipality ="'.$this->local_.'"
		   GROUP BY Province,District,LocalMunicipality
            ORDER BY  1,2,3,4 ASC';
			
			//echo 'query for year, prov, distr and local'.$this->query_.'<br/>';
		}
		else if(isset($this->year_) AND isset($this->provinceName_) AND isset($this->district_))
		{
			
			$this->query_ = 'SELECT CaptureYear,Province,District,LocalMunicipality,TotalsBC,TotalsDC,TotalsPP,TotalsRP,TotalsMC,TotalsID,TotalDocNeeds
		    FROM `'.$this->tableName_.'`
		    WHERE DocNeed = "'.$DocNeed.'"
			AND CaptureYear ='.$this->year_.'
			AND Province ="'.$this->provinceName_.'"
			AND District ="'.$this->district_.'"
			GROUP BY Province,District,LocalMunicipality
            ORDER BY  1,2,3,4 ASC';
			
			//echo 'query for year, prov, distr'.$this->query_.'<br/>';
		}
		else if(isset($this->year_) AND isset($this->provinceName_))
		{
			$this->query_ = 'SELECT CaptureYear,Province,District,TotalsBC,TotalsDC,TotalsPP,TotalsRP,TotalsMC,TotalsID,TotalDocNeeds
		    FROM `'.$this->tableName_.'`
		    WHERE DocNeed = "Yes"
			AND CaptureYear ='.$this->year_.'
			AND Province ="'.$this->provinceName_.'"
			GROUP BY  Province,District
            ORDER BY  1,2,3 ASC';
		
		//echo 'query for year, prov <br/>'.$this->query_.'<br/>';
		}
		else if(isset($this->year_))
		{
			$this->query_ = 'SELECT CaptureYear,Province,TotalsBC,TotalsDC,TotalsPP,TotalsRP,TotalsMC,TotalsID,TotalDocNeeds
		    FROM `'.$this->tableName_.'`
		    WHERE DocNeed = "'.$DocNeed.'"
			AND CaptureYear ='.$this->year_.'
			GROUP BY Province
            ORDER BY  1,2 ASC';
			//echo 'query for year'.$this->query_.'<br/>';
		}
		else
		{
		$this->query_ = 'SELECT  CaptureYear,Province,TotalsBC,TotalsDC,TotalsPP,TotalsRP,TotalsMC,TotalsID,TotalDocNeeds
		FROM `'.$this->tableName_.'`
		WHERE DocNeed = "'.$DocNeed.'"
		GROUP BY Province
        ORDER BY  1,2 ASC';
		 //echo 'query for all'.$this->query_.'<br/>';
		}
	}
	public function printClass()
	{
		//echo 'calling print function';
		if(isset($this->provinceName_))
{
echo 'province='.$this->provinceName_.'<br/>';
}
if(isset($this->year_))
{
echo 'year='.$this->year_.'<br/>';
}
if(isset($this->district_))
{
echo 'district='.$this->district_.'<br/>';
}
if(isset($this->local_))
{
echo 'local='.$this->local_.'<br/>';
}
	}
}
