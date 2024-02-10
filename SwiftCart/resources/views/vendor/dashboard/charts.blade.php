<script>
    /********** Start Chart **********/
    var statisticYear = document.querySelectorAll(".statistic-year")
    statisticYear.forEach(e => {

        var d = new Date();
        for (let i = d.getFullYear(); i >= 2024; i--) {
            e.innerHTML += `<option  value="${i}">${i}</option>`
        }

    })
    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];

    var bgYear = [
        '#9381ff',
        '#06d6a0',
        '#4361ee',
        '#ef476f',
        '#ffd60a',
        '#03045e',
        '#e1e5f2',
        '#9381ff',
        '#06d6a0',
        '#4361ee',
        '#ef476f',
        '#ffd60a'
    ];


    var canvasOrders = document.getElementById('canvas-orders');
    var ctxOrders = canvasOrders.getContext('2d');
    var chartOrders = new Chart(
        ctxOrders, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Orders',
                    data:
                    {!!json_encode($data_orders)!!},
                    backgroundColor: bgYear,
                }]
            }
        }
    );


    var canvasEarning = document.getElementById('canvas-earning');
    var ctxEarning = canvasEarning.getContext('2d');
    var chartEarning = new Chart(
        ctxEarning, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Earning',
                    data: {!!json_encode($data_earning)!!},
                    backgroundColor: bgYear,
                }]
            }
        }
    );

    canvasOrders.previousElementSibling.onchange = () => {
        var chartType = canvasOrders.className;
        var year = canvasOrders.previousElementSibling.value
        var url = "{{ route('vendor.dashboard.get_chart') }}"
        url += `?chartType=${chartType}&year=${year}`;
        fetch(url)
            .then(res => res.json())
            .then(data => {
                chartOrders.destroy()
                chartOrders = new Chart(
                    ctxOrders, {
                        type: 'bar',
                        data: {
                            labels: months,
                            datasets: [{
                                label: 'Orders',
                                data: data.data,
                                backgroundColor: bgYear,
                            }]
                        }
                    }
                );
            })
    }
    canvasEarning.previousElementSibling.onchange = () => {
        var chartType = canvasEarning.className;
        var year = canvasEarning.previousElementSibling.value
        var url = "{{ route('vendor.dashboard.get_chart') }}"
        url += `?chartType=${chartType}&year=${year}`;
        fetch(url)
            .then(res => res.json())
            .then(data => {
                chartEarning.destroy()
                chartEarning = new Chart(
                    ctxEarning, {
                        type: 'bar',
                        data: {
                            labels: months,
                            datasets: [{
                                label: 'Earning',
                                data: data.data,
                                backgroundColor: bgYear,
                            }]
                        }
                    }
                );
            })
    }

    /********** End Chart **********/
</script>
