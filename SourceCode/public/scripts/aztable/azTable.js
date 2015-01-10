/**
 * Azpiration Simple Table Object (ASTO).
 *
 * @author      harry s. kartono <hskartono@yahoo.co.id>
 * @version     0.1
 * @copyright   Azpiration 2006
 * @filename    azTable.js
 */

/**
 * azTable constructor. azTable adalah sebuah objek yang digunakan untuk
 * melakukan manajemen tabel (add/remove row).
 */
function azTable(tableId)
{
    // store our initial row count to zero
    this.rowCount = 0;
    
    // store our table id information
    this.tableId = tableId;
}

/**
 * set current row count
 */
azTable.prototype.setRowCount = function (rowCount)
{
    this.rowCount = rowCount;
}

azTable.prototype.getRowCount = function (actual)
{
	if (actual == 'undefined') {
		return this.rowCount;
	} else {
		var table = document.getElementById(this.tableId);
		return table.rows.length-1;
	}
}

/**
 * azTable addRow method, digunakan untuk menambahkan baris data pada suatu
 * tabel dengan parameter tableData dan status drawRemoveButton.
 */
azTable.prototype.addRow = function (tableData, drawRemoveButton, removeImage, bottomPosition)
{
    // go get the table object
    var table = document.getElementById(this.tableId);
	if (bottomPosition == undefined) {
		bottomPosition = table.rows.length;
	} else {
		bottomPosition = table.rows.length - bottomPosition;
	}
	var rowData = table.insertRow(bottomPosition);
    
    // set the row id
    var rowId = "row_" + this.tableId + '_' + this.rowCount;
    rowData.setAttribute("id", rowId);
	
	// set the row class
	var classRowId = "row" + (this.rowCount +1)% 2;
	rowData.setAttribute("class", classRowId);
    
    // draw all supplied data in a row
	for (var row=0; row<tableData.length; row++)
    {
			var cellData = rowData.insertCell(row);
			cellData.innerHTML = tableData[row];
	}
    
    // do we want a remove row button?
    
	var cellData = rowData.insertCell(tableData.length);
	if ((removeImage != undefined) && (removeImage != null) && (removeImage != '')) {
		// add more cell as last column
		
		// insert the remove button script pointing to current row id
		cellData.innerHTML = '<img src=' + "'" + removeImage + "'" + ' onclick=\"removeRow(' + "'" + rowId + "','" +
		this.tableId + "','"+this.rowCount+"'" + ')\"/>';
	} else if (drawRemoveButton == true) {
		// add more cell as last column
		
		// insert the remove button script pointing to current row id
		cellData.innerHTML = '<input type="button" value="Remove" ' +
		'onclick="removeRow(' + "'" + rowId + "','" +
		this.tableId + "','"+this.rowCount+"'" + ')" border="0" class="button" />';
	}
    
    // row has been added, increment the row counter
    this.rowCount++;
    
}

/**
 * azTable removeRow method, digunakan untuk menghapus baris data pada suatu
 * tabel dengan parameter id baris yang akan dihapus.
 */
azTable.prototype.removeRow = function (rowId)
{
    // go get the table object
    var table = document.getElementById(this.tableId);
    // is there any row left in the table?
    if (table.rows.length > 0) {
        // get the row object
        var row = document.getElementById(rowId);
		if (row != null) {
	        // point to parent node from this row
	        var par = row.parentNode;
	        // from parent node, remove the selected row
			if (par != null) {
				par.removeChild(row);
			}
		}
    }
}

azTable.prototype.removeRows = function(status)
{
    var table = document.getElementById(this.tableId);
    
    //status true to remove all rows
    if (status == true) {
        for (id in table.rows) {
            table.deleteRow(table.rows.length-1);
        }
    } else {
        if (table.rows.length > 1) {
            for (id in table.rows) {
                if (table.rows.length-1 > 0) {
                    table.deleteRow(table.rows.length-1);
                }
            }
        }
    }
}