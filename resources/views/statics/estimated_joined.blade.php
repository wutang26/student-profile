<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Students Dashboard</title>

<style>
/* =========================
   ROOT DESIGN SYSTEM
========================= */
:root{
    --primary:#2563eb;
    --primary-dark:#1d4ed8;
    --accent:#06b6d4;
    --bg:#f1f5f9;
    --card:#ffffff;
    --text:#1f2937;
    --muted:#64748b;
    --shadow:0 10px 25px rgba(0,0,0,0.06);
}

/* =========================
   GLOBAL
========================= */
body{
    margin:0;
    font-family:'Segoe UI', sans-serif;
    background: var(--bg);
    color: var(--text);
}

/* =========================
   CONTAINER
========================= */
.container{
    max-width:1150px;
    margin:auto;
    padding:30px;
}

/* =========================
   HEADER
========================= */
.title{
    font-size:28px;
    font-weight:800;
}

.subtitle{
    font-size:13px;
    color:var(--muted);
    margin-bottom:25px;
}

/* =========================
   TOTAL CARD
========================= */
.total{
    background: linear-gradient(135deg, var(--primary), var(--accent));
    color:white;
    padding:20px;
    border-radius:16px;
    font-weight:700;
    display:flex;
    justify-content:space-between;
    box-shadow:0 12px 30px rgba(37,99,235,0.25);
    margin-bottom:25px;
}

/* =========================
   GRID
========================= */
.grid{
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap:18px;
    margin-bottom:25px;
}

/* =========================
   CARD (MODERN GLASS STYLE)
========================= */
.card{
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(8px);
    border:1px solid rgba(226,232,240,0.8);
    border-radius:16px;
    padding:20px;
    text-align:center;
    box-shadow: var(--shadow);
    transition:0.25s;
    position:relative;
}

.card:hover{
    transform:translateY(-5px);
    box-shadow:0 18px 40px rgba(0,0,0,0.12);
}

.card::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:3px;
    background: linear-gradient(90deg, var(--primary), var(--accent));
    border-radius:16px 16px 0 0;
}

/* =========================
   TEXT INSIDE CARD
========================= */
.company{
    font-size:12px;
    color:var(--muted);
    font-weight:700;
    margin-bottom:8px;
}

.count{
    font-size:32px;
    font-weight:900;
    color:var(--primary-dark);
}

/* =========================
   CHART BOX
========================= */
.chart-box{
    background: var(--card);
    border-radius:16px;
    padding:20px;
    box-shadow: var(--shadow);
}

/* =========================
   RESPONSIVE
========================= */
@media(max-width:900px){
    .grid{grid-template-columns: repeat(2,1fr);}
}

@media(max-width:500px){
    .grid{grid-template-columns:1fr;}
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
            text: 'Student Documents'
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
        name: 'Students Cases',
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