 $( function() {
    var values = [];
    const phpFile = 'callSubjects.php';
            
    $.ajax({
        url: phpFile,
        method: 'GET',
        success: (data)=>{
        console.log(data); 
        values = data;         
        $( ".subjectText" ).autocomplete({
            source: values
    });
                    
    },
        error: ()=>{ alert('error'); }
        });
});