$start_year=2000; 

$end_year=2020;  
function post_value(mm,dt,yy){

opener.document.f1.p_name.value = mm + "/" + dt + "/" + yy;



self.close();
}
function reload(form){

var month_val=document.getElementById('month').value; 

var year_val=document.getElementById('year').value;      

self.location='cal2.php?month=' + month_val + '&year=' + year_val ; 

}
@$month=$_GET['month'];

@$year=$_GET['year'];
if(!($month <13 and $month >0)){
$month =date("m");  
}

if(!($year <=$end_year and $year >=$start_year)){
$year =date("Y");  
}
$no_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$j= date('w',mktime(0,0,0,$month,1,$year)); 
echo $j;// Sunday=0 , Saturday =6
$j=$j-1;  
if($j<0){$j=6;}  
//echo "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr><tr>";
echo "<tr><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th></tr><tr>";
$adj=str_repeat("<td bgcolor='#ffff00'>*&nbsp;</td>",$j);  
$blank_at_end=42-$j-$no_of_days; 
if($blank_at_end >= 7){$blank_at_end = $blank_at_end - 7 ;} 
$adj2=str_repeat("<td bgcolor='#ffff00'>*&nbsp;</td>",$blank_at_end); 
<select name=month value='' onchange="reload(this.form)" id="month">
<option value=''>Select Month</option>";
for($p=1;$p<=12;$p++){

$dateObject   = DateTime::createFromFormat('!m', $p);
$monthName = $dateObject->format('F');
if($month==$p){
echo "<option value=$p selected>$monthName</option>";
}else{
echo "<option value=$p>$monthName</option>";
}
}
echo "</select>
<select name=year value='' onchange="reload(this.form)" id="year">Select Year</option>
";
for($i=$start_year;$i<=$end_year;$i++){
if($year==$i){
echo "<option value='$i' selected>$i</option>";
}else{
echo "<option value='$i'>$i</option>";
}
}
echo "</select>
echo " </td><td align='center'><a href=# onClick='self.close();'>X</a></td></tr><tr>";
echo "<th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr><tr>";
for($i=1;$i<=$no_of_days;$i++){
$pv="'$month'".","."'$i'".","."'$year'";
echo $adj."<td><a href='#' onclick="post_value($pv);">$i</a>"; 
echo " </td>";
$adj='';
$j ++;
if($j==7){echo "</tr><tr>"; 
$j=0;}
}
$pv="'$month'".","."'$i'".","."'$year'";
echo $adj."<td><a href='#' onclick="post_value($pv);">$i</a>"; 