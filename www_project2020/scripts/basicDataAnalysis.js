function addRow(table, rowCells){
        var row = table.insertRow(table.rows.length);
        for(let i=0; i<rowCells.length; i++)
            row.insertCell(i).innerHTML= rowCells[i];
}

$.ajax({
    type: "POST",
    url: '../getBasicData.php',

    success: function (obj) {
                console.log(obj);
                let parsedObj = JSON.parse(obj);
                console.log(parsedObj['methods']);
                let rowCells = [];
                let basicDataTable = document.getElementById("basicDataTable");
                let methodsTable = document.getElementById("methodsTable");
                let statusTable = document.getElementById("statusTable");
                let ageTable = document.getElementById("ageTable");
                rowCells[0] = "Registered Users: ";
                rowCells[1] = parsedObj["userCount"];
                addRow(basicDataTable, rowCells);
                rowCells[0] = "Unique Domains in Database: ";
                rowCells[1] = parsedObj["urlCount"];
                addRow(basicDataTable, rowCells);
                rowCells[0] = "Unique ISPs: ";
                rowCells[1] = parsedObj["ispCount"];
                addRow(basicDataTable, rowCells);
                let i;
                addRow(methodsTable, ["Method", "Total"]);
                for(i=0; i<parsedObj["methods"].length;i++){
                    rowCells[0] = parsedObj["methods"][i]['method'];
                    rowCells[1] = parsedObj["methods"][i]['total'];
                    addRow(methodsTable, rowCells);
                }
                addRow(statusTable, ["Status Code", "Total"]);
                for(i=0; i<parsedObj["status"].length;i++){
                    rowCells[0] = parsedObj["status"][i]['status'];
                    rowCells[1] = parsedObj["status"][i]['total'];
                    if(rowCells[0]==null)
                        rowCells[0]="Null";
                    addRow(statusTable, rowCells);
                }
                addRow(ageTable, ["Content Type", "Average"]);
                for(i=0; i<parsedObj["age"].length;i++){
                    rowCells[0] = parsedObj["age"][i]['content_type'];
                    rowCells[1] = parseFloat(parsedObj["age"][i]['average']).toFixed(1);
                    if(rowCells[0]==null)
                        rowCells[0]="Null";
                    addRow(ageTable, rowCells);
                }
            }
});