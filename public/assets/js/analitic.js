document.addEventListener('DOMContentLoaded', async function() {
    // initialyze Data
    let lineData = {
        "labels" : [],
        "data" : []
    }
    
    let PieData = {
        "labels" : [],
        "data" : []
    }

    let rawData = {}

    if (window.location.pathname == "/analytic") {
        data = await axios.get('http://127.0.0.1:8001/analyze/getwidget')
            // .then(function(response) {
            //     // const posts = response.data;
            //     rawData = response.data;
            //     console.log(rawData)
            // })
            // .catch(function(error) {
            //     console.error('Error:', error);
            // });
        // console.log(data.data)
        rawData = data.data
    }

    const today = new Date();
    const oneMonthAgo = new Date(today);
    oneMonthAgo.setMonth(today.getMonth() - 1);

    const datesMap = new Map();

    // Loop dari satu bulan lalu sampai hari ini
    for (let d = new Date(oneMonthAgo); d <= today; d.setDate(d.getDate() + 1)) {
        const formatted = d.toISOString().split('T')[0];
        console.log(formatted)
        datesMap.set(formatted, 0); // atau bisa simpen value lain kalau mau
    }

    // Parse Line Data
    let rawLineData = rawData["order_timeline"]
    if (rawLineData) {
        rawLineData.forEach((data) => {
            // console.log(datesMap.get(data["key"])) // <-- pakai .get()
            if (datesMap.has(data["key"])) {       // <-- cek exist pakai .has()
                datesMap.set(data["key"], Number(data["value"])); // <-- update value pakai .set()
            }
        })
    }

    datesMap.forEach((val , key) => {
        lineData.labels.push(key)
        lineData.data.push(val)
    })

    let rawPieData = rawData["category_data"]
    if (rawPieData) {
        rawPieData.forEach((data) => {
            PieData.data.push(data["value"])
            PieData.labels.push(data["category"])
        })
    }

    // console.log(PieData)
    // console.log(lineData)
    // contoh akses:
    // for (let [key, value] of datesMap) {
        // console.log(datesMap); // "2025-03-26", "2025-03-27", dst sampai "2025-04-26"
    // }
    
    initChart(PieData , lineData)
});

function initChart(PieData , LineData) {
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    const pieCtx = document.getElementById('pieChart').getContext('2d');

    // Line Chart
    const lineChart = new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: LineData.labels,
            datasets: [{
                label: 'Sales',
                data: LineData.data,
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Pie Chart
    const pieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: PieData.labels,
            datasets: [{
                data: PieData.data,
                backgroundColor: [
                    'rgba(59, 130, 246, 0.7)',
                    'rgba(16, 185, 129, 0.7)',
                    'rgba(246, 224, 94, 0.7)',
                    'rgba(139, 92, 246, 0.7)',
                    'rgba(239, 68, 68, 0.7)'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        usePointStyle: true,
                        padding: 20
                    }
                }
            }
        }
    });

    // Update charts when theme changes
    function updateCharts() {
        lineChart.update();
        pieChart.update();
    }

    // Watch for dark mode changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === 'class') {
                updateCharts();
            }
        });
    });

    observer.observe(document.documentElement, {
        attributes: true
    });
}