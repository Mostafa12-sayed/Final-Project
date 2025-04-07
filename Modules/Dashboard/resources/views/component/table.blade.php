<div id="table-gridjs"></div>

<script>
        // pagination Table
if (document.getElementById("table-pagination"))
     new gridjs.Grid({
          columns: [{
               name: 'ID',
               width: '120px',
               formatter: (function (cell) {
                    return gridjs.html('' + cell + '');
               })
          }, "Name", "Date", "Total",
          {
               name: 'Actions',
               width: '100px',
               formatter: (function (cell) {
                    return gridjs.html("" +
                         "Details" +
                         "");
               })
          },
          ],
          pagination: {
               limit: 5
          },

          data: [
               ["#RB2320", "Alice", "07 Oct, 2024", "$24.05"],
               ["#RB8652", "Bob", "07 Oct, 2024", "$26.15"],
               ["#RB8520", "Charlie", "06 Oct, 2024", "$21.25"],
               ["#RB9512", "David", "05 Oct, 2024", "$25.03"],
               ["#RB7532", "Eve", "05 Oct, 2024", "$22.61"],
               ["#RB9632", "Frank", "04 Oct, 2024", "$24.05"],
               ["#RB7456", "Grace", "04 Oct, 2024", "$26.15"],
               ["#RB3002", "Hannah", "04 Oct, 2024", "$21.25"],
               ["#RB9857", "Ian", "03 Oct, 2024", "$22.61"],
               ["#RB2589", "Jane", "03 Oct, 2024", "$25.03"],
          ]
     }).render(document.getElementById("table-pagination"));
</script>