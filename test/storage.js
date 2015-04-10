window.onload = function(){
  getRequest(
   "./getStorage.php", // URL for the PHP file
   drawOutput,  // handle successful request
   drawError    // handle error
  );

  // handles drawing an error message
  function drawError() {
    alert("Error!");
  }

  function drawOutput(responseText) {
    var storage = JSON.parse(responseText);
    var storageData = [
      {
        value: parseInt(storage.used),
        color: "#FDB45C",
        highlight: "#FFC870",
        label: "Used"
      },
      {
        value: parseInt(storage.available),
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Available"
      }
    ];

    var ctx = document.getElementById("storage-chart").getContext("2d");
    window.myDoughnut = new Chart(ctx).Doughnut(storageData, {
      percentageInnerCutout : 40,
      tooltipEvents: [],
      onAnimationComplete: function() {
        ctx.font="bold 20px Arial";
        ctx.fillStyle = "black";
        ctx.textAlign="center";
        ctx.textBaseline="alphabetic";
        ctx.fillText(Math.round(storageData[0].value / (storageData[0].value + storageData[1].value) * 100) + "%", ctx.canvas.width / 2, ctx.canvas.height / 2);

        ctx.font="bold 14px Arial";
        ctx.fillStyle = "black";
        ctx.textAlign="center";
        ctx.textBaseline="hanging";
        ctx.fillText("Used", ctx.canvas.width / 2, ctx.canvas.height / 2);
      }
    });
  }

  function getRequest(url, success, error) {
    var req = false;
    try{
        req = new XMLHttpRequest();
    } catch (e){
        // IE
        try{
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(e) {
            // try an older version
            try{
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                return false;
            }
        }
    }
    if (!req) return false;
    if (typeof success != 'function') success = function () {};
    if (typeof error!= 'function') error = function () {};
    req.onreadystatechange = function(){
        if(req.readyState == 4) {
            return req.status === 200 ? 
                success(req.responseText) : error(req.status);
        }
    }
    req.open("POST", url, true);
    req.send(null);
    return req;
  }

};

