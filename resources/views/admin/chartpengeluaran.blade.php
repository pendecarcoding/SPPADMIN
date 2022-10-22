<?php
header("Content-type: application/javascript");
$bln=array
(1=>"Januari","Februari","Maret","April",
"Mei","Juni","July","Agustus",
"September","Oktober","November","Desember");

?>

//<?php //some php ;
?>
am4core.useTheme(am4themes_animated);

var chart = am4core.create("chartpengeluaran", am4charts.XYChart);


chart.data = [
<?php
for($bulan=1; $bulan<=12; $bulan++){

	$id           = Session::get('idsekolah');
	$y						= date('Y');
	$pengeluaran   = App\PengeluaranModel::whereYear('tanggal',$y)->whereMonth('tanggal',$bulan)->where('idsekolahkeluar',$id)->sum('nominal');

?>
{
	"country": "<?php print $bln[$bulan]; ?>",
	"visits": "<?php print $pengeluaran; ?>"

},

<?php
}
 ?>
];

chart.padding(40, 40, 40, 40);

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.minGridDistance = 60;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.categoryX = "country";
series.dataFields.valueY = "visits";
series.tooltipText = "{valueY.value}"
series.columns.template.strokeOpacity = 0;

chart.cursor = new am4charts.XYCursor();

// as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
series.columns.template.adapter.add("fill", function (fill, target) {
	return chart.colors.getIndex(target.dataItem.index);
});
