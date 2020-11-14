// @param (html table emelemnt) tabe we're gonna sort
// @param (number) index of the column we re gonna sort
// @param (html table emelemnt) whether sorting is done in acsending order or decsending order


function sortTableByCol(table, column, asc=true){
    const dirModifier = asc ? 1: -1;
    const tbody = table.tBodies[0];
    const rows=Array.from(tbody.querySelectorAll("tr"));//select every tr element in tbody we get an array of tr instead of lists

    const sortedRows=rows.sort((a, b)=>{
        const aColText = a.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();
        const bColText = b.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();
        
        return aColText>bColText ? (1*dirModifier) : (-1*dirModifier);

    });

    console.log(sortedRows);

    

}


sortTableByCol(document.querySelector("table"),2);