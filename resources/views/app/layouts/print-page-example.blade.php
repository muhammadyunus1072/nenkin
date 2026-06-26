<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Print Pagination Test</title>

<style>

body {
    font-family: Arial, sans-serif;
}

/* table */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid black;
    padding: 8px;
}

/* repeat header every page */
thead {
    display: table-header-group;
}

@page {
    font-family: "Fira Mono";
    font-size: 12px;
    sheet-size: A4;
 
 
    @bottom-left {
        content: 'Page ' counter(page) ' of ' counter(pages);
        border-top: 1px solid #000;
        margin-bottom: 15px;
    }
    @bottom-center {
        /* content: 'Printed on: {{ \Carbon\Carbon::now()->format('M d, Y') }}'; */
        content: 'Page ' counter(page) ' of ' counter(pages);
        border-top: 1px solid #000;
        margin-bottom: 15px;
    }
 
    @bottom-right {
        content: 'Printed by Business Book';
        border-top: 1px solid #000;
        margin-bottom: 15px;
    }
}


</style>
</head>

<body>

<h2>Employee Report</h2>

<table>
<thead>
<tr>
<th>No</th>
<th>Name</th>
<th>Department</th>
<th>Description</th>
</tr>
</thead>

<tbody>

<!-- 120 rows = ±3 pages -->
<script>
for(let i=1;i<=120;i++){
document.write(`
<tr>
<td>${i}</td>
<td>Employee ${i}</td>
<td>IT Division</td>
<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
</tr>
`);
}
</script>

</tbody>
</table>

<div class="page-number"></div>

</body>
<script>
    window.onload = function () {
    window.print();
};
</script>
</html>