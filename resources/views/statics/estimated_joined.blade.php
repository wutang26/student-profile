<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Students Dashboard</title>

<style>
/* ===== GLOBAL ===== */
body{
    margin:0;
    font-family: 'Segoe UI', Tahoma, sans-serif;
    background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
    color:#1f2937;
}

/* ===== CONTAINER ===== */
.container{
    max-width:1150px;
    margin:auto;
    padding:30px;
}

/* ===== HEADER ===== */
.title{
    font-size:30px;
    font-weight:800;
    letter-spacing:-0.5px;
}

.subtitle{
    font-size:13px;
    color:#64748b;
    margin-top:4px;
    margin-bottom:25px;
}

/* ===== TOTAL CARD ===== */
.total{
    background: linear-gradient(135deg, #2563eb, #06b6d4);
    color:white;
    padding:22px 25px;
    border-radius:18px;
    font-size:18px;
    font-weight:700;
    margin-bottom:25px;
    box-shadow:0 12px 30px rgba(37,99,235,0.25);
    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* ===== GRID ===== */
.grid{
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap:18px;
    margin-bottom:25px;
}

/* ===== CARDS ===== */
.card{
    background: rgba(255,255,255,0.9);
    border:1px solid rgba(226,232,240,0.8);
    border-radius:18px;
    padding:22px;
    text-align:center;
    box-shadow:0 8px 20px rgba(0,0,0,0.05);
    transition:0.25s ease;
    position:relative;
    overflow:hidden;
}

.card::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:4px;
    background: linear-gradient(90deg, #3b82f6, #06b6d4);
}

.card:hover{
    transform: translateY(-6px);
    box-shadow:0 15px 35px rgba(0,0,0,0.10);
}

/* COMPANY */
.company{
    font-size:13px;
    font-weight:700;
    color:#64748b;
    margin-bottom:10px;
    letter-spacing:0.5px;
}

/* COUNT */
.count{
    font-size:34px;
    font-weight:900;
    color:#1d4ed8;
}

/* ===== CHART ===== */
.chart-box{
    background:#fff;
    border-radius:18px;
    padding:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.06);
}

/* ===== RESPONSIVE ===== */
@media(max-width:900px){
    .grid{grid-template-columns: repeat(2,1fr);}
}

@media(max-width:500px){
    .grid{grid-template-columns: 1fr;}
}
</style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="title">Students Analytics Dashboard</div>
    <div class="subtitle">TPS Moshi • Real-time Data Overview</div>

    <!-- TOTAL -->
    <div class="total">
        <span>Total Students</span>
        <span>{{ $totalStudents }}</span>
    </div>

    <!-- CARDS -->
    <div class="grid">

        <div class="card">
            <div class="company">HQ-Coy</div>
            <div class="count">{{ $hq }}</div>
        </div>

        <div class="card">
            <div class="company">A-COY</div>
            <div class="count">{{ $aCoy }}</div>
        </div>

        <div class="card">
            <div class="company">B-COY</div>
            <div class="count">{{ $bCoy }}</div>
        </div>

        <div class="card">
            <div class="company">C-COY</div>
            <div class="count">{{ $cCoy }}</div>
        </div>

    </div>

    <!-- CHART -->
    <div class="chart-box">
        <div id="container"></div>
    </div>

</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
Highcharts.chart('container', {
    chart: {
        type: 'column',
        backgroundColor: 'transparent'
    },

    title: {
        text: 'Student Documents Overview'
    },

    xAxis: {
        categories: @json($categories)
    },

    yAxis: {
        min: 0,
        title: {
            text: 'Total Documents'
        }
    },

    plotOptions: {
        column: {
            borderRadius: 6,
            dataLabels: {
                enabled: true
            }
        }
    },

    series: [{
        name: 'Documents',
        data: [
            { y: @json($chartData[0]), color: '#ef4444' }, // Warning
            { y: @json($chartData[1]), color: '#8b5cf6' }, // Transfer
            { y: @json($chartData[2]), color: '#14b8a6' }, // Medical
            { y: @json($chartData[3]), color: '#1d4ed8' }, // Discipline
            { y: @json($chartData[4]), color: '#22c55e' }, // Safari
            { y: @json($chartData[5]), color: '#f59e0b' }  // Letter
        ]
    }]
});
</script>

</body>
</html>