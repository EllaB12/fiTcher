 $( function() {
    var values = [];
    const phpFile = 'callFetchCities.php';
            
    $.ajax({
        url: phpFile,
        method: 'GET',
        success: (data)=>{
        console.log(data); 
        values = data;         
        $( "#cityText" ).autocomplete({
            source: values
    });
                    
    },
        error: ()=>{ alert('error'); }
        });
});