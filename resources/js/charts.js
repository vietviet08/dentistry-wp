import ApexCharts from "apexcharts";

window.initializeChart = function (selector, config) {
    const element = document.querySelector(selector);
    if (!element) {
        console.warn(`Chart selector "${selector}" not found`);
        return null;
    }

    const chartConfig = {
        chart: {
            type: config.type || "line",
            height: config.height || 350,
            toolbar: {
                show: config.showToolbar !== false,
            },
            animations: {
                enabled: true,
                easing: "easeinout",
                speed: 800,
                animateGradually: {
                    enabled: true,
                    delay: 150,
                },
                dynamicAnimation: {
                    enabled: true,
                    speed: 350,
                },
            },
            ...config.chart,
        },
        colors: config.colors || [
            "#3b82f6", // blue-500
            "#10b981", // green-500
            "#f59e0b", // amber-500
            "#ef4444", // red-500
            "#8b5cf6", // violet-500
            "#ec4899", // pink-500
            "#14b8a6", // teal-500
            "#f97316", // orange-500
        ],
        series: config.series || [],
        labels: config.labels || [],
        xaxis: {
            type: config.xaxisType || "category",
            ...config.xaxis,
        },
        yaxis: config.yaxis,
        tooltip: {
            theme: "light",
            ...config.tooltip,
        },
        legend: {
            position: config.legendPosition || "bottom",
            show: config.showLegend !== false,
            ...config.legend,
        },
        dataLabels: {
            enabled: config.dataLabels !== false,
            ...config.dataLabels,
        },
        responsive: [
            {
                breakpoint: 640,
                options: {
                    chart: {
                        height: 250,
                    },
                    legend: {
                        position: "bottom",
                        fontSize: "12px",
                    },
                },
            },
        ],
        ...config.extra,
    };

    const chart = new ApexCharts(element, chartConfig);
    return chart;
};

window.updateChart = function (chart, config) {
    if (!chart) return;
    chart.updateOptions(config);
};

window.renderChart = function (selector, config) {
    const chart = window.initializeChart(selector, config);
    if (chart) {
        chart.render();
    }
    return chart;
};
