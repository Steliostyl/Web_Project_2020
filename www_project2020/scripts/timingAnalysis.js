let timingsChart = document.getElementById('timingsChart').getContext('2d');

// Global options
Chart.defaults.global.defaultFontFamily = 'Times New Roman';
Chart.defaults.global.defaultFontSize = 20;
Chart.defaults.global.defaultFontColor = 'white';

var response = null;
var chartData = [1, 2, 3, 4, 5, 6, 7, 8, 9, 1, 2, 3, 4, 5, 6, 7, 8, 9, 8, 4, 1, 2, 3, 4];
var all_data = [];
const initializedHours = [
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    },
    {
        "Count": 0,
        "TotalWait": 0,
    }
]
var hours = initializedHours;

function initializeHours() {
    let temp = new Array();
    for (let i = 0; i < 24; i++) {
        temp.push({
            "Count": 0,
            "TotalWait": 0,
        });
    }
    return temp;
}

var chart = new Chart(timingsChart, {
    type: 'line',
    data: {
        labels: ["12πμ", "1πμ", "2πμ", "3πμ", "4πμ", "5πμ", "6πμ", "7πμ", "8πμ", "9πμ", "10πμ", "11πμ", "12μμ", "1μμ", "2μμ", "3μμ", "4μμ", "5μμ", "6μμ", "7μμ", "8μμ", "9μμ", "10μμ", "11μμ"],
        datasets: [{
            label: 'Measure',
            data: chartData,
            backgroundColor: [
                'rgba(255, 204, 0,0)',
                'rgba(255, 204, 0,0.0)',
                'rgba(255, 204, 0,0.0)',
                'rgba(255, 204, 0,0.0)',
                'rgba(255, 204, 0,0.1)',
                'rgba(255, 204, 0,0.2)',
                'rgba(255, 204, 0,0.3)',
                'rgba(255, 204, 0,0.5)',
                'rgba(255, 204, 0,0.7)',
                'rgba(255, 204, 0,0.7)',
                'rgba(255, 204, 0,0.8)',
                'rgba(255, 204, 0,0.9)',
                'rgba(255, 204, 0,1)',
                'rgba(255, 204, 0,1)',
                'rgba(255, 204, 0,1)',
                'rgba(255, 204, 0,1)',
                'rgba(255, 204, 0,0.9)',
                'rgba(255, 204, 0,0.7)',
                'rgba(255, 204, 0,0.5)',
                'rgba(255, 204, 0,0.3)',
                'rgba(255, 204, 0,0.1)',
                'rgba(255, 204, 0,0)',
                'rgba(255, 204, 0,0)',
                'rgba(255, 204, 0,0)',
            ],
            borderWidth: 1,
            borderColor: 'white',
            hoverBorderWidth: 3,
            hoverBorderColor: 'white'
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        title: {
            display: true,
            text: 'Timings Analysis',
            fontSize: 30,
        },
        legend: {
            display: false
        },
        layout: {
            padding: {
                left: 20,
                right: 20,
                top: 20,
                bottom: 20
            }
        }
    }
});

const simple_content_types = ["image", "video", "audio", "javascript", "json", "xml", "html", "css", "font", "text", "application"]
const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

$.ajax({
    type: "POST",
    url: '../getTimingData.php',

    success: function (obj) {
        response = JSON.parse(obj);
        all_data = response['answer'];
        var unique_values = {
            "content_types": simple_content_types,
            "methods": extractListFromResponse(response['methods']),
            "isps": extractListFromResponse(response['isps'])
        }
        //console.log("Unique values:", unique_values);
        all_data = processData(all_data);
        addAllFilterOptions(unique_values);
        addSubmitListener();
        displayFinalChart(all_data)
    }
});

function displayFinalChart(filtered_chartData) {
    hours = initializeHours();
    for (let i = 0; i < filtered_chartData.length; i++) {
        if (typeof all_data[i] != 'undefined') {
            let date = new Date(filtered_chartData[i]['startedDateTime']);
            let hour = date.getHours();
            hours[hour]['Count'] += 1
            hours[hour]['TotalWait'] += parseFloat(filtered_chartData[i]['wait']);
        }
    }
    for (let h = 0; h < 24; h++) {
        if (hours[h]['Count'] != 0)
            chartData[h] = (hours[h]['TotalWait'] / hours[h]['Count']).toFixed(2);
        else chartData[h] = 0;
    }
    chart.update();
}

function filterContent(filters) {
    filtered_data = [];
    //console.log("Filters:", filters);
    for (let i = 0; i < all_data.length; i++) {
        let skip = false;
        for (const key in filters) {
            // If any attribute isn't inscluded in the selected filters, skip data point
            var item = all_data[i][key];

            if (!filters[key].includes(item)) {
                //console.log(item, "not found in ", key, " filters. Here they are: ", filters[key]);
                skip = true;
                break;
            }
        }
        if (!skip) filtered_data.push(all_data[i]);
    }
    //console.log("Filtered data:", filtered_data)
    displayFinalChart(filtered_data);
}

function getSimpleContentType(content_type) {
    if (content_type === null) return null;
    for (let i = 0; i < simple_content_types.length; i++) {
        if (content_type.includes(simple_content_types[i])) return simple_content_types[i];
    }
}

function addAllFilterOptions(unique_values) {
    for (const key in unique_values) {
        addFilterOptions(key, unique_values[key]);
    }
    simple_content_types.forEach(function (simple_content_types) {
        createNewCheckboxInputelement("content_types", simple_content_types);
    });
}

function addFilterOptions(key, values) {
    // console.log(key);
    // console.log(values);
    if (key != "content_types") {
        for (i = 0; i < values.length; i++) {
            createNewCheckboxInputelement(key, values[i]);
        }
    }
}

function createNewCheckboxInputelement(key, value) {
    let key_element = document.getElementById(key);
    // Create a new checkbox input element
    const checkbox = document.createElement("input");
    checkbox.type = "checkbox";
    checkbox.name = key;
    checkbox.value = value;

    // Create a label element
    const label = document.createElement("label");

    // Append the checkbox to the label
    label.appendChild(checkbox);

    // Add the text "JSON" to the label
    label.appendChild(document.createTextNode(value));

    // Create a line break element
    const lineBreak = document.createElement("br");

    // Insert the label and line break after their header
    key_element.parentNode.insertBefore(lineBreak, key_element.nextSibling);
    key_element.parentNode.insertBefore(label, key_element.nextSibling);

}

function extractListFromResponse(response) {
    var final_list = [];
    for (const key in response) {
        for (const key_2 in response[key]) {
            final_list.push(response[key][key_2]);
        }
    }
    return final_list;
}

function addSubmitListener() {
    document.querySelector('.filters').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the form from submitting

        // Get all checkboxes with the name "content"
        let contentCheckboxes = document.querySelectorAll('input[name="content_types"]');

        // Get all checkboxes with the name "day"
        let dayCheckboxes = document.querySelectorAll('input[name="day"]');

        // Get all checkboxes with the name "method"
        let methodCheckboxes = document.querySelectorAll('input[name="methods"]');

        // Get all checkboxes with the name "isp"
        let ispCheckboxes = document.querySelectorAll('input[name="isps"]');

        const selectedContent = getSelectedValues(contentCheckboxes);
        const selectedDays = getSelectedValues(dayCheckboxes);
        const selectedMethods = getSelectedValues(methodCheckboxes);
        const selectedISPs = getSelectedValues(ispCheckboxes);

        const filters = {
            "content_type": selectedContent,
            "day": selectedDays,
            "method": selectedMethods,
            "userISP": selectedISPs
        }

        filterContent(filters);
        //console.log("Filters:", filters);
    });
}

// Helper function to get the values of selected checkboxes
function getSelectedValues(checkboxes) {
    const selectedValues = [];

    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            selectedValues.push(checkbox.value);
        }
    });
    //console.log(selectedValues);

    return selectedValues;
}

function processData(data) {
    for (let i = 0; i < data.length; i++) {
        let content_type = data[i]["content_type"]
        let started_dt = data[i]["startedDateTime"]
        // Convert content types to simple content types
        data[i]["content_type"] = getSimpleContentType(content_type);
        // Add a new "Day" value to each row, according to their startedDateTime
        data[i].day = weekday[new Date(started_dt).getDay()];
    }
    return data;
}

function selectAllCheckboxes(name, select) {
    const checkboxes = document.querySelectorAll(`input[name="${name}"]`);
    checkboxes.forEach(checkbox => {
        checkbox.checked = select;
    });
}