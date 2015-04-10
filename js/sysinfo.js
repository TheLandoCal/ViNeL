$(document).ready(function(){
  getRequest("../php/getSysinfo.php", drawOutput, drawError);

  function drawError() {
    alert("Error!");
  }

  function drawOutput(responseText) {
    var sysinfo = JSON.parse(responseText);
    var storageData = [
      {
        value: parseInt(sysinfo.Storage.Used),
        color: "#FF990F",
        highlight: "#FFBA5B",
        label: "Used"
      },
      {
        value: parseInt(sysinfo.Storage.Free),
        color: "#0D8FDB",
        highlight: "#0FA7FF",
        label: "Free"
      }
    ];
    var ctxStorage = document.getElementById("storage-chart").getContext("2d");
    window.myDoughnut = new Chart(ctxStorage).Doughnut(storageData, {
      percentageInnerCutout : 40,
      tooltipEvents: [],
      onAnimationComplete: function() {
        ctxStorage.font="bold 20px Arial";
        ctxStorage.fillStyle = "black";
        ctxStorage.textAlign="center";
        ctxStorage.textBaseline="alphabetic";
        ctxStorage.fillText(Math.round(storageData[0].value / (storageData[0].value + storageData[1].value) * 100) + "%", ctxStorage.canvas.width / 2, ctxStorage.canvas.height / 2);

        ctxStorage.font="bold 14px Arial";
        ctxStorage.fillStyle = "black";
        ctxStorage.textAlign="center";
        ctxStorage.textBaseline="hanging";
        ctxStorage.fillText("Used", ctxStorage.canvas.width / 2, ctxStorage.canvas.height / 2);
      }
    });

    var memoryData = [
      {
        value: parseInt(sysinfo.Memory.Used),
        color: "#B22700",
        highlight: "#FF3B04",
        label: "Used"
      },
      {
        value: parseInt(sysinfo.Memory.Free),
        color: "#01B27F",
        highlight: "#1DFFBD",
        label: "Free"
      }
    ];

    var ctxMemory = document.getElementById("memory-chart").getContext("2d");
    window.myDoughnut = new Chart(ctxMemory).Doughnut(memoryData, {
      percentageInnerCutout : 40,
      tooltipEvents: [],
      onAnimationComplete: function() {
        ctxMemory.font="bold 20px Arial";
        ctxMemory.fillStyle = "black";
        ctxMemory.textAlign="center";
        ctxMemory.textBaseline="alphabetic";
        ctxMemory.fillText(Math.round(memoryData[0].value / (memoryData[0].value + memoryData[1].value) * 100) + "%", ctxMemory.canvas.width / 2, ctxMemory.canvas.height / 2);

        ctxMemory.font="bold 14px Arial";
        ctxMemory.fillStyle = "black";
        ctxMemory.textAlign="center";
        ctxMemory.textBaseline="hanging";
        ctxMemory.fillText("Used", ctxMemory.canvas.width / 2, ctxMemory.canvas.height / 2);
      }
    });

    var CPUData = [
      {
        value: parseFloat(sysinfo.CPU.Used),
        color: "#FFFD19",
        highlight: "#FFFD40",
        label: "Used"
      },
      {
        value: parseFloat(sysinfo.CPU.Free),
        color: "#5400B2",
        highlight: "#8519FF",
        label: "Free"
      }
    ];

    var ctxCPU = document.getElementById("cpu-chart").getContext("2d");
    window.myDoughnut = new Chart(ctxCPU).Doughnut(CPUData, {
      percentageInnerCutout : 40,
      tooltipEvents: [],
      onAnimationComplete: function() {
        ctxCPU.font="bold 20px Arial";
        ctxCPU.fillStyle = "black";
        ctxCPU.textAlign="center";
        ctxCPU.textBaseline="alphabetic";
        ctxCPU.fillText(Math.ceil(CPUData[0].value / (CPUData[0].value + CPUData[1].value) * 100) + "%", ctxCPU.canvas.width / 2, ctxCPU.canvas.height / 2);

        ctxCPU.font="bold 14px Arial";
        ctxCPU.fillStyle = "black";
        ctxCPU.textAlign="center";
        ctxCPU.textBaseline="hanging";
        ctxCPU.fillText("Used", ctxCPU.canvas.width / 2, ctxCPU.canvas.height / 2);
      }
    });

    var VMData = [
      {
        value: parseInt(sysinfo.VM.Total),
        color: "#787A7F",
        highlight: "#C1C4CC",
        label: "Total"
      }
    ];

    var ctxVM = document.getElementById("vm-chart").getContext("2d");
    window.myDoughnut = new Chart(ctxVM).Pie(VMData, {
      tooltipEvents: [],
      segmentShowStroke : false,
      onAnimationComplete: function() {
        ctxVM.font="bold 20px Arial";
        ctxVM.fillStyle = "white";
        ctxVM.textAlign="center";
        ctxVM.textBaseline="middle";
        ctxVM.fillText(VMData[0].value, ctxVM.canvas.width / 2, ctxVM.canvas.height / 2);
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

});
