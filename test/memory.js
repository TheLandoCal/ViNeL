var used = <?php $memused = 8176036 - 5109652; echo json_encode($memused); ?>;
var used = <?php $memused = 8176036 - 5109652; echo json_encode($memused); ?>;

var pieData = [
		{
			value: used,
			color: "#46BFBD",
			highlight: "#5AD3D1",
			label: "Green"
		},
		{
			value: 100,
			color: "#FDB45C",
			highlight: "#FFC870",
			label: "Yellow"
		}

	];

window.onload = function(){
	var ctx = document.getElementById("chart-area").getContext("2d");
	window.myPie = new Chart(ctx).Pie(pieData);
};
