/**
 * Initialize DataTables for elements with class 'yelsuDataTables'
 * @returns {void}
 */
function startDataTables() {
    new DataTable('.yelsuDataTables', {
        responsive: true, // Enable responsive design
        searching: false, // Disable search feature
        "ordering": false, // Disable column ordering
        "dom": 'rt', // Set the order of DataTables elements
        columnDefs: [ {
            className: 'dtr-control', // Set class for responsive control column
            orderable: false, // Disable ordering for the control column
            targets: -1 // Apply to the last column
        }],
        responsive: {
            details: {
                type: 'column', // Set the type of details to display
                target: 'tr' // Apply to table rows
            }
        },
        "pageLength": -1 // Show all rows on a single page
    });
}
startDataTables();