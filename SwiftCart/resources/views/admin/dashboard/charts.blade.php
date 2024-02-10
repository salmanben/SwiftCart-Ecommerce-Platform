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
				data: {!!json_encode($data_orders) !!},
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
				data: {!!json_encode($data_earning) !!},
				backgroundColor: bgYear
			}]
		}
	}
);

var canvasSubscribers = document.getElementById('canvas-subscribers');
var ctxSubscribers = canvasSubscribers.getContext('2d');
var chartSubscribers = new Chart(
	ctxSubscribers, {
		type: 'bar',
		data: {
			labels: months,
			datasets: [{
				label: 'Subscribers',
				data: {!!json_encode($data_subscribers) !!},
				backgroundColor: bgYear
			}]
		}
	}
);

var canvasCustomers = document.getElementById('canvas-customers');
var ctxCustomers = canvasCustomers.getContext('2d');
var chartCustomers = new Chart(
	ctxCustomers, {
		type: 'bar',
		data: {
			labels: months,
			datasets: [{
				label: 'Customers',
				data: {!!json_encode($data_customers) !!},
				backgroundColor: bgYear
			}]
		}
	}
);
var orderStatusKeys = {!!json_encode(config('order_status.order_status_admin')) !!};
var orderStatus = []
for(key in orderStatusKeys)
{
    orderStatus.push(orderStatusKeys[key]['status'])
}
var canvasOrdersStatus = document.getElementById('canvas-orders-status');
var ctxOrdersStatus = canvasOrdersStatus.getContext('2d');
var chartOrdersStatus = new Chart(
	ctxOrdersStatus, {
		type: 'doughnut',
		data: {
			labels: orderStatus,
			datasets: [{
				data: {!!json_encode($data_order_status) !!},

			}]
		},
	}
);

canvasOrders.previousElementSibling.onchange = () => {
	var chartType = canvasOrders.className;
	var year = canvasOrders.previousElementSibling.value
	var url = "{{route('admin.dashboard.get_chart')}}"
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
	var url = "{{route('admin.dashboard.get_chart')}}"
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
							backgroundColor: bgYear
						}]
					}
				}
			);
		})
}
canvasSubscribers.previousElementSibling.onchange = () => {
	var chartType = canvasSubscribers.className;
	var year = canvasSubscribers.previousElementSibling.value
	var url = "{{route('admin.dashboard.get_chart')}}"
	url += `?chartType=${chartType}&year=${year}`;
	fetch(url)
		.then(res => res.json())
		.then(data => {
			chartSubscribers.destroy()
			chartSubscribers = new Chart(
				ctxSubscribers, {
					type: 'bar',
					data: {
						labels: months,
						datasets: [{
							label: 'Subscribers',
							data: data.data,
							backgroundColor: bgYear
						}]
					}
				}
			);
		})
}
canvasCustomers.previousElementSibling.onchange = () => {
	var chartType = canvasCustomers.className;
	var year = canvasCustomers.previousElementSibling.value
	var url = "{{route('admin.dashboard.get_chart')}}"
	url += `?chartType=${chartType}&year=${year}`;
	fetch(url)
		.then(res => res.json())
		.then(data => {
			chartCustomers.destroy()
			chartCustomers = new Chart(
				ctxCustomers, {
					type: 'bar',
					data: {
						labels: months,
						datasets: [{
							label: 'Customers',
							data: data.data,
							backgroundColor: bgYear
						}]
					}
				}
			);

		})
}
/********** End Chart **********/

</script>
