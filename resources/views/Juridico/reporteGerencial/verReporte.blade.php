@extends('juridico.juridico')

@section('librerias')
	<!-- Librerias para reportes -->
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/d3/3.2.2/d3.v3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uvCharts/1.1.5/uvcharts.min.js"></script>
  
@endsection

@section('content')
<div class="col-md-6">
</div>
<div class="col-md-6">
	<div id="uv-div" class="col-md-12"></div>
</div>

	
<script>
var graphdef = {
	categories : ['uvCharts', 'matisse', 'bot-bot', 'SocialByWay'],
	dataset : {
		'uvCharts' : [
			{ name : '2009', value : 32 },
			{ name : '2010', value : 60 },
			{ name : '2011', value : 97 },
			{ name : '2012', value : 560 },
			{ name : '2013', value : 999 }
		],
		
		'matisse' : [
			{ name : '2009', value : 58 },
			{ name : '2010', value : 75 },
			{ name : '2011', value : 90 },
			{ name : '2012', value : 740 },
			{ name : '2013', value : 890 }		
		],
		
		'bot-bot' : [
			{ name : '2009', value : 43 },
			{ name : '2010', value : 88 },
			{ name : '2011', value : 100 },
			{ name : '2012', value : 420 },
			{ name : '2013', value : 769 }	
		],
		
		'SocialByWay' : [
			{ name : '2009', value : 88 },
			{ name : '2010', value : 120 },
			{ name : '2011', value : 157 },
			{ name : '2012', value : 450 },
			{ name : '2013', value : 1024 }	
		],
		
		'WaveMaker' : [
			{ name : '2009', value : 32 },
			{ name : '2010', value : 60 },
			{ name : '2011', value : 97 },
			{ name : '2012', value : 560 },
			{ name : '2013', value : 999 }	
		]
	}
}

var chart = uv.chart ('Bar', graphdef, {
	meta : {
		caption : 'Usage over years',
		subcaption : 'among Imaginea OS products',
		hlabel : 'Years',
		vlabel : 'Number of users',
		vsublabel : 'in thousands'
	}
})

var graphdef_bar = {
	categories : ['uvCharts'],
	dataset : {
		'uvCharts' : [
			{ name : '2009', value : 32 },
			{ name : '2010', value : 60 },
			{ name : '2011', value : 97 },
			{ name : '2012', value : 560 },
			{ name : '2013', value : 150 }
		]
	}
}

var chart = uv.chart ('Bar', graphdef_bar, {
	meta : {
		caption : 'Usage over años',
		subcaption : 'among Imaginea OS products',
		hlabel : 'Years',
		vlabel : 'Number of users',
		vsublabel : 'in thousands'
	}
})

var chart = uv.chart ('line', graphdef	, {
	meta : {
		caption : 'Usage over years',
		subcaption : 'among Imaginea OS products',
		hlabel : 'Years',
		vlabel : 'Number of users',
		vsublabel : 'in thousands'
	}
})
console.log(uv);

var chart = uv.chart ('line', graphdef	, {
	meta : {
		caption : 'Usage over years',
		subcaption : 'among Imaginea OS products',
		hlabel : 'Years',
		vlabel : 'Number of users',
		vsublabel : 'in thousands'
	}
})
console.log(uv);

</script>






@endsection