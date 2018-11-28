function sudoku(){
    var sudoku = new Array(9);
    for(i=0; i < sudoku.length;i++){
        sudoku[i] = new Array(9);
        for (j = 0; j < 9;j++){
            sudoku[i][j] = 0;   
        }
    }
    
    var checkSudokuBlock = new Array(9);
    for (i = 0; i < 9; i++){
        do{
           var nummer = Math.floor(Math.random() * sudoku.length) + 1;
        }while(checkSudokuBlock.includes(nummer));
        checkSudokuBlock[i] = nummer;
    }

    for (x = 0; x < 3; x++){
        for (y = 0; y < 3; y++){
            for (i = 0; i < 3; i++){
                for (j = 0;j < 3; j++){
                    sudoku[i+(y*3)][j+(x*3)] = checkSudokuBlock[(j+(i*3))];
                }
            }
            var nummer = checkSudokuBlock[8];
            checkSudokuBlock.unshift(nummer);
            checkSudokuBlock.pop;
        }
    }
    
    var nummer = Math.floor(Math.random() * 10000) + 1;
    
    for (i = 0; i < nummer;i++){
        var switchArray = new Array(9);
        var kies = Math.floor(Math.random() * 2) + 1;
        
        if (kies == 2){ //rijen veranderen
            kies = Math.floor(Math.random() * 3);
            var welkeA = Math.floor(Math.random() * 3);
            do{
                var welkeB = Math.floor(Math.random() * 3);
            }while(welkeA === welkeB);
                
            for (j = 0; j < 9;j++){
                switchArray[j] = sudoku[j][welkeA+(kies*3)];
            }
            for (j = 0; j < 9;j++){
                sudoku[j][welkeA + (kies*3)] = sudoku[j][welkeB + (kies*3)];
                sudoku[j][welkeB + (kies*3)] = switchArray[j];
            }
        }else{ //colommen veranderen
            kies = Math.floor(Math.random() * 3);
            var welkeA = Math.floor(Math.random() * 3);
            do{
                var welkeB = Math.floor(Math.random() * 3);
            }while(welkeA === welkeB);
            
            for (j = 0; j < 9;j++){
                switchArray[j] = sudoku[welkeA+(kies*3)][j];
                
            }
            
            for (j = 0; j < 9;j++){
                sudoku[welkeA + (kies*3)][j] = sudoku[welkeB + (kies*3)][j];
                sudoku[welkeB + (kies*3)][j] = switchArray[j];
            }
        }
    }
    
    var x = ("<table border='3px black solid' style='margin:15px;background-color:white;'>");
    var colorCode ="white";
    for (i = 0; i < sudoku.length; i++){
        
        var x = x.concat("<tr borde='1px'>");
        
        for (j = 0;j < sudoku[i].length; j++){
            if((Math.floor(i / 3) + Math.floor( j / 3 )) % 2 === 0){
                colorCode ="lightgrey";
            }else{
                colorCode ="white";
            }
            var x = x.concat("<td><input type='hidden' value='"+ sudoku[i][j] +"' /><input style='font-size: 23px;padding:16px;width:3rem;height:3rem;background-color:"+ colorCode +";' maxlength='1' value='" + sudoku[i][j] + "'></td>");
        }
        var x = x.concat("</tr>");    
    }
    
    var x = x.concat("</table>");
    
    document.getElementById('sudoku').innerHTML = x;
}
