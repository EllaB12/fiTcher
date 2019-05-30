//const teachers = [];

let resDiv;
let index = 0;


$(document).ready(() => {
    resDiv = $('#teacherContainer');
    getTeachers();
    render();
})

const getTeachers = () => {
    const phpFile = 'test.php';       

    $.ajax({
        url: phpFile,
        method: 'GET',
        success: (data) => {
            index = 0;
            teachers = data;
            render();
        },
        error: () => { console.log('err') }
    });
}

// Render method- shows the teacher on the screen.
// here you can add more details upon the teacher by useing ${teachers[index].<field>} inside the <p> element
const render = () => {

    let str = '';
    if (noResults()) {
        str = `<div style="color:#116677" class="notFount"> אין יותר תוצאות </div>
        <div style="margin:auto"><img id="search" src="Images/animat-search-color.gif" /></div>
        <div class="notFount"><a href="indexStudent.php" class="home-link inactive underlineHover fadeIn"> <i class="far fa-address-card"></i> חזרה לאזור האישי</a></div>`
    }
    else {
        str = `<div style="text-align: center">
                    <div id="teacherCard" href="#">             
                        <img class="teacherImage" src="data:image/png;base64,${teachers[index].picture}" alt="Card image">
                        <div class="card-body">
                            <h4 class="card-title">${teachers[index].fullName}</h4>
                            <div> ${teachers[index].experience} </div>   
                            <i class="fas fa-map-marker-alt"></i>  ${teachers[index].city}</br>
                            <i class="far fa-heart"></i>  ${teachers[index].likes}
                            <div class="card-text">
                        
                            </div>
                            
                            <div id="moreInfo" class="card-text collapse">
                                 <div style="margin:5px; color:#116677; font-weight:bold;"> מה אני מציע? </div>
                                 <div style="margin:6px;"> ${teachers[index].description} </div>
                                 
                                 
                                <div style="margin:5px; margin-top:18px; color:#116677; font-weight:bold;">כמה זה עולה?</div>
                                <div style="margin-right:6px;"> ${teachers[index].price} ש"ח עבור שיעור של שעה</div>
                                <div style="margin-right:6px;">ועבור שיעור כפול ${teachers[index].cutPrice}   ש"ח לשעה </div>
                            </div>
                            <button type="button" class="btn btn-info btnInfo" data-toggle="collapse" data-target="#moreInfo">פרטים נוספים</button>                   
                        </div>
                        <div class="iconsContainer">
                            <div class="iconBG" style="border-right: 1px solid rgba(0,0,0,0.125)"> 
                                <button class="teacherIcon" onclick="like()">
                                    <img class="icon" src="./Images/like.png"> 
                                </button>
                            </div>
                            <div class="iconBG">
                                <button class="teacherIcon" onclick="dislike();">
                                    <img class="icon" src="./Images/icons/clear.png">
                                </button> 
                            </div>
                        </div>
                    </div>
                </div>`
    }

    resDiv.html(str);
}

const forward = () => {
    index < teachers.length - 1 ? index++ : index = 0;
    render();
}

const backward = () => {
    index > 0 ? index-- : index = teachers.length - 1;
    render();
}

const dislike = () => {
    teachers.splice(index, 1);
    if(index != 0 && index != teachers.length - 1){
        index--;
    }
    render();
}

const like = () => {
    swal({
        title: "נמצאה התאמה",
        text: ` המורה ${teachers[index].fullName} נוסף/ה לאיזור האישי שלך `,
        icon: "success",
        buttons: "אישור"   
      });
    
      $.ajax({
        type:"POST",
        url: "callAddFunction.php",
        data: "variable1=" + `${teachers[index].id}` ,
        success: function(){
    }
    
   });
}

const noResults = () => {
    return !teachers.length;
}